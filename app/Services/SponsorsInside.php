<?php


namespace App\Services;


use App\Models\Sponsors;

class SponsorsInside
{
    public function get(){
        $user = auth()->user();
        $userCompany = $user->companyId;

        $sponsors = Sponsors::select('sponsors.*')
            ->join('sponsors_companies', 'sponsors_companies.sponsorId', '=', 'sponsors.sponsorId')
            ->where('sponsors_companies.companyId', $userCompany)
            ->get();

        return $sponsors;
    }
}
