<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Attribute;
use App\Models\Company;
use App\Models\Concept;
use App\Models\Evidences;
use App\Models\History;
use App\Mail\EvidenceHideSuggestion;
use App\Mail\EvidenceNoSuggestion;
use App\Mail\EvidenceSuggestion;
use App\Models\MaturityLevel;
use App\Models\MaturityLevelsGroup;
use App\Models\Role_User;
use App\Models\Test;
use App\Models\TestUser;
use App\Models\User;
use App\Models\User_Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Foreach_;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\VarDumper\Cloner\Data;

class AnalistaController extends Controller
{
//    public function __construct(Request $request)
//    {
//       $this->middleware(['auth', 'verified']);
//    }

    public function index(Request $request)
    {
        Auth::user()->authorizeRoles(['analista']);
        //Tenemos que regresarle las areas del analista
        $userId = Auth::user()->id;//Dame el id del usuario loggeado
        $areas = $this->areasFromAnalista($userId);
        $areasId = array_column($areas,'areaId');
        $tests = Test::whereIn('areaId',$areasId)->get()->toArray();
        $testsId = array_column($tests,'testId');

        $concepts = DB::table('concepts')
            ->join('test_concept','test_concept.conceptId','=','concepts.conceptId')
            ->join('tests','tests.testId','=','test_concept.testId')
            ->join('areas','areas.areaId','=','tests.areaId')
            ->join('test_user', 'tests.testId', 'test_user.testId')
            ->join('users', 'test_user.userId', 'users.id')
            ->select('areas.areaId','areas.name as areaName','tests.testId','tests.name as testName','concepts.conceptId','concepts.description', 'users.username as username')
            ->whereIn('test_concept.testId',$testsId)
            ->get()->toArray();

        return view('pages.analistas.index', compact('areas','concepts'));
    }

    public function getAreas(Request $request)
    {
        Auth::user()->authorizeRoles(['analista']);
        //Tenemos que regresarle las areas del analista
        $userId = Auth::user()->id;//Dame el id del usuario loggeado
        $areas = $this->areasFromAnalista($userId);
        $areasId = array_column($areas,'areaId');
        $tests = Test::whereIn('areaId',$areasId)->get()->toArray();
        $testsId = array_column($tests,'testId');

        $concepts = DB::table('concepts')
            ->join('test_concept','test_concept.conceptId','=','concepts.conceptId')
            ->join('tests','tests.testId','=','test_concept.testId')
            ->join('areas','areas.areaId','=','tests.areaId')
            ->select('areas.areaId','areas.name as areaName','tests.testId','tests.name as testName','concepts.conceptId','concepts.description')
            ->whereIn('test_concept.testId',$testsId)
            ->get()->toArray();

        return view('pages.analistas.areas', compact('areas','concepts'));
    }

    public function areasFromAnalista($userId)
    {
        $areasIdFromAnalista = User_Area::where('userId',$userId)->get()->toArray();
        $areasIdFromAnalista = array_column($areasIdFromAnalista,'areaId');
        $areasFromAnalista = Area::whereIn('areaId',$areasIdFromAnalista)->get()->toArray();
        $areas = $areasFromAnalista;
        return $areas;
    }

