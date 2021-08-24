<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;

use App\Models\Company;
use App\Models\User;

class CompanyController extends Controller
{

//    public function __construct()
//    {
//        $this->middleware(['auth', 'verified']);
//    }

    public function index()
    {
     $company = Company::all();
        return view('company.index', compact('company'));

    }
    public function show(Company $company)
   {
       $this->authorize('view', $company);
        return view('company.show', compact('company'));

    }

    public function create()
    {

        return view('company.create');
    }

    public function store()
    {
        $attributes = $this->validator();
        // $attributes['user_id'] = auth()->id();
        $company = Company::create($attributes);

        return redirect('/company');
    }
    protected function validator()
    {
        return request()->validate([
            'name' => ['required', 'string', 'max:255', 'unique:companies'],
            'address' => ['required', 'string', 'max:5000','unique:companies'],
            'phoneNumber' => ['required', 'numeric', 'unique:companies' ],
            // 'phoneNumber' => ['required|numeric|phone'],

            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);
    }
    public function destroy(Company $company)
    {
       $this->authorize('delete', $company);

         $company->delete();

         return redirect('/company');
    }

    public function status(Request $request,$id)
    {
        Company::find($id)->update(['status' => $request->status]);
        return back();
    }
}
