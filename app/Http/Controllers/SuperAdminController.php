<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\History;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class SuperAdminController extends Controller
{

    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['superAdmin']);
    	$user = User::all();
        $Admins = User::join('companies','companies.companyId','=','users.companyId')
            ->join('role_user','role_user.user_id','=','users.id')
            ->select('companies.*','users.firstName','users.lastName','users.username','users.id','companies.status')
            ->where('role_user.role_id','2')->get();

        return view('superAdmin.index', compact('Admins'));
    }

    public function cancel(Request $request)
    {
        $request->user()->authorizeRoles(['superAdmin']);
        return back()->with('mensajeError', 'La edición fue cancelada');
    }

    public function create(Request $request)
    {
        $request->user()->authorizeRoles(['superAdmin']);
        $this->authorize('view');
       $countCompanies = Company::where('status','=','1')->count();

       if($countCompanies == 0){
            return view('superAdmin.addCompany.create');
       }
       else{
            return view('superAdmin.create');
       }
    }

    public function createCompany()
    {
        $this->authorize('view');


        return view('superAdmin.addCompany.create');
    }


    public function storeCompany()
    {
       $this->authorize('view');

        $attributes = $this->validatorCompany();
        $companies = Company::create($attributes);

        return redirect('/superAdmin')->with('mensaje', 'Empresa '.$attributes['name'].' creada correctamente.');
    }

    protected function validatorCompany()
    {
       $this->authorize('view');

        return request()->validate([
            'name' => ['required', 'string', 'max:255', 'unique:companies'],
            'address' => ['required', 'string', 'max:5000'],
            'phoneNumber' => ['required', 'numeric','digits:10' ],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);
    }
    public function createAdmin()
    {
       $this->authorize('view');

        $companies = Company::all(['companyId', 'name']);
        return view('superAdmin.addAdmin.create', compact('companies'));
    }
    public function storeAdmin()
    {
       $this->authorize('view');

        $data = $this->validatorAdmin();
        $admins = User::create([
            'username' => $data['username'],
            'firstName' => $data['username'],
            'lastName' => $data['lastName'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'companyId' => $data['companyId']
        ]);

        $admins->roles()->attach(Role::where('id', 2)->first());

        return redirect('/superAdmin')->with('mensaje', 'Administrador '.$data['username'].' creado correctamente.');
    }

    protected function validatorAdmin()
    {
       $this->authorize('view');

        return request()->validate([
            'username' => ['required', 'string','max:255', 'unique:users'],
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'max:255', 'confirmed'],
            'companyId' => ['required']
        ]);
    }

    public function showCompany()
    {
        $Com = DB::table('companies') ->get();

        return view('/superAdmin/viewCompanies/create', compact('Com'));
    }

    public function show($id)
    {
        $admin = DB::table('companies')
        ->where('companyId',$id)
        ->first();

//        dd($admin);
        return view('superAdmin/viewCompanies/showCompany', compact('admin'));
    }

    public function update(Request $request,$id)
    {
        $request->user()->authorizeRoles(['superAdmin']);

        $company = Company::where('companyId', $id)->firstOrFail();
        $name = $request->input('name');
        $email = $request->input('email');

        if($email == $company->email) {
            if($name == $company->name) {
                $request->validate([
                    'address' => ['required', 'string', 'max:255'],
                    'phoneNumber' => ['required', 'numeric','digits:10' ]
                ]);

                $user_data = array(
                    'address'  =>  $request->address,
                    'phoneNumber'   =>  $request->phoneNumber
                );
            }
            else {
                $request->validate([
                    'address' => ['required', 'string', 'max:255'],
                    'phoneNumber' => ['required', 'numeric','digits:10' ],
                    'name' => ['required', 'string', 'max:255', 'unique:companies'],
                ]);

                $user_data = array(
                    'address'  =>  $request->address,
                    'phoneNumber'   =>  $request->phoneNumber,
                    'name'  =>    $request->name
                );
            }
        }
        elseif ($name == $company->name) {
            $request->validate([
                'address' => ['required', 'string', 'max:255'],
                'phoneNumber' => ['required', 'numeric','digits:10' ],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:companies']
            ]);

            $user_data = array(
                'address'  =>  $request->address,
                'phoneNumber'   =>  $request->phoneNumber,
                'email'  =>    $request->email
            );
        }
        else {
            $request->validate([
                'name' => ['required', 'string', 'max:255', 'unique:companies'],
                'address' => ['required', 'string', 'max:255'],
                'phoneNumber' => ['required', 'numeric','digits:10' ],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:companies'],
            ]);

            $user_data = array(
                'name' => $request->name,
                'address'  =>  $request->address,
                'phoneNumber'   =>  $request->phoneNumber,
                'email'  =>    $request->email
            );
        }

        Company::where('companyId', $id)->update($user_data);

        return back()->with('mensaje', 'Datos Actualizados');
    }

    public function edit($id)
    {
        $admin = DB::table('companies')
            ->where('companyId',$id)
            ->first();

//        dd($admin);
        return view('superAdmin/viewCompanies/editCompany', compact('admin'));
    }
}