    public function viewResults(Request $request,$areaId)
    {
        Auth::user()->authorizeRoles(['analista']);
        $userId = Auth::user()->id;
        $companyId = User::giveMeCompany(Auth::user());
        $areas = $this->areasFromAnalista($userId);
        $areasId = array_column($areas,'areaId');
        $tests = Test::testFromAnAreaId($areaId);
        $testsIds=array_column($tests,'testId');
        $total = 0;
        $promedio = 0;
        $i = 0;
        $general = null;

        $groups = MaturityLevelsGroup::where('companyId', $companyId)->get()->toArray();

        $areaSeleccionada= Area::where('areaId',$areaId)->first();

        $maturityLevels = MaturityLevel::where('companyId',$companyId)->get()->toArray();

        abort_if(!in_array($areaId,$areasId),403); // Si el area seleccionada no existe dentro de las areas del usuario no lo deja verla

        if(empty($areas)){ // Verifica si la compañia del usuario tiene areas. Si no lo manda a crear un area.
            return redirect('/admins/area/addArea');
        }

        $testsConcepts = Concept::ConceptsFromAnArrayOfTestsIds($testsIds);
        $testsConcepts = collect($testsConcepts)->sortBy('testId')->toArray();
        $testsConcepts = array_filter(array_values($testsConcepts));
        $testsConceptsIds = array_column((array)$testsConcepts,'testConceptId');
        $results=[];

        foreach ((array) $testsConceptsIds as $item)
        {
            $conceptsResults[] = DB::select('call p_fetch_verified_evidences(?)',array($item));
            $results[] = (array)$conceptsResults[array_search($item,$testsConceptsIds)][0];
        }

        return view('pages.analistas.viewResults.results',compact([
            'areas',
            'areaSeleccionada',
            'tests',
            'testsConcepts',
            'maturityLevels',
            'results',
            'total',
            'promedio',
            'i',
            'general',
            'groups'
        ]));
    }

    public function otherAnalistas($testId)
    {
        $TestData = Test::where('testId', $testId)->first();
        $areaIdFromTest = $TestData['areaId'];
        $usuariosArea = User_Area::where('areaId', $areaIdFromTest)->get();

        $i = 0;
        $usuariosAnalistas = [];

        for ($i ; $i < count($usuariosArea); $i++ ) {
            $usuariosAnalistas[] = Role_User::where('user_id', '=', $usuariosArea[$i]->userId)->where('role_id', '=', 3)->get()->toArray();
        }

        $usuariosAnalistas = array_values(array_filter($usuariosAnalistas));

        $i = 0;
        $idOfAnalistas = [];

        for ($i; $i < count($usuariosAnalistas); $i++){
            $idOfAnalistas[] = $usuariosAnalistas[$i][0]['user_id'];
        }

        $i = 0;
        $DataFromAnalistas = [];

        for ($i; $i < count($idOfAnalistas); $i++){
            $DataFromAnalistas[] = User::where('id', $idOfAnalistas[$i])->get()->toArray();
        }

        $DataFromAnalistas = array_values(array_filter($DataFromAnalistas));

        $i = 0;
        $emailsFromAnalistas = [];

        for ($i; $i < count($DataFromAnalistas); $i++){
            $emailsFromAnalistas[] = $DataFromAnalistas[$i][0]['email'];
        }

        return $emailsFromAnalistas;
    }

    public function emailsAdmins($companyId)
    {
        $usersFromCompany = User::where('companyId', $companyId)->get()->toArray();

        $i = 0;
        $roleUsers = [];

        for ($i ; $i < count($usersFromCompany); $i++ ) {
            $roleUsers[] = Role_User::where('user_id', '=', $usersFromCompany[$i]['id'])->where('role_id', '=', 2)->get()->toArray();
        }

        $roleUsers = array_values(array_filter($roleUsers));

        $i = 0;
        $idOfAdmins = [];

        for ($i; $i < count($roleUsers); $i++){
            $idOfAdmins[] = $roleUsers[$i][0]['user_id'];
        }


        $i = 0;
        $DataFromAdmins = [];

        for ($i; $i < count($idOfAdmins); $i++){
            $DataFromAdmins[] = User::where('id', $idOfAdmins[$i])->get()->toArray();
        }

        $DataFromAdmins = array_values(array_filter($DataFromAdmins));

        $i = 0;
        $emailsFromAdmins = [];

        for ($i; $i < count($DataFromAdmins); $i++){
            $emailsFromAdmins[] = $DataFromAdmins[$i][0]['email'];
        }

        return $emailsFromAdmins;
    }

