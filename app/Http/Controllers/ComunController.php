<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Attribute;
use App\Models\Concept;
use App\Models\MaturityLevel;
use App\Models\Test;
use App\Models\User_Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Array_;

class ComunController extends Controller
{
//    public function __construct(Request $request)
//    {
//        $this->middleware(['auth', 'verified']);
//    }

    public function index(Request $request)
    {
        Auth::user()->authorizeRoles(['comun']);
        $userId = Auth::user()->id;//Dame el id del usuario loggeado
        $testsIdFromUser = DB::table('test_user')->where('userId',$userId)->get()->toArray();
        $testsIdFromUser= array_column($testsIdFromUser,'testId');
        $tests = Test::whereIn('testId',$testsIdFromUser)->get()->toArray();
        $testsId = array_column($tests,'testId');

        $concepts = DB::table('concepts')
            ->join('test_concept','test_concept.conceptId','=','concepts.conceptId')
            ->join('tests','tests.testId','=','test_concept.testId')
            ->join('areas','areas.areaId','=','tests.areaId')
            ->join('test_user', 'tests.testId', 'test_user.testId')
            ->join('users', 'test_user.userId', 'users.id')
            ->select('areas.name as areaName','tests.testId','tests.name as testName','concepts.conceptId','concepts.description', 'tests.startedAt as date')
            ->whereIn('test_concept.testId',$testsId)
            ->get()->toArray();
        return view('pages.comunes.index',compact('tests','concepts'));
    }

    public function test(Request $request, $testId,$conceptId)
    {
        Auth::user()->authorizeRoles(['comun']);
        $userId = Auth::user()->id;
        $testsIdFromUser = DB::table('test_user')->where('userId',$userId)->get()->toArray();
        $testsIdFromUser= array_column($testsIdFromUser,'testId');
        abort_if(!in_array($testId,$testsIdFromUser),403);//Si el area seleccionada no existe dentro de las areas del usuario no lo deja verla
        $test = Test::where('testId',$testId)->get()->toArray()[0];
        $selectedConcept = Concept::where('conceptId',$conceptId)->get()->toArray()[0];

        $concepts = Concept::conceptsFromATestId($testId);

        abort_if(!in_array($conceptId,array_column($concepts,'conceptId')),403);//Si el conceptId que me estas pidiendo no esta dentro de los concepts del test no dejarlo entrar

        $maturityLevels = MaturityLevel::matLevFromAConceptId($conceptId);
        $maturityLevelsId = array_column($maturityLevels,'conceptMLId');

        $attributes = Attribute::attributesFromAnArrayOfMatLevels($maturityLevelsId);
        $attributesWithEvidences = Attribute::attributesFromAnArrayOfMatLevelsWithEvidences($maturityLevelsId);

        $with_evidence = 0;

        return view('pages.comunes.test.test',compact('test','selectedConcept','concepts','maturityLevels','attributes','attributesWithEvidences', 'with_evidence'));
    }
}
