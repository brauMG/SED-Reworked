<?php
/**
 * Created by PhpStorm.
 * User: Yo
 * Date: 11/11/2019
 * Time: 01:42 PM
 */

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\History;
use App\Models\Test;
use App\Models\Attribute;
use App\Models\Role;
use App\Models\Role_User;
use App\Models\User;
use App\Models\Concept;
use App\Models\User_Area;
use App\Models\Company;
use App\Models\MaturityLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ConceptTestController
{
    //    public function __construct(Request $request)
//    {
//        $this->middleware(['auth', 'verified']);
//    }

    public function create(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);
        $user = auth()->user();
        $userCompany = $user-> companyId;
        $areas = DB::table('areas')->where('areas.companyId','=',$userCompany)->get()->toArray();
        $id = Auth::user()->companyId;
        $areas2 = DB::table('areas')->where('areas.companyId','=',$id)->get()->toArray();
        $roles = Role::all(['id']);
        $users = User::all(['id', 'firstName', 'lastName', 'companyId']);
        $role_user = Role_User::all();
        $tests = DB::table('tests')
            ->join('areas', 'tests.areaId', 'areas.areaId')
            ->select('tests.*')
            ->where('areas.companyId', '=', $userCompany)
            ->get()
            ->toArray();
        $attribute_number = 1;
        $ml_number = 1;
        $repeat = [1,2,3,4,5];

        return view('admins.area.concept_test.create', compact('areas', 'userCompany', 'roles', 'role_user', 'users', 'repeat', 'tests','attribute_number','ml_number', 'areas2') );
    }

    public function store(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);
        $user = auth()->user();
        $companyId = $user->companyId;
        $areaId = $request->input('area');
        $userId = $request->input('user');
        $muy_bajos = $request->input('muy_bajo');
        $bajos = $request->input('bajo');
        $intermedios = $request->input('intermedio');
        $altos = $request->input('alto');
        $muy_altos = $request->input('muy_alto');
        $muy_bajos_sugerencias = $request->input('muy_bajo_sugerencia');
        $bajos_sugerencias = $request->input('bajo_sugerencia');
        $intermedios_sugerencias = $request->input('intermedio_sugerencia');
        $altos_sugerencias = $request->input('alto_sugerencia');
        $muy_altos_sugerencias = $request->input('muy_alto_sugerencia');
        $dataConcept = $this->validatorConcept();

        $dataTest = $this->validatorTest();

        $test = Test::find($dataTest['test']);

        $maturity = DB::table('maturity_levels')->where('maturity_levels.MLGroupId','=', $test->MLGroupId)->get()->toArray();

        $conceptAdd = Concept::create([
            'description' => $dataConcept['concept']
        ]);

        $test->test_concept()->attach($conceptAdd->conceptId);

        $i = 0;
        foreach ($muy_bajos as $muy_bajo)
        {
            if ($i == 0){
                $conceptAdd->concept_maturity_level()->attach($maturity[0]->maturityLevelId);
            } $i++;

            $addAttribute = Attribute::create([
                'description'=> $muy_bajo,
                'suggestion' => $muy_bajos_sugerencias[$i -1],
                'send' => false
            ]);
            $concept_maturity_level = DB::table('concept_maturity_level')->get()->toArray();
            $addAttribute->concept_maturity_level_attribute()->attach(end($concept_maturity_level)->conceptMLId);
        }

        $i = 0;
        foreach ($bajos as $bajo)
        {
            if ($i == 0){
                $conceptAdd->concept_maturity_level()->attach($maturity[1]->maturityLevelId);
            } $i++;

            $addAttribute = Attribute::create([
                'description'=> $bajo,
                'suggestion' => $bajos_sugerencias[$i -1],
                'send' => false
            ]);
            $concept_maturity_level = DB::table('concept_maturity_level')->get()->toArray();
            $addAttribute->concept_maturity_level_attribute()->attach(end($concept_maturity_level)->conceptMLId);        }

        $i = 0;
        foreach ($intermedios as $intermedio)
        {
            if ($i == 0){
                $conceptAdd->concept_maturity_level()->attach($maturity[2]->maturityLevelId);
            } $i++;

            $addAttribute = Attribute::create([
                'description'=> $intermedio,
                'suggestion' => $intermedios_sugerencias[$i -1],
                'send' => false
            ]);
            $concept_maturity_level = DB::table('concept_maturity_level')->get()->toArray();
            $addAttribute->concept_maturity_level_attribute()->attach(end($concept_maturity_level)->conceptMLId);        }

        $i = 0;
        foreach ($altos as $alto)
        {
            if ($i == 0){
                $conceptAdd->concept_maturity_level()->attach($maturity[3]->maturityLevelId);
            } $i++;

            $addAttribute = Attribute::create([
                'description'=> $alto,
                'suggestion' => $altos_sugerencias[$i -1],
                'send' => false
            ]);
            $concept_maturity_level = DB::table('concept_maturity_level')->get()->toArray();
            $addAttribute->concept_maturity_level_attribute()->attach(end($concept_maturity_level)->conceptMLId);        }

        $i = 0;
        foreach ($muy_altos as $muy_alto)
        {
            if ($i == 0){
                $conceptAdd->concept_maturity_level()->attach($maturity[4]->maturityLevelId);
            } $i++;

            $addAttribute = Attribute::create([
                'description'=> $muy_alto,
                'suggestion' => $muy_altos_sugerencias[$i -1],
                'send' => false
            ]);
            $concept_maturity_level = DB::table('concept_maturity_level')->get()->toArray();
            $addAttribute->concept_maturity_level_attribute()->attach(end($concept_maturity_level)->conceptMLId);        }

        History::Logs('Agregado concepto '.$dataConcept['concept'].' a prueba con identificador ' .$dataTest['test'].'.');
        return redirect('/admins/area/test/listTest')->with('mensaje', 'Agregado concepto '.$dataConcept['concept'].' a prueba.');
    }

    public function validatorConcept()
    {
        return request()->validate([
            'concept' => ['required', 'string','max:5000']
        ]);
    }

    public function validatorTest()
    {
        return request()->validate([
            'test' => ['required']
        ]);
    }
}