    public function test(Request $request, $testId,$conceptId)
    {
        Auth::user()->authorizeRoles(['analista']);
        $userId = Auth::user()->id;
        $analist = Auth::user();
        $analistFirstName = $analist->firstName;
        $analistLastName = $analist->lastName;
        $companyId = Auth::user()->companyId;
        $areas = $this->areasFromAnalista($userId);
        $emailsAnalistas = $this->otherAnalistas($testId);
        $emailsAdmins = $this->emailsAdmins($companyId);
        $areasId = array_column($areas,'areaId');
        $testFromAreasOfTheUser = Test::whereIn('areaId',$areasId)->get()->toArray();
        $testsIdFromAreasOfTheUser = array_column($testFromAreasOfTheUser,'testId');
        $testFromUser = TestUser::where('testId',$testId)->get()->toArray()[0];
        $commonUserId = $testFromUser['userId'];
        $dataFromCommonUser = User::where('id', $commonUserId)->get()->toArray()[0];
        $email = $dataFromCommonUser['email'];
        $name = $dataFromCommonUser['firstName'];
        $lastName = $dataFromCommonUser['lastName'];
        $count = 0;

        $request->attributes->add(['testId' => $request->testId]);

        abort_if(!in_array($testId,$testsIdFromAreasOfTheUser),403);//Si el area seleccionada no existe dentro de las areas de la compania
        $test = Test::where('testId',$testId)->get()->toArray()[0];
        $testName = $test['name'];

        $concepts = Concept::conceptsFromATestId($testId);
        $conceptsIds = array_column($concepts,'conceptId');

        abort_if(!in_array($conceptId,$conceptsIds),403);//Si el conceptId que me estas pidiendo no esta dentro de los concepts del test no dejarlo entrar
        $selectedConcept = Concept::where('conceptId',$conceptId)->get()->toArray()[0];

        $maturityLevels = MaturityLevel::matLevFromAConceptId($conceptId);
        $maturityLevelsId = array_column($maturityLevels,'conceptMLId');

        $attributes = Attribute::attributesFromAnArrayOfMatLevels($maturityLevelsId);
        $attributesWithEvidences = Attribute::attributesFromAnArrayOfMatLevelsWithEvidences($maturityLevelsId);

        $with_evidence = 0;

        return view('pages.analistas.test.test',compact('with_evidence','test','selectedConcept','concepts','maturityLevels','attributes','attributesWithEvidences','email', 'name', 'lastName', 'count', 'commonUserId', 'testName', 'emailsAdmins', 'emailsAnalistas','analistFirstName', 'analistLastName'));
    }

