<?php


namespace App\Services;

use App\Area;
use Auth;

class Areas
{
    public function get(){
        $user = auth()->user();
        $userCompany = $user->companyId;
        $areas = Area::where('areas.companyId','=',$userCompany)->get();
        $areasArray[''] = 'Selecciona un área';
        foreach ($areas as $area) {
            $areasArray[$area->areaId] = $area->name;
        }
        return $areasArray;
    }
}
