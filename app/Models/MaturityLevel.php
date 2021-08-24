<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MaturityLevel extends Model
{
    public $timestamps = false;
    public $table = "maturity_levels";
    protected $fillable = [
        'description','companyId', 'level', 'MLGroupId'
    ];

    public static function matLevFromAConceptId($conceptId)
    {
        return $maturityLevels = DB::table('maturity_levels')
            ->join('concept_maturity_level',function ($join) use ($conceptId) {
                $join->on('maturity_levels.maturityLevelId','concept_maturity_level.maturityLevelId')
                    ->where('concept_maturity_level.conceptId','=',$conceptId);
            })
            ->get()->toArray();
    }

    public static function matLevFromAnArrayOfConceptsIds($conceptsIds)
    {
        return $maturityLevels = DB::table('maturity_levels')
            ->join('concept_maturity_level',function ($join) use ($conceptsIds) {
                $join->on('maturity_levels.maturityLevelId','concept_maturity_level.maturityLevelId')
                    ->whereIn('concept_maturity_level.conceptId',$conceptsIds);
            })
            ->get()->toArray();
    }
}
