<?php
namespace App\Http\Controllers;
use App\Models\Concept;
use App\Models\History;
use App\Models\MaturityLevel;
use App\Models\Test;
use Illuminate\Http\Request;
use App\Models\Evidences;
use App\Models\Attribute;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


class TestController extends Controller
{
//    public function __construct(Request $request)
//    {
//        $this->middleware(['auth',]);  //'verified'
//    }
    //
    public function index(Request $request , $attributeId)
    {
        Auth::user()->authorizeRoles(['analista', 'comun']);
        $user = auth()->user();
        $userId = Auth::user()->id;
        $testFromUser = Test::testFromUserId($userId);
        $testsIds =array_column($testFromUser,'testId');
        $concepts = Concept::ConceptsFromAnArrayOfTestsIds($testsIds);
        $conceptsIds = array_column($concepts,'conceptId');
        $maturityLevels = MaturityLevel::matLevFromAnArrayOfConceptsIds($conceptsIds);
        $maturityLevelsIds = array_column($maturityLevels,'conceptMLId');
        $attributes = Attribute::attributesFromAnArrayOfMatLevels($maturityLevelsIds);
        $attributesIds = array_column($attributes,'attributeId');
        abort_if(!in_array($attributeId,array_column($attributes,'attributeId')),403);
        $selectedAttribute = Attribute::where('attributeId',$attributeId)->get()->toArray()[0];
        $evidences = Evidences::whereIn('attributeId',$attributesIds)->get()->toArray();


        return view('pages.test.index', compact('selectedAttribute', 'evidences', 'user'));

    }

    public function store(Request $request)
    {
        Auth::user()->authorizeRoles(['analista', 'comun']);

        if($request->hasFile('link'))
        {
            $fileName = time().$request->link->getClientOriginalName();
            $request->link->storeAs('public/upload',$fileName);
            $attributes = $this->validator();
            $attributes['link'] = $fileName;
            $evidences = Evidences::create($attributes);

            $tesdIdAndConceptId = DB::table('attributes')
                ->join('concept_maturity_level_attribute','concept_maturity_level_attribute.attributeId','=','attributes.attributeId')
                ->join('concept_maturity_level','concept_maturity_level.conceptMLId','=','concept_maturity_level_attribute.conceptMLId')
                ->join('test_concept','test_concept.conceptId','=','concept_maturity_level.conceptId')
                ->select('test_concept.testId','test_concept.conceptId')
                ->where('concept_maturity_level_attribute.attributeId',$attributes['attributeId'])
                ->get()->toArray()[0];
            if($evidences){
                History::Logs('Subio una evidencia.');
                return redirect()->route('comunTest',[$tesdIdAndConceptId->testId,$tesdIdAndConceptId->conceptId]);
            }else{
                return redirect()->back()->with(['errors'=>$evidences->save()->errors()->all()]);
            };
        }
    }
    public function show(Request $request){
        Auth::user()->authorizeRoles(['analista', 'comun']);

        $attributes = Attribute::get()->toArray();
        $evidences = Evidences::get()->all();
        $user = auth()->user();
        $users = User::all();

        return view('pages.test.show', compact('attributes', 'evidences', 'user', 'users'));
    }
    public function edit($evidenceId)
    {
        $data = Evidences::findOrFail($evidenceId);
        return view('pages.test.edit', compact('data' ));
    }

    public function update(Request $request, $evidenceId)
    {
        $data = Evidences::findOrFail($evidenceId);

        $user = auth()->user();


        if($request->hasFile('link'))
        {
            Storage::delete("public/upload/$data->link");
            $fileName = time().$request->link->getClientOriginalName();
            $request->link->storeAs('public/upload',$fileName);

            $fileName = time().$request->link->getClientOriginalName();
            $attributes = $this->validator();
            $evidences = Evidences::find($evidenceId)->update([
                'link' => $fileName,
                'attributeId' => $request->attributeId,
                'userId' => $request->userId,
                'companyId' => $request->companyId,
                'verified' => $request->verified
            ]);
            $tesdIdAndConceptId = DB::table('attributes')
                ->join('concept_maturity_level_attribute','concept_maturity_level_attribute.attributeId','=','attributes.attributeId')
                ->join('concept_maturity_level','concept_maturity_level.conceptMLId','=','concept_maturity_level_attribute.conceptMLId')
                ->join('test_concept','test_concept.conceptId','=','concept_maturity_level.conceptId')
                ->select('test_concept.testId','test_concept.conceptId')
                ->where('concept_maturity_level_attribute.attributeId',$attributes['attributeId'])
                ->get()->toArray()[0];

            if($evidences){
                return redirect()->route('comunTest',[$tesdIdAndConceptId->testId,$tesdIdAndConceptId->conceptId]);
            }else{
                return redirect()->back()->with(['errors'=>$evidences->save()->errors()->all()]);
            };
        }
    }
    public function validator()
    {
        return request()->validate([
            'link' => ['required','file', 'max:50000'],
            'attributeId' => ['required', 'integer'],
            'verified' => ['required', 'integer'],
            'userId' => ['required', 'integer'],
            'companyId' =>['required', 'integer']
        ]);
    }
}

