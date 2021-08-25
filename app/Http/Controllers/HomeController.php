<?php
namespace App\Http\Controllers;
//use auth to get current authenticated user
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//      $this->middleware(['auth', 'verified']);
//    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function index(User $user, Request $request)
    {
        if ($request->user()->hasRole('superadmin')) {
            return redirect('/superAdmin');
        }
        if ($request->user()->hasRole('admin')) {
            return redirect('/admin');
        }
        if ($request->user()->hasRole('analista')) {
            return redirect('/analista');
        }
        if ($request->user()->hasRole('comun')) {
            return redirect('/comun');
        }
    }
}