    public function storeTest(Request $request)
    {
        $analistName = $request->input('analistName');
        $observation = $request->input('observation');
        $companyId = User::giveMeCompany(Auth::user());
        $email = $request->input('email');
        $emailsAnalistas = $request->input('emailsAnalistas');
        $emailsAdmins = $request->input('emailsAdmins');
        $commonUserId = $request->input('commonUserId');
        $username = $request->input('username');
        $testName = $request->input('testName');
        $myAttributeCheckboxes = $request->input('attributeCheck');
        $mySuggestionCheckboxes = $request->input('suggestionCheck');
        $myAttributes = $request->input('attribute-name');
        $companyData = Company::where('companyId', '=', $companyId)->get()->toArray();
        $phone = $companyData[0]['phoneNumber'];
        $address = $companyData[0]['address'];
        $verify = array();
        $unverify = array();
        $empty = array();
        $hide = "Sugerencia ocultada por el analista";
        $si = "si";
        $no = "no";

        foreach($myAttributeCheckboxes as $key => $value)
        {
            if ($value == 'on') {
                DB::table('evidences')
                    ->where('attributeId',$key)
                    ->update(['verified'=>true]);
            }
            else{
                foreach($mySuggestionCheckboxes as $key2 => $value2)
                {
                    if ($key == $key2) {
                        if ($value2 == 'on') {
                            DB::table('attributes')
                                ->where('attributeId',$key2)
                                ->update(['send'=>true]);
                        }
                        else {
                            DB::table('attributes')
                                ->where('attributeId',$key)
                                ->update(['send' => false]
                                );
                        }
                    }
                }
                DB::table('evidences')
                    ->where('attributeId',$key)
                    ->update(['verified' => false]
                    );
            }
        }

        $notSend = 0;
        $valid = 0;
        foreach ($mySuggestionCheckboxes as $box){
            if ($box == 'off'){
                $notSend++;
            }

        }
        foreach ($myAttributeCheckboxes as $box){
            if ($box == 'on'){
                $valid++;
            }
        }


        foreach ($myAttributes as $attribute)
        {
            $evidenceFromUser = Evidences::where('userId', $commonUserId)->where('attributeId', $attribute)->first();
            if(isset($evidenceFromUser['verified']) == 1){
                $getAttributeDescription = Attribute::where('attributeId', $attribute)->first();
                $description = $getAttributeDescription->description;
                $verify[] = $description;
            }
            elseif (isset($evidenceFromUser['verified']) == 0){
                $getAttributeDescription = Attribute::where('attributeId', $attribute)->first();
                $description = $getAttributeDescription->description;
                $suggestion = $getAttributeDescription->suggestion;
                $unverify[] = $description;

                if ($getAttributeDescription['send'] == true) {
                    $recommendation[] = $suggestion;
                }
                else{
                    $recommendation[] = $hide;
                }
            }
        }

//        if ($notSend == 15 and $valid == 15) {
//            foreach ($emailsAnalistas as $emailAnalista) {
//                Mail::to($emailAnalista)->queue(new EvidenceNoSuggestion($verify, $unverify, $username, $testName, $analistName, $observation, $phone, $address));
//            }
//
//            foreach ($emailsAdmins as $emailAdmin) {
//                Mail::to($emailAdmin)->queue(new EvidenceNoSuggestion($verify, $unverify, $username, $testName, $analistName, $observation, $phone, $address));
//            }
//
//            Mail::to($email)->queue(new EvidenceNoSuggestion($verify, $unverify, $username, $testName, $analistName, $observation, $phone, $address));
//        }
//        else if ($notSend == 15) {
//            foreach ($emailsAnalistas as $emailAnalista) {
//                Mail::to($emailAnalista)->queue(new EvidenceHideSuggestion($verify, $unverify, $username, $testName, $analistName, $observation, $phone, $address));
//            }
//
//            foreach ($emailsAdmins as $emailAdmin) {
//                Mail::to($emailAdmin)->queue(new EvidenceHideSuggestion($verify, $unverify, $username, $testName, $analistName, $observation, $phone, $address));
//            }
//
//            Mail::to($email)->queue(new EvidenceHideSuggestion($verify, $unverify, $username, $testName, $analistName, $observation, $phone, $address));
//        }
//        else {
//            foreach ($emailsAnalistas as $emailAnalista) {
//                Mail::to($emailAnalista)->queue(new EvidenceSuggestion($verify, $unverify, $recommendation, $username, $testName, $analistName, $observation, $phone, $address));
//            }
//
//            foreach ($emailsAdmins as $emailAdmin) {
//                Mail::to($emailAdmin)->queue(new EvidenceSuggestion($verify, $unverify, $recommendation, $username, $testName, $analistName, $observation, $phone, $address));
//            }
//
//            Mail::to($email)->queue(new EvidenceSuggestion($verify, $unverify, $recommendation, $username, $testName, $analistName, $observation, $phone, $address));
//        }

//        /*this line is used to create and return a new instance of the email view, can be used for testing how the email view looks like.

//        return new EvidenceSuggestion($verify,$unverify,$recommendation,$username,$testName);

//        comment the return redirect and the Email::to lines in order to use this */

        History::Logs('Envio los resultados de la prueba '.$testName.' a los respectivos correos.');
        return redirect('/analista')->with('mensaje', 'Los resultados fueron enviados.');
    }
}
