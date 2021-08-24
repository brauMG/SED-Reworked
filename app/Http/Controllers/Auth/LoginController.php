<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\History;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    public function username()
    {
        return 'username';
    }
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected function authenticated($request, $user)
    {
        $companyStatus = Company::where('companyId',$user->companyId)->get();
        if ($companyStatus[0]->status == 1){
            if($user->hasRole('superadmin')) {
                return redirect('/superAdmin');
            } elseif ($user->hasRole('admin')) {
                History::Logs('Inicio de sesión de un administrador');
                return redirect('/admin');
            } elseif ($user->hasRole('analista')) {
                History::Logs('Inicio de sesión de un analista');
                return redirect('/analista');
            }
            elseif ($user->hasRole('comun')){
                History::Logs('Inicio de sesión de usuario');
                return redirect('/comun');
            }
            else{
                return redirect('/login');
            }
        }
        else{
            Auth::logout();
            return redirect('/login');
        }
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
