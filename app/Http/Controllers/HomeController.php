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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(User $user, Request $request)
    {
     $request->user()->authorizeRoles(['comun','admin','superAdmin','analista']);
        $user = Auth::user();
        return view('home', compact('user'));
    }
}
