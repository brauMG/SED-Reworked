<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Attribute;
use App\Models\Concept;
use App\Models\MaturityLevelsGroup;
use App\Models\Test;
use App\Models\Role;
use App\Models\User;
use App\Models\User_Area;
use App\Models\Company;
use App\Models\Role_User;
use App\Models\MaturityLevel;
use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminsController extends Controller
{
//    public function __construct(Request $request)
//    {
//        $this->middleware(['auth', 'verified']);
//    }

    public function index(Request $request)
    {
        Auth::user()->authorizeRoles(['admin']);
        //for maturity level
        $user = auth()->user();
        $userIdenti = $user-> companyId;
        $CountMaturity = MaturityLevel::where('companyId','=',$userIdenti)->count();
        //for areas
        $userId = Auth::id();
        $companyId = User::giveMeCompany(Auth::user());
        $areas = DB::table('areas')->where('areas.companyId','=',$companyId)->get()->toArray();

        return view('pages.admins.index', compact('areas'));
    }

    public function viewResults(Request $request,$areaId)
    {
        Auth::user()->authorizeRoles(['admin']);
        $companyId = User::giveMeCompany(Auth::user());
        $areas = Area::where('companyId',$companyId)->get()->toArray();
        $areasId = array_column($areas,'areaId');
        $tests = Test::testFromAnAreaId($areaId);
        $testsIds=array_column($tests,'testId');
        $total = 0;
        $promedio = 0;
        $i = 0;
        $general = null;

        $groups = MaturityLevelsGroup::where('companyId', $companyId)->get()->toArray();

        $areaSeleccionada= Area::where('areaId',$areaId)->first();

        $maturityLevels = MaturityLevel::where('companyId',$companyId)->get()->toArray();

        abort_if(!in_array($areaId,$areasId),403); // Si el area seleccionada no existe dentro de las areas del usuario no lo deja verla

        if(empty($areas)){ // Verifica si la compañia del usuario tiene areas. Si no lo manda a crear un area.
            return redirect('/admins/area/addArea');
        }

        $testsConcepts = Concept::ConceptsFromAnArrayOfTestsIds($testsIds);
        $testsConcepts = collect($testsConcepts)->sortBy('testId')->toArray();
        $testsConcepts = array_filter(array_values($testsConcepts));
        $testsConceptsIds = array_column((array)$testsConcepts,'testConceptId');
        $results=[];

        foreach ((array) $testsConceptsIds as $item)
        {
            $conceptsResults[] = DB::select('call p_fetch_verified_evidences(?)',array($item));
            $results[] = (array)$conceptsResults[array_search($item,$testsConceptsIds)][0];
        }

        return view('pages.admins.viewResults.results',compact([
            'areas',
            'areaSeleccionada',
            'tests',
            'testsConcepts',
            'maturityLevels',
            'results',
            'total',
            'promedio',
            'i',
            'general',
            'groups'
        ]));
    }

    public function indexUser(Request $request)
    {
        $request->user()->authorizeRoles(['superAdmin','admin']);
        $role = Role_User::all();
        $companies = Company::all();
        $admins = User::all();
        return view('pages.admins.user.index', compact('admins', 'companies', 'role'));
    }

    public function createUser(Request $request)
    {
        Auth::user()->authorizeRoles(['admin']);
        $user = auth()->user();
        $userCompany = User::giveMeCompany(Auth::user());//Me regresa el company id del usuario actualmete loggeado
        $areas = Area::where('companyId',$userCompany)->get()->toArray();
        $roles = Role::all(['id', 'name']);

        $countAreas = Area::where('companyId','=',$userCompany)->count();
        if($countAreas == 0){
            return redirect('/admins/area/addArea')->with('mensajeError', 'PRIMERO DEBE CREAR UN ÁREA');
        }
        else{
            $id = Auth::user()->companyId;
            $areas2 = DB::table('areas')->where('areas.companyId','=',$id)->get()->toArray();
            return view('pages.admins.user.addUser.create', compact('roles','areas', 'userCompany', 'areas2'));
        }
    }

    public function storeUser(Request $request)
    {
        Auth::user()->authorizeRoles(['admin']);
        $user = auth()->user();
        $companyId = $user->companyId;
        $areas = $request->input('areas');

        $data = $this->validatorUser();
        $userAdd = User::create([
            'username' => $data['username'],
            'firstName' => $data['firstName'],
            'lastName' => $data['lastName'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'companyId' => $companyId
        ]);

        foreach ($areas as $area) {
            $userAdd->areas()->attach($area);
        }

        Role_User::create([
            'role_id' => $data['role'],
            'user_id' => $userAdd->id
        ]);

        History::Logs('Usuario '.$userAdd['username'].' creado correctamente.');
        return redirect('/admins/user/index')->with('mensaje', 'Usuario '.$userAdd['username'].' creado correctamente.');
    }

    public function show(Request $request,$id)
    {
        Auth::user()->authorizeRoles(['admin']);
        $User = User::find($id)->toArray();
        $company = Company::where('companyId', $User['companyId'])->first();
        $Areas = Area::where('companyId',$User['companyId'])
            ->get();
        $User_Area = Area::join('user_areas','user_areas.areaId','=','areas.areaId')
            ->where('userId',$id)
            ->get();
        $Validar = false;
        $Array_Areas = array();
        foreach ($Areas as $A) {
            foreach ($User_Area as $UA) {
                if($A->areaId == $UA->areaId){
                    $Validar = true;
                }
            }
            $Array_Areas[] = array('validar' => $Validar,'name' => $A->name,'areaId' => $A->areaId );
            $Validar = false;
        }

        $id = Auth::user()->companyId;
        $areas = DB::table('areas')->where('areas.companyId','=',$id)->get()->toArray();

        return view('pages.admins.user.viewUsers.showUser' ,compact('User','Areas','User_Area','Array_Areas', 'company', 'areas'));
    }

    public function edit(Request $request,$id)
    {
        Auth::user()->authorizeRoles(['admin']);
        $User = User::find($id)->toArray();
        $company = Company::where('companyId', $User['companyId'])->first();
        $Areas = Area::where('companyId',$User['companyId'])
            ->get();
        $User_Area = Area::join('user_areas','user_areas.areaId','=','areas.areaId')
            ->where('userId',$id)
            ->get();
        $Validar = false;
        $Array_Areas = array();
        foreach ($Areas as $A) {
            foreach ($User_Area as $UA) {
                if($A->areaId == $UA->areaId){
                    $Validar = true;
                }
            }
            $Array_Areas[] = array('validar' => $Validar,'name' => $A->name,'areaId' => $A->areaId );
            $Validar = false;
        }

        $id = Auth::user()->companyId;

        $areas = DB::table('areas')->where('areas.companyId','=',$id)->get()->toArray();

        return view('pages.admins.user.viewUsers.editUser' ,compact('User','Areas','User_Area','Array_Areas', 'company', 'areas'));
    }

    public function showData(Request $request,$id)
    {
        Auth::user()->authorizeRoles(['admin']);
        $User = User::find($id)->toArray();
        $company = Company::where('companyId', $User['companyId'])->first();
        $Areas = Area::where('companyId',$User['companyId'])
            ->get();
        $User_Area = Area::join('user_areas','user_areas.areaId','=','areas.areaId')
            ->where('userId',$id)
            ->get();
        $Validar = false;
        $Array_Areas = array();
        foreach ($Areas as $A) {
            foreach ($User_Area as $UA) {
                if($A->areaId == $UA->areaId){
                    $Validar = true;
                }
            }
            $Array_Areas[] = array('validar' => $Validar,'name' => $A->name,'areaId' => $A->areaId );
            $Validar = false;
        }
        return view('pages.admins.user.update' ,compact('User','Areas','User_Area','Array_Areas', 'company'));
    }

    public function storeMaturityLevel(Request $request)
    {
        Auth::user()->authorizeRoles(['admin']);
        $descriptions = $request->input('description');
        $data = $this->validatorMaturityLevel();
        $userId = Auth::id();
        $companyId = User::giveMeCompany(Auth::user());

        if(MaturityLevel::where('companyId', '=', $companyId)->count() > 0){
            History::Logs('No pudo agregar niveles de madurez');
            return redirect('admin');
        }

        else
        $i = 1;
        do{
        foreach ($data as $description) {
             //dd($description[0]);
                MaturityLevel::create([
                    'description' => $description[$i -1],
                    'companyId' => $companyId,
                    'level' => $i
                ]);
                $i++;
        }
        }while ($i < 6);

        History::Logs('Agrego los niveles de madurez');
        return redirect('admin');
    }

    public function validatorUser()
    {
        return request()->validate([
            'username' => ['required', 'string','max:50', 'unique:users'],
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users', 'unique:companies'],
            'password' => ['required', 'string', 'min:8', 'max:255', 'confirmed'],
            'role' => ['required'],
            'areas' => ['required']
        ]);
    }

    public function validatorMaturityLevel()
    {
        return request()->validate([
            'description' => ['required','max:255']
        ]);
    }

    public function editMaturityLevel(Request $request)
    {
        Auth::user()->authorizeRoles(['admin']);
        $id = Auth::user()->companyId;
        $maturity_levels = DB::table('maturity_levels') ->where('companyId',$id)->orderby('level')->get();
        $company = DB::table('companies') ->where('companyId',$id)->first();

        return view('pages.admins.maturity.editML',compact('maturity_levels','company'));
    }

    protected function validator()
    {
        return request()->validate([
            'name' => ['required', 'string', 'max:255']
        ]);
    }

    public function createArea(Request $request)
    {
        Auth::user()->authorizeRoles(['admin']);
        $id = Auth::user()->companyId;
        $areas = DB::table('areas')->where('areas.companyId','=',$id)->get()->toArray();
        return view('pages.admins.area.addArea', compact('areas'));
    }

    public function storeArea(Request $request)
    {
        Auth::user()->authorizeRoles(['admin']);
        $attributes = $this->validator();
        $attributes['companyId'] = Auth::user()->companyId;
        $area = Area::create($attributes);

        $userId = Auth::id();
        $companyId = User::giveMeCompany(Auth::user());
        $areas = DB::table('areas')->where('areas.companyId','=',$companyId)->get()->toArray();
        History::Logs('Área '.$attributes['name'].' creada correctamente.');
        return redirect('/admin')->with('mensaje', 'Área '.$attributes['name'].' creada correctamente.');
    }

    public function showUsers(Request $request)
    {
        Auth::user()->authorizeRoles(['admin']);
        $id = Auth::user()->companyId;

        $areas = DB::table('areas')->where('areas.companyId','=',$id)->get()->toArray();

        $Users = User::join('role_user','role_user.user_id','users.id')
            ->join('user_areas', 'user_areas.userId', 'users.id')
            ->join('areas', 'user_areas.areaId', 'areas.areaId')
            ->select('users.*','role_user.role_id', 'areas.name')
            ->where('users.companyId',$id)
            ->where('role_user.role_id','>',2)->get();

        return view('pages.admins.user.index',compact('Users', 'areas'));
    }

    public function DeleteUsers(Request $request, $id)
    {
        Auth::user()->authorizeRoles(['admin']);
        /*DB::table('user_areas') ->where('userId',$id)->delete();
        DB::table('evidences') ->where('userId',$id)->delete();
        DB::table('test_user') ->where('userId',$id)->delete();
        $DeleteUser = User::findOrFail($id);
        $DeleteUser->delete();*/
        $identificador = $id;
        History::Logs('Elimino los datos del usuario con identificador '.$id.'.');
        $t = DB::table('test_user') ->where('userId',$id)->value('testId');
        //dd($t);
        Test::DeleteTest($t);
        DB::table('user_areas') ->where('userId',$id)->delete();
        $DeleteUser = User::findOrFail($id);
        $DeleteUser->delete();

        return redirect('/admins/user/index')->with('mensaje', 'Los datos del usuario fueron eliminados exitosamente');
    }

    public function cancel(Request $request)
    {
        Auth::user()->authorizeRoles(['admin']);
        return back()->with('mensajeError', 'La edición fue cancelada');
    }

    public function UpdateUsers(Request $request, $id)
    {
        Auth::user()->authorizeRoles(['admin']);

        $user = User::where('id', $id)->firstOrFail();
        $username = $request->input('username');
        $email = $request->input('email');
        $areas = $request->areasIds;

        if($email == $user->email) {
            if($username == $user->username) {
                $request->validate([
                    'firstName' => ['required', 'string', 'max:255'],
                    'lastName' => ['required', 'string', 'max:255'],
                    'areasIds' => ['required']
                ]);

                $user_data = array(
                    'firstName'  =>  $request->firstName,
                    'lastName'   =>  $request->lastName
                );
            }
            else {
                $request->validate([
                    'username' => ['required', 'string', 'max:50', 'unique:users'],
                    'firstName' => ['required', 'string', 'max:255'],
                    'lastName' => ['required', 'string', 'max:255'],
                    'areasIds' => ['required']
                ]);

                $user_data = array(
                    'username' => $request->username,
                    'firstName'  =>  $request->firstName,
                    'lastName'   =>  $request->lastName
                );
            }
        }
        elseif ($username == $user->username) {
            $request->validate([
                'firstName' => ['required', 'string', 'max:255'],
                'lastName' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'areasIds' => ['required']
            ]);

            $user_data = array(
                'firstName'  =>  $request->firstName,
                'lastName'   =>  $request->lastName,
                'email'  =>    $request->email
            );
        }
        else {
            $request->validate([
                'username' => ['required', 'string','max:50', 'unique:users'],
                'firstName' => ['required', 'string', 'max:255'],
                'lastName' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email','unique:users'],
                'areasIds' => ['required']
            ]);

            $user_data = array(
                'username' => $request->username,
                'firstName'  =>  $request->firstName,
                'lastName'   =>  $request->lastName,
                'email'  =>    $request->email
            );
        }

        User::where('id', $id)->update($user_data);

        User_Area::where('userId',$id)->delete();

        foreach ($areas as $areaId) {
            User_Area::insert([
                'userId' => $id,
                'areaId' => $areaId
            ]);
        }


        History::Logs('Actualizo los datos del usuario '.$request->username.'.');
        return back()->with('mensaje','Los datos del usuario fueron actualizados exitosamente.');
    }

    public function UpdateMaturity(Request $request)
    {
        Auth::user()->authorizeRoles(['admin']);
        $id = Auth::user()->companyId;
        $Cant = DB::table('maturity_levels') ->where('companyId',$id)->get();
        foreach ($Cant as $T)
        {
            DB::table('maturity_levels')
            ->where([['companyId','=',$id], ['maturityLevelId','=',$T->maturityLevelId]])
            ->update(['description' =>$request->maturityName[$T->maturityLevelId]]);
        }
        History::Logs('Actualizo los niveles de madurez de la empresa.');
        return back()->with('mensaje', 'Nivelez de madurez actualizados correctamente.');
    }

    public function history(Request $request)
    {
        Auth::user()->authorizeRoles(['admin']);
        $id = Auth::user()->companyId;
        $areas = DB::table('areas')->where('areas.companyId','=',$id)->get()->toArray();

        $C = Company::find(Auth::user()->companyId)->toArray();

        $Historial = History::all()->where('company',$C['name']);

        return view('pages.admins.history',compact('Historial', 'areas'));
    }

     public function historydelete(Request $request)
    {
        Auth::user()->authorizeRoles(['admin']);
        $C = Company::find(Auth::user()->companyId)->toArray();

        History::where('id','>','0')
                ->where('company',$C['name'])
                ->delete();
        return back();
    }

    public function EditTest(Request $request)
    {
        Auth::user()->authorizeRoles(['admin']);
        $id = Auth::user()->companyId;
        $company = DB::table('companies') ->where('companyId',$id)->first();
        $areas = DB::table('areas') ->where('companyId',$id)->get();
        $attribute_number = 1;
        $ml_number = 1;

        return view('pages.admins.area.test.edit',compact('areas','company', 'attribute_number', 'ml_number'));
    }

    public function showArea(Request $request,$id)
    {
        Auth::user()->authorizeRoles(['admin']);

        $TestId  = DB::table('tests') ->where('areaId',$id)->get();
         return $TestId->toJson();
    }

    public function showtest(Request $request, $id)
    {
        Auth::user()->authorizeRoles(['admin']);
        $TestId  = DB::table('tests') ->where('areaId',$id)->get();
         return $TestId->toJson();
    }

    public function showconcept(Request $request, $id)
    {
        Auth::user()->authorizeRoles(['admin']);
        $test_concept = Concept::join('test_concept','concepts.conceptId','test_concept.conceptId');
        $test_concept = $test_concept->where('testId',$id)->get();

        $list_users = User::join('role_user','users.id','role_user.user_id')
                            ->join('user_areas', 'users.id','user_areas.userId')
                            ->where([
                                ['companyId',Auth::user()->companyId],
                                ['role_id','4'],
                                ['areaId', $id]
                            ])->select('users.*')->get();

        $test_user = User::join('test_user','users.id','test_user.userId')->where('testId',$id)->get();

        return array($test_concept->toJson(),$list_users->toJson(),$test_user->toJson());
    }

    public function showLevelM(Request $request, $id)
    {
        Auth::user()->authorizeRoles(['admin']);
        $MLevel = DB::table('concept_maturity_level as CML')
        ->select('ML.description','ML.maturityLevelId')
        ->join('maturity_levels as ML','ML.maturityLevelId','CML.maturityLevelId')
        ->where('conceptId',$id)->get();

        return  $MLevel->toJson();
    }

    public function showAtributtes(Request $request, $id)
    {
        Auth::user()->authorizeRoles(['admin']);
        $Attributes = Attribute::join('concept_maturity_level_attribute as CMLA','attributes.attributeId','CMLA.attributeId')
                        ->join('concept_maturity_level as CML','CMLA.conceptMLId','CML.conceptMLId')
                        ->join('maturity_levels as ML','CML.maturityLevelId','ML.maturityLevelId')
                        ->select('attributes.attributeId','attributes.description as AD','attributes.suggestion as AS','ML.description as ML')
                        ->where('CML.conceptId',$id)->orderByDesc('attributes.attributeId')->get();
        return  $Attributes->toJson();
    }
}
