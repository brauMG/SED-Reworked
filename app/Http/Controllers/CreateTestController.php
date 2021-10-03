<?php


namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\ConceptMaturityLevel;
use App\Models\History;
use App\Models\Test;
use App\Models\Attribute;
use App\Models\Role;
use App\Models\Role_User;
use App\Models\TestConcept;
use App\Models\TestUser;
use App\Models\User;
use App\Models\Concept;
use App\Models\User_Area;
use App\Models\Company;
use App\Models\MaturityLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateTestController
{
    //    public function __construct(Request $request)
//    {
//        $this->middleware(['auth', 'verified']);
//    }

    public function index(Request $request)
    {
        Auth::user()->authorizeRoles(['admin']);
        $user = auth()->user();
        $userCompany = $user->companyId;
        $id = Auth::user()->companyId;
        $areas = DB::table('areas')->where('areas.companyId','=',$id)->get()->toArray();

        $dataTests = TestUser::join('tests', 'tests.testId', '=', 'test_user.testId')
            ->join('users','users.id','=','test_user.userId')
            ->join('test_concept','tests.testId','=','test_concept.testId')
            ->join('concepts','test_concept.conceptId','=','concepts.conceptId')
            ->join('areas','tests.areaId','=','areas.areaId')
            ->select(
                'areas.name as areaName',
                'tests.name as testName',
                'concepts.description as conceptName',
                'users.username as user',
                'concepts.conceptId',
                'tests.testId'
            )
            ->where('areas.companyId', $userCompany)->get()->toArray();

        return view('pages.admins.area.test.listTest', compact('dataTests', 'areas'));
    }

    public function show($conceptId){
        $testId = TestConcept::where('conceptId', $conceptId)->get()->toArray();
        $testId = $testId[0]['testId'];
        $testId = Test::where('testId', $testId)->get()->toArray();
        $testData = $testId[0];
        $testId = $testId[0]['testId'];
        $id = Auth::user()->companyId;
        $areas = DB::table('areas')->where('areas.companyId','=',$id)->get()->toArray();

        $test_concept = Concept::join('test_concept','concepts.conceptId','test_concept.conceptId')->where('test_concept.conceptId', $conceptId);
        $test_concept = $test_concept->where('testId',$testId)->get()->toArray();

        $test_concept_data = $test_concept[0];

        $test_user = User::join('test_user','users.id','test_user.userId')->where('testId',$testId)->get()->toArray();

        $test_user_data = $test_user[0];

        $User = User::find($test_user_data['id'])->toArray();
        $company = Company::where('companyId', $User['companyId'])->first();

        $MLevel = DB::table('concept_maturity_level as CML')
            ->select('ML.description','ML.maturityLevelId')
            ->join('maturity_levels as ML','ML.maturityLevelId','CML.maturityLevelId')
            ->where('conceptId',$conceptId)->get()->toArray();

        $Attributes = Attribute::join('concept_maturity_level_attribute as CMLA','attributes.attributeId','CMLA.attributeId')
            ->join('concept_maturity_level as CML','CMLA.conceptMLId','CML.conceptMLId')
            ->join('maturity_levels as ML','CML.maturityLevelId','ML.maturityLevelId')
            ->select('attributes.attributeId','attributes.description as AD','attributes.suggestion as AS','ML.description as ML')
            ->where('CML.conceptId',$conceptId)->orderByDesc('attributes.attributeId')->get()->toArray();

        $attribute = array_reverse($Attributes);

        return view('pages.admins.area.test.showTest',compact('test_concept_data','test_user_data', 'MLevel', 'attribute', 'company', 'testData', 'conceptId', 'testId', 'areas'));
    }

    public function edit($conceptId){
        $testId = TestConcept::where('conceptId', $conceptId)->get()->toArray();
        $id = Auth::user()->companyId;
        $areas = DB::table('areas')->where('areas.companyId','=',$id)->get()->toArray();
        $testId = $testId[0]['testId'];
        $testId = Test::where('testId', $testId)->get()->toArray();
        $testData = $testId[0];
        $testId = $testId[0]['testId'];
        $user = auth()->user();
        $userCompany = $user->companyId;
        $groupML = DB::table('maturity_levels_group')->where('maturity_levels_group.companyId','=',$userCompany)->get()->toArray();
        $actualGroupML = Concept::join('test_concept', 'test_concept.conceptId', 'concepts.conceptId')
                        ->join('tests', 'tests.testId', 'test_concept.testId')
                        ->join('maturity_levels_group', 'maturity_levels_group.MLGroupId', 'tests.MLGroupId')
                        ->select('maturity_levels_group.MLGroupId','maturity_levels_group.name')
                        ->where('concepts.conceptId', $conceptId)
                        ->get()->toArray();

        $test_concept = Concept::join('test_concept','concepts.conceptId','test_concept.conceptId')->where('test_concept.conceptId', $conceptId);
        $test_concept = $test_concept->where('testId',$testId)->get()->toArray();

        $test_concept_data = $test_concept[0];

        $test_user = User::join('test_user','users.id','test_user.userId')->where('testId',$testId)->get()->toArray();

        $test_user_data = $test_user[0];

        $User = User::find($test_user_data['id'])->toArray();
        $company = Company::where('companyId', $User['companyId'])->first();

        $MLevel = DB::table('concept_maturity_level as CML')
            ->select('ML.description','ML.maturityLevelId')
            ->join('maturity_levels as ML','ML.maturityLevelId','CML.maturityLevelId')
            ->where('conceptId',$conceptId)->get()->toArray();

        $Attributes = Attribute::join('concept_maturity_level_attribute as CMLA','attributes.attributeId','CMLA.attributeId')
            ->join('concept_maturity_level as CML','CMLA.conceptMLId','CML.conceptMLId')
            ->join('maturity_levels as ML','CML.maturityLevelId','ML.maturityLevelId')
            ->select('attributes.attributeId','attributes.description as AD','attributes.suggestion as AS','ML.description as ML')
            ->where('CML.conceptId',$conceptId)->orderByDesc('attributes.attributeId')->get()->toArray();

        $users = User_Area::join('users', 'users.id', 'user_areas.userId')
            ->join('role_user', 'role_user.user_id', 'users.id')
            ->select('users.*')
            ->where('role_user.role_id', 4)
            ->where('user_areas.areaId', $testData['areaId'])->get()->toArray();

        $attribute = array_reverse($Attributes);

        return view('pages.admins.area.test.editTest',compact('test_concept_data','test_user_data', 'MLevel', 'attribute', 'company', 'testData', 'conceptId', 'testId', 'users', 'groupML', 'actualGroupML', 'areas'));
    }

    public function update(Request $request, $conceptId)
    {
        Auth::user()->authorizeRoles(['admin']);

        $request->validate([
            'testName' => ['required', 'string','max:255'],
            'username' => ['required', 'string', 'max:50'],
            'groupML' => ['required'],
            'conceptName' => ['required', 'string', 'max:5000'],
            'attribute1' => ['required', 'string','max:5000'],
            'suggestion1' => ['required', 'string','max:5000'],
            'attribute2' => ['required', 'string','max:5000'],
            'suggestion2' => ['required', 'string','max:5000'],
            'attribute3' => ['required', 'string','max:5000'],
            'suggestion3' => ['required', 'string','max:5000'],
            'attribute4' => ['required', 'string','max:5000'],
            'suggestion4' => ['required', 'string','max:5000'],
            'attribute5' => ['required', 'string','max:5000'],
            'suggestion5' => ['required', 'string','max:5000'],
            'attribute6' => ['required', 'string','max:5000'],
            'suggestion6' => ['required', 'string','max:5000'],
            'attribute7' => ['required', 'string','max:5000'],
            'suggestion7' => ['required', 'string','max:5000'],
            'attribute8' => ['required', 'string','max:5000'],
            'suggestion8' => ['required', 'string','max:5000'],
            'attribute9' => ['required', 'string','max:5000'],
            'suggestion9' => ['required', 'string','max:5000'],
            'attribute10' => ['required', 'string','max:5000'],
            'suggestion10' => ['required', 'string','max:5000'],
            'attribute11' => ['required', 'string','max:5000'],
            'suggestion11' => ['required', 'string','max:5000'],
            'attribute12' => ['required', 'string','max:5000'],
            'suggestion12' => ['required', 'string','max:5000'],
            'attribute13' => ['required', 'string','max:5000'],
            'suggestion13' => ['required', 'string','max:5000'],
            'attribute14' => ['required', 'string','max:5000'],
            'suggestion14' => ['required', 'string','max:5000'],
            'attribute15' => ['required', 'string','max:5000'],
            'suggestion15' => ['required', 'string','max:5000'],
        ]);

        $testId = TestConcept::where('conceptId', $conceptId)->get()->toArray();
        $testId = $testId[0]['testId'];
        $testId = Test::where('testId', $testId)->get()->toArray();
        $testData = $testId[0];
        $testId = $testId[0]['testId'];

        $testName = $request->testName;
        $userId = $request->username;
        $conceptDescription = $request->conceptName;
        $attributes = [
            $request->attribute1,
            $request->attribute2,
            $request->attribute3,
            $request->attribute4,
            $request->attribute5,
            $request->attribute6,
            $request->attribute7,
            $request->attribute8,
            $request->attribute9,
            $request->attribute10,
            $request->attribute11,
            $request->attribute12,
            $request->attribute13,
            $request->attribute14,
            $request->attribute15
        ];

        $suggestions = [
            $request->suggestion1,
            $request->suggestion2,
            $request->suggestion3,
            $request->suggestion4,
            $request->suggestion5,
            $request->suggestion6,
            $request->suggestion7,
            $request->suggestion8,
            $request->suggestion9,
            $request->suggestion10,
            $request->suggestion11,
            $request->suggestion12,
            $request->suggestion13,
            $request->suggestion14,
            $request->suggestion15
        ];

        $i = 0;
        $j = 0;

        $maturity = DB::table('maturity_levels')->where('maturity_levels.MLGroupId','=', $request->input('groupML'))->get()->toArray();
        $newGroupId = $maturity[0]->MLGroupId;

        $actualGroupML = Concept::join('test_concept', 'test_concept.conceptId', 'concepts.conceptId')
            ->join('tests', 'tests.testId', 'test_concept.testId')
            ->join('maturity_levels_group', 'maturity_levels_group.MLGroupId', 'tests.MLGroupId')
            ->join('concept_maturity_level', 'concept_maturity_level.conceptId', 'concepts.conceptId')
            ->select('concept_maturity_level.*')
            ->where('concepts.conceptId', $conceptId)
            ->get()->toArray();

        $actualGroupMLId = Concept::join('test_concept', 'test_concept.conceptId', 'concepts.conceptId')
            ->join('tests', 'tests.testId', 'test_concept.testId')
            ->join('maturity_levels_group', 'maturity_levels_group.MLGroupId', 'tests.MLGroupId')
            ->select('maturity_levels_group.MLGroupId','maturity_levels_group.name')
            ->where('concepts.conceptId', $conceptId)
            ->get()->toArray();

        foreach ($actualGroupML as $id) {
            ConceptMaturityLevel::where('conceptMLId', $id['conceptMLId'])->update([
                'maturityLevelId' => $maturity[$j]->maturityLevelId
            ]);
            $j++;
        }

        $actualAttributes = Attribute::join('concept_maturity_level_attribute as CMLA','attributes.attributeId','CMLA.attributeId')
            ->join('concept_maturity_level as CML','CMLA.conceptMLId','CML.conceptMLId')
            ->join('maturity_levels as ML','CML.maturityLevelId','ML.maturityLevelId')
            ->select('attributes.attributeId','attributes.description as AD','attributes.suggestion as AS','ML.description as ML')
            ->where('CML.conceptId',$conceptId)->orderByDesc('attributes.attributeId')->get()->toArray();

        $actualAttributes = array_reverse($actualAttributes);

        $actualUserId = TestUser::where('testId', $testId)->select('test_user.userId')->get()->toArray();
        $actualUserId = $actualUserId[0]['userId'];

        Test::where('testId', $testId)->update([
            'name' => $testName,
            'MLGroupId' => $newGroupId
        ]);

        TestUser::where('testId', $testId)->where('userId', $actualUserId)->update(['userId' => $userId]);

        Concept::where('conceptId', $conceptId)->update(['description' => $conceptDescription]);

        foreach ($actualAttributes as $actualAttribute) {
            Attribute::where('attributeId', $actualAttribute)->update([
                'description' => $attributes[$i],
                'suggestion' => $suggestions[$i]
            ]);
            $i++;
        }

        return back()->with('mensaje','Los datos de la prueba fueron actualizados exitosamente.');
    }

    public function cancel(Request $request)
    {
        Auth::user()->authorizeRoles(['admin']);
        return back()->with('mensajeError', 'La edición fue cancelada');
    }

    public function create(Request $request)
    {
        Auth::user()->authorizeRoles(['admin']);
        $id = Auth::user()->companyId;
        $areas2 = DB::table('areas')->where('areas.companyId','=',$id)->get()->toArray();
        $user = auth()->user();
        $userCompany = $user->companyId;
//        $areas = DB::table('areas')->where('areas.companyId','=',$userCompany)->get()->toArray();
        $roles = Role::all(['id']);
        $users = User::all(['id', 'firstName', 'lastName', 'companyId']);
        $role_user = Role_User::all();
        $tests = Test::all();
        $groupML = DB::table('maturity_levels_group')->where('maturity_levels_group.companyId','=',$userCompany)->get()->toArray();
        $attribute_number = 1;
        $ml_number = 1;
        $repeat = [1,2,3,4,5];

        return view('pages.admins.area.test.create', compact(/*'areas',*/ 'userCompany', 'roles', 'role_user', 'users', 'groupML', 'tests','attribute_number','ml_number', 'repeat', 'areas2') );
    }

    public function store(Request $request)
    {
//        $user = auth()->user();
//        $companyId = $user->companyId;
//        $areaId = $request->input('area');
//        $userId = $request->input('user');
        $MLGroupId = $request->input('groupML');
        $muy_bajos = $request->input('muy_bajo');
        $bajos = $request->input('bajo');
        $intermedios = $request->input('intermedio');
        $altos = $request->input('alto');
        $muy_altos = $request->input('muy_alto');
        $muy_bajos_sugerencias = $request->input('muy_bajo_sugerencia');
        $bajos_sugerencias = $request->input('bajo_sugerencia');
        $intermedios_sugerencias = $request->input('intermedio_sugerencia');
        $altos_sugerencias = $request->input('alto_sugerencia');
        $muy_altos_sugerencias = $request->input('muy_alto_sugerencia');
        $dataConcept = $this->validatorConcept();
        $dataArea = $this->validatorArea();
        $dataUser = $this->validatorUser();
        $maturity = DB::table('maturity_levels')->where('maturity_levels.MLGroupId','=', $MLGroupId)->get()->toArray();
        $addTest = Test::create([
            'startedAt' => date('Y-m-d'),
            'areaId' => $dataArea['area'],
            'name' => $request['name'],
            'MLGroupId' => $request['groupML']
        ]);
        $addTest->test_user()->attach($dataUser);

        $conceptAdd = Concept::create([
            'description' => $dataConcept['concept']
        ]);
        $addTest->test_concept()->attach($conceptAdd->conceptId);

        $i = 0;
        foreach ($muy_bajos as $muy_bajo)
        {
            if ($i == 0){
            $conceptAdd->concept_maturity_level()->attach($maturity[0]->maturityLevelId);
            } $i++;

            $addAttribute = Attribute::create([
                'description'=> $muy_bajo,
                'suggestion' => $muy_bajos_sugerencias[$i -1],
                'send' => false
            ]);
            $concept_maturity_level = DB::table('concept_maturity_level')->get()->toArray();
            $addAttribute->concept_maturity_level_attribute()->attach(end($concept_maturity_level)->conceptMLId);
        }

        $i = 0;
        foreach ($bajos as $bajo)
        {
            if ($i == 0){
                $conceptAdd->concept_maturity_level()->attach($maturity[1]->maturityLevelId);
            } $i++;

            $addAttribute = Attribute::create([
                'description'=> $bajo,
                'suggestion' => $bajos_sugerencias[$i -1],
                'send' => false
            ]);
            $concept_maturity_level = DB::table('concept_maturity_level')->get()->toArray();
            $addAttribute->concept_maturity_level_attribute()->attach(end($concept_maturity_level)->conceptMLId);        }

        $i = 0;
        foreach ($intermedios as $intermedio)
        {
            if ($i == 0){
                $conceptAdd->concept_maturity_level()->attach($maturity[2]->maturityLevelId);
            } $i++;

            $addAttribute = Attribute::create([
                'description'=> $intermedio,
                'suggestion' => $intermedios_sugerencias[$i -1],
                'send' => false
            ]);
            $concept_maturity_level = DB::table('concept_maturity_level')->get()->toArray();
            $addAttribute->concept_maturity_level_attribute()->attach(end($concept_maturity_level)->conceptMLId);        }

        $i = 0;
        foreach ($altos as $alto)
        {
            if ($i == 0){
                $conceptAdd->concept_maturity_level()->attach($maturity[3]->maturityLevelId);
            } $i++;

            $addAttribute = Attribute::create([
                'description'=> $alto,
                'suggestion' => $altos_sugerencias[$i -1],
                'send' => false
            ]);
            $concept_maturity_level = DB::table('concept_maturity_level')->get()->toArray();
            $addAttribute->concept_maturity_level_attribute()->attach(end($concept_maturity_level)->conceptMLId);        }

        $i = 0;
        foreach ($muy_altos as $muy_alto)
        {
            if ($i == 0){
                $conceptAdd->concept_maturity_level()->attach($maturity[4]->maturityLevelId);
            } $i++;

            $addAttribute = Attribute::create([
                'description'=> $muy_alto,
                'suggestion' => $muy_altos_sugerencias[$i -1],
                'send' => false
            ]);
            $concept_maturity_level = DB::table('concept_maturity_level')->get()->toArray();
            $addAttribute->concept_maturity_level_attribute()->attach(end($concept_maturity_level)->conceptMLId);        }

        History::Logs('Prueba '.$addTest['name'].' creada correctamente.');
        return redirect('/admins/area/test/listTest')->with('mensaje', 'Prueba '.$addTest['name'].' creada correctamente.');
    }

    public function duplicate(Request $request)
    {
        Auth::user()->authorizeRoles(['admin']);
        $id = Auth::user()->companyId;
        $areas2 = DB::table('areas')->where('areas.companyId','=',$id)->get()->toArray();
        $user = auth()->user();
        $userCompany = $user->companyId;
//        $areas = DB::table('areas')->where('areas.companyId','=',$userCompany)->get()->toArray();
        $roles = Role::all(['id']);
        $users = User::all(['id', 'firstName', 'lastName', 'companyId']);
        $role_user = Role_User::all();
        $tests = Test::all();
        $pruebas = DB::table('tests')
            ->join('areas', 'tests.areaId', 'areas.areaId')
            ->join('test_user', 'tests.testId', 'test_user.testId')
            ->join('users', 'test_user.userId', 'users.id')
            ->where('areas.companyId', Auth::user()->companyId)
            ->select('tests.*', 'users.username as user')
            ->get();

        $groupML = DB::table('maturity_levels_group')->where('maturity_levels_group.companyId','=',$userCompany)->get()->toArray();

        return view('pages.admins.area.test.duplicate', compact(/*'areas',*/ 'userCompany', 'roles', 'role_user', 'users', 'tests', 'areas2', 'pruebas', 'groupML') );
    }

    public function duplicate_store(Request $request)
    {
        $MLGroupId = $request->input('groupML');
        $dataArea = $this->validatorArea();
        $dataUser = $this->validatorUser();
        $dataTestToDuplicate = $request->input('duplicateTest');
        $originalTest = Test::where('testId', $dataTestToDuplicate)->get();
        $originalTest = $originalTest[0];
        $maturity = DB::table('maturity_levels')->where('maturity_levels.MLGroupId','=', $MLGroupId)->get()->toArray();

        $addTest = Test::create([
            'startedAt' => date('Y-m-d'),
            'areaId' => $dataArea['area'],
            'name' => $request['name'],
            'MLGroupId' => $request['groupML']
        ]);
        $addTest->test_user()->attach($dataUser);

        $old_concepts = DB::table('test_concept')
            ->join('concepts', 'test_concept.conceptId', 'concepts.conceptId')
            ->where('test_concept.testId', $originalTest->testId)
            ->get();

        foreach ($old_concepts as $old_concept) {
            $conceptAdd = Concept::create([
                'description' => $old_concept->description
            ]);
            $addTest->test_concept()->attach($conceptAdd->conceptId);

            for($i = 0; $i < 5; $i++) {
                $conceptAdd->concept_maturity_level()->attach($maturity[$i]->maturityLevelId);
            }

            $original_concept_maturity_level = DB::table('concept_maturity_level')
                ->join('concept_maturity_level_attribute', 'concept_maturity_level.conceptMLId', 'concept_maturity_level_attribute.conceptMLId')
                ->join('attributes', 'concept_maturity_level_attribute.attributeId', 'attributes.attributeId')
                ->where('concept_maturity_level.conceptId', $old_concept->conceptId)
                ->select('concept_maturity_level_attribute.*', 'attributes.*')
                ->get();

            foreach ($original_concept_maturity_level as $original) {
                $addAttribute = Attribute::create([
                    'description'=> $original->description,
                    'suggestion' => $original->suggestion,
                    'send' => false
                ]);
                $concept_maturity_level = DB::table('concept_maturity_level')->get()->toArray();
                $addAttribute->concept_maturity_level_attribute()->attach(end($concept_maturity_level->conceptMLId));
            }

            History::Logs('Prueba/Concepto '.$addTest['name'].' duplicada correctamente.');
        }

        return redirect('/admins/area/test/listTest')->with('mensaje', 'Duplicado correctamente.');
    }

    public function validatorConcept()
    {
        return request()->validate([
            'concept' => ['required', 'string','max:5000']]);
    }

    public function validatorArea()
    {
        return request()->validate([
            'area' => 'required','max:255']);
    }

    public function validatorUser()
    {
        return request()->validate([
            'user' => 'required']);
    }

    public function DeleteTest(Request $request, $id)
    {
        History::Logs('Elimino el test con identificador '.$id.'.');
        Test::DeleteTest($id);
        return redirect('/admins/area/test/listTest')->with('mensaje', 'La prueba fue eliminada.');
    }

    public function DeleteConcept(Request $request, $id)
    {
        History::Logs('Elimino el concepto con identificador '.$id.'.');
        Concept::DeleteConcept($id);
        return redirect('/admins/area/test/listTest')->with('mensaje', 'El concepto fue eliminado de la prueba.');
    }

    public function getUsers(Request $request)
    {
        if ($request->ajax()) {
            $role = 0;
            $i = 0;
            $usersArray = array();
            $UserArea = DB::table('user_areas')->where('areaId', '=', $request->area)->get();
            $pluckUserArea = $UserArea->pluck('userId');
            foreach ($pluckUserArea as $user){
                $users = DB::table('users')->where('id','=', $pluckUserArea[$i])->get();
                foreach ($users as $user){
                    $UserRole = DB::table('role_user')->where('user_id','=', $user->id)->first();
                    $role = $UserRole->role_id;
                    if($role == 4) {
                        $usersArray[$user->id] = $user->username;
                    }
                }
                $i++;
            }
            return response()->json($usersArray);
        }
    }
}
