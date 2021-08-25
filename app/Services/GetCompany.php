<?php


namespace App\Services;

use App\Models\Company;
use Illuminate\Support\Facades\Auth;

class GetCompany
{
    public function get(){
        $user = Auth::user();
        $userCompany = $user->companyId;
        $company = Company::where('companyId', '=', $userCompany)->get();
        $company = $company[0]['name'];
        return $company;
    }
}
