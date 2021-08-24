<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Test extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'testId';

    protected $fillable = [
      'startedAt','areaId', 'name', 'MLGroupId'
    ];

    public function test_user()
    {
        return $this->belongsToMany(Test::class, 'test_user', 'testId','userId');
    }

    public function test_concept()
    {
        return $this->belongsToMany(Test::class, 'test_concept', 'testId','conceptId');
    }

    public static function testFromUserId($userId)
    {
        return $TestFromUser = DB::table('test_user')->where('userId',$userId)->get()->toArray();
    }

    public static function testFromAnAreaId($areaId)
    {
        return $tests=Test::where('areaId',$areaId)->join('test_user','test_user.testId','=','tests.testId')->join('users', 'users.id', '=', 'test_user.userId')->select('tests.*','users.username')->get()->toArray();
//
//        $tests = DB::table('tests')
//            ->join('test_user','test_user.testId','=','tests.testId')
//            ->join('users', 'users.id', '=', 'test_user.userId')
//            ->select('tests.*','users.username')
//            ->where('areaId', $areaId)
//            ->get()->toArray();
//
//
//        return $tests;
    }

    public static function testFromAnArrayOfAreasIds($areasIds)
    {
        $tests=Test::whereIn('areaId',$areasIds)->get()->toArray();
    }

    public static function DeleteTest($Idtest)
    {
        $Concepts = DB::table('test_concept')->where('testId',$Idtest)->get();
        Test::Concept($Concepts);
        DB::table('test_user')->where('testId',$Idtest)->delete();
        DB::table('tests')->where('testId',$Idtest)->delete();
        DB::table('concept_maturity_level')->where('conceptId',$Idtest)->delete();
    }

    public static function Concept($Concepts)
    {
        foreach ($Concepts as $value)
        {
            $Concept = DB::table('concepts')->where('conceptId',$value->conceptId)->get();
            Test::Concept_Maturity_Level($Concept);
            DB::table('test_concept')->where('conceptId',$value->conceptId)->delete();
            DB::table('concepts')->where('conceptId',$value->conceptId)->delete();
        }
    }

    public static function Concept_Maturity_Level($concept)
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
