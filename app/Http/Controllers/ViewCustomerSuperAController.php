<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Company;

class ViewCustomerSuperAController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware(['auth', 'verified']);
//    }

    public function show(Request $request,$id)
    {
        Auth::user()->authorizeRoles(['superAdmin']);
    	$admin = User::join('companies','companies.companyId','users.companyId')
        ->select('users.*','companies.*','users.email as emailuser','companies.email as emailcompany')
        ->where('users.id',$id)->firstOrFail();

    	return view('pages.superAdmin.viewCostumers.showAdmin' ,compact('admin'));
    }

    public function edit(Request $request, $id)
    {
        Auth::user()->authorizeRoles(['superAdmin']);
        $admin = User::join('companies','companies.companyId','users.companyId')
            ->select('users.*','companies.*','users.email as emailuser','companies.email as emailcompany')
            ->where('users.id',$id)->firstOrFail();
        return view('pages.superAdmin.viewCostumers.editAdmin', compact('admin'));
    }

    public function cancel(Request $request)
    {
        Auth::user()->authorizeRoles(['superAdmin']);
        return back()->with('mensajeError', 'La edición fue cancelada');
    }

    public function update(Request $request, $uid)
    {
        Auth::user()->authorizeRoles(['superAdmin']);

        $admin = User::join('companies','companies.companyId','users.companyId')
            ->select('users.*','companies.*','users.email as emailuser','companies.email as emailcompany')
            ->where('users.id',$uid)->firstOrFail();

        $email = $request->input('email');
        $username = $request->input('username');
        if($email == $admin->emailuser) {
            if($username == $admin->username) {
                $request->validate([
                    'firstName' => ['required', 'string', 'max:255'],
                    'lastName' => ['required', 'string', 'max:255'],
                ]);

                $user_data = array(
                    'firstName'  =>  $request->firstName,
                    'lastName'   =>  $request->lastName
                );
            }
            else {
                $request->validate([
                    'firstName' => ['required', 'string', 'max:255'],
                    'lastName' => ['required', 'string', 'max:255'],
                    'username' => ['required', 'string', 'max:255', 'unique:users'],
                ]);

                $user_data = array(
                    'firstName'  =>  $request->firstName,
                    'lastName'   =>  $request->lastName,
                    'username'  =>    $request->username
                );
            }
        }
        elseif ($username == $admin->username) {
            $request->validate([
                'firstName' => ['required', 'string', 'max:255'],
                'lastName' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users']
            ]);

            $user_data = array(
                'firstName'  =>  $request->firstName,
                'lastName'   =>  $request->lastName,
                'email'  =>    $request->email
            );
        }
        else {
            $request->validate([
                'firstName' => ['required', 'string', 'max:255'],
                'lastName' => ['required', 'string', 'max:255'],
                'username' => ['required', 'string','max:255', 'unique:users'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users']
            ]);

            $user_data = array(
                'firstName'  =>  $request->firstName,
                'lastName'   =>  $request->lastName,
                'username'  =>    $request->username,
                'email'=>   $request->email
            );
        }


        User::find($uid)->update($user_data);

        return back()->with('mensaje', 'Datos actualizados exitosamente.');
    }

    public function delete(Request $request,$id)
    {
        $companyData = Company::where('companyId', $id)->get()->toArray();
        $status = $companyData[0]['status'];
        $new_status = 0;

        if ($status == 0){
            $new_status = 1;
        }

        Company::find($id)->update(['status' => $new_status]);
        return back()->with('mensaje', 'El estado fue actualizado exitosamente.');
    }

    public function destroy(Request $request, $id, $companyId)
    {
        $totalUsersOfCompany = User::where('companyId', $companyId)->get();
        $totalUsersOfCompanyIds = $totalUsersOfCompany->pluck('id');
        $totalUsersThatAreAdmins = [];

        for ($i = 0; $i < count($totalUsersOfCompanyIds); $i++) {
            $totalUsersThatAreAdmins[] = App\Role_User::where('user_id', $totalUsersOfCompanyIds[$i])->where('role_id', 2)->get()->toArray();
        }

        $totalUsersThatAreAdmins = array_values(array_filter($totalUsersThatAreAdmins));

        $adminsTotalData = [];

        for ($i = 0; $i < count($totalUsersThatAreAdmins); $i++) {
            $adminsTotalData[] = $totalUsersThatAreAdmins[$i][0];
        }

        if(count($adminsTotalData) == 1){
            return back()->with('mensajeError', 'No se puede eliminar este administrador debido a que no hay mas administradores asignados a su empresa.');
        }
        else{
            User::find($id)->delete();
            App\Role_User::where('user_id', $id)->delete();
            return redirect('/superAdmin')->with('mensaje', 'El administrador fue eliminado exitosamente');
        }
    }
}
