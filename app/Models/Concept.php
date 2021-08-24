<?php

namespace App\Models;

use App\ConceptMaturityLevel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\ConceptMaturityLevelAttribute;

class Concept extends Model
{
    public $timestamps = false;

    protected $primaryKey = "conceptId";

    protected $fillable = [
        'description'
    ];

    public function concept_maturity_level()
    {
        return $this->belongsToMany(Attribute::class, 'concept_maturity_level', 'conceptId','maturityLevelId');
    }

    public static function ConceptsFromAnArrayOfTestsIds($testsIds)
    {
        return $concepts = DB::table('concepts')
            ->join('test_concept',function ($join) use ($testsIds) {
                $join->on('concepts.conceptId','=','test_concept.conceptId')
                    ->whereIn('test_concept.testId',$testsIds);
            })
            ->get()->toArray();
    }
    public static function conceptsFromATestId($testId)
    {
        return $concepts = DB::table('concepts')
            ->join('test_concept',function ($join) use ($testId) {
                $join->on('concepts.conceptId','=','test_concept.conceptId')
                    ->where('test_concept.testId','=',$testId);
            })
            ->get()->toArray();
    }

    public static function DeleteConcept($Idconcept)
    {
        $Concepts = DB::table('test_concept')->where('conceptId',$Idconcept)->get();
        Test::Concept($Concepts);
        DB::table('concepts')->where('conceptId',$Idconcept)->delete();
        DB::table('concept_maturity_level')->where('conceptId',$Idconcept)->delete();
    }

    public static function Concept($Concepts)
    {
        foreach ($Concepts as $value)
        {
            $Concept = DB::table('concepts')->where('conceptId',$value->conceptId)->get();
            Test::ConceptMaturityLevel($Concept);
            DB::table('test_concept')->where('conceptId',$value->conceptId)->delete();
            DB::table('concepts')->where('conceptId',$value->conceptId)->delete();
        }
    }

    public static function ConceptMaturityLevel($concept)
    {
        foreach ($concept as $value)
        {
            $CM = DB::table('concept_maturity_level')->where('conceptId',$value->conceptId)->get();
            Test::Concept_Maturity_Level_Attribute($CM);
            DB::table('concept_maturity_level')->where('conceptId',$value->conceptId)->delete();
        }
    }

    public static function Concept_Maturity_Level_Attribute($CM)
    {
        foreach ($CM as $value)
        {
            $CMA = DB::table('concept_maturity_level_attribute')->where('conceptMLId',$value->conceptMLId)->get();
            Test::Attributes($CMA);
        }
    }

    public static function Attributes($CMA)
    {
        foreach ($CMA as $value)
        {
            $Attributes = DB::table('attributes')->where('attributeId',$value->attributeId)->get();
            Test::Evidences($Attributes);
            DB::table('attributes')->where('attributeId',$value->attributeId)->delete();
        }
    }

    public static function Evidences($Attributes)
    {
        foreach ($Attributes as $value) {
            $Evidences = DB::table('evidences')->where('attributeId',$value->attributeId)->delete();
            DB::table('concept_maturity_level_attribute')->where('attributeId',$value->attributeId)->delete();

        }
    }
}
