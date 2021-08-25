<?php


namespace App\Http\Controllers;


use App\Models\Area;
use App\Models\Company;
use App\Models\Sponsors;
use App\Models\SponsorsCompanies;
use App\Models\User;
use Illuminate\Http\Request;

class SponsorsController
{
    public function showList(Request $request)
    {
        Auth::user()->authorizeRoles(['superAdmin']);
        $sponsors = Sponsors::all();
        return view('pages.superAdmin.viewSponsors.listSponsors', compact('sponsors'));
    }

    public function show(Request $request, $id)
    {
        Auth::user()->authorizeRoles(['superAdmin']);
        $sponsor = Sponsors::where('sponsorId', $id)->firstOrFail();

        $companies = Company::join('sponsors_companies', 'sponsors_companies.companyId', 'companies.companyId')
            ->where('sponsors_companies.sponsorId', $id)
            ->get()->toArray();

        return view('pages.superAdmin.viewSponsors.showSponsors', compact('sponsor', 'companies'));
    }

    public function edit(Request $request, $id)
    {
        Auth::user()->authorizeRoles(['superAdmin']);
        $sponsor = Sponsors::where('sponsorId', $id)->firstOrFail();
        $companies = Company::all();
        $sponsors_companies = Company::join('sponsors_companies', 'sponsors_companies.companyId', 'companies.companyId')
            ->where('sponsors_companies.sponsorId', $id)
            ->get();

        $valid = false;
        $array_companies = array();
        foreach ($companies as $company) {
            foreach ($sponsors_companies as $SC) {
                if($company->companyId == $SC->companyId){
                    $valid = true;
                }
            }
            $array_companies[] = array('valid' => $valid, 'name' => $company->name, 'companyId' => $company->companyId );
            $valid = false;
        }

        return view('pages.superAdmin.viewSponsors.editSponsor', compact('sponsor', 'companies', 'array_companies'));
    }

    public function cancel(Request $request)
    {
        Auth::user()->authorizeRoles(['superAdmin']);
        return back()->with('mensajeError', 'La edición fue cancelada');
    }

    public function update(Request $request, $sponsorId)
    {
        Auth::user()->authorizeRoles(['superAdmin']);
        $companies = $request->input('companies');
        $show = $request->input('show');

        $image_name = $request->hidden_image;
        $image = $request->file('image');
        if($image != '')
        {
            $request->validate([
                'name' => ['required', 'string'],
                'description' => ['required', 'string', 'max:5000'],
                'link' => ['required', 'string','regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/'],
                'image' => ['image','mimes:png'],
            ]);

            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('sponsors'), $image_name);
        }
        else
        {
            $request->validate([
                'name' => ['required', 'string'],
                'description' => ['required', 'string'],
                'link' => ['required', 'string','regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/']
            ]);
        }

        if ($show == null) {
            $sponsor_data = array(
                'name'  =>  $request->name,
                'description'   =>  $request->description,
                'link'  =>    $request->link,
                'image'=>   $image_name,
                'show' => 0
            );
        }
        else {
            $sponsor_data = array(
                'name'  =>  $request->name,
                'description'   =>  $request->description,
                'link'  =>    $request->link,
                'image'=>   $image_name,
                'show' => 1
            );
        }

        $addSponsors = Sponsors::where('sponsorId', $sponsorId)->update($sponsor_data);

        SponsorsCompanies::where('sponsorId',$sponsorId)->delete();

        foreach ($companies as $company) {
                SponsorsCompanies::insert([
                    'sponsorId' => $sponsorId,
                    'companyId' => $company
                ]);
        }

        return back()->with('mensaje', 'El patrocinador fue actualizado exitosamente.');
    }

    public function delete(Request $request, $id)
    {
        Auth::user()->authorizeRoles(['superAdmin']);
        Sponsors::where('sponsorId', $id)->delete();
        return redirect('/superAdmin')->with('mensaje', 'El patrocinador fue eliminado exitosamente.');
    }

    public function createSponsor(Request $request)
    {
        Auth::user()->authorizeRoles(['superAdmin']);
        $companies = Company::all();
        return view('pages.superAdmin.addSponsors.create', compact('companies'));
    }

    public function storeSponsor(Request $request)
    {
        Auth::user()->authorizeRoles(['superAdmin']);
        $companies = $request->input('companies');
        $show = $request->input('show');
        $request->validate([
            'name' => ['required', 'string'],
            'description' => ['required', 'string', 'max:5000'],
            'link' => ['required', 'string','regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/'],
            'image' => ['required','image','mimes:png'],
        ]);

        $image = $request->file('image');
        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('sponsors'), $new_name);

        if ($show == null) {
            $sponsor_data = array(
                'name'  =>  $request->name,
                'description'   =>  $request->description,
                'link'  =>    $request->link,
                'image'=>   $new_name,
                'show' => 0
            );
        }
        else {
            $sponsor_data = array(
                'name'  =>  $request->name,
                'description'   =>  $request->description,
                'link'  =>    $request->link,
                'image'=>   $new_name,
                'show' => 1
            );
        }

        $addSponsors = Sponsors::create($sponsor_data);

        foreach ($companies as $company) {
            $addSponsors->companies()->attach($company);
        }

        return redirect('/superAdmin')->with('mensaje', 'El patrocinador fue agregado exitosamente');
    }
}
