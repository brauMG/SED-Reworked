<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\MaturityLevel;
use App\Models\MaturityLevelsGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function Sodium\add;

class MaturityLevelController extends Controller
{
    //    public function __construct(Request $request)
//    {
//        $this->middleware(['auth', 'verified']);
//    }

    public function index(Request $request)
    {
        Auth::user()->authorizeRoles(['admin']);
        $id = Auth::user()->companyId;
        $areas = DB::table('areas')->where('areas.companyId','=',$id)->get()->toArray();

        $maturity_levels_groups = MaturityLevelsGroup::where('companyId', $id)->get();

        return view('pages.admins.maturity.index', compact('maturity_levels_groups', 'areas'));
    }

    public function create(Request $request)
    {
        Auth::user()->authorizeRoles(['admin']);
        $id = Auth::user()->companyId;
        $areas = DB::table('areas')->where('areas.companyId','=',$id)->get()->toArray();

        return view('pages.admins.maturity.addML.create', compact('areas'));
    }

    public function store(Request $request)
    {
        Auth::user()->authorizeRoles(['admin']);
        $id = Auth::user()->companyId;

        $request->validate([
            'name' => ['required', 'string'],
            'level1' => ['required', 'string', 'max:255'],
            'level2' => ['required', 'string', 'max:255'],
            'level3' => ['required', 'string', 'max:255'],
            'level4' => ['required', 'string', 'max:255'],
            'level5' => ['required', 'string', 'max:255']
        ]);

        $mls [] = array();
        array_push ($mls, $request->level1, $request->level2, $request->level3, $request->level4, $request->level5);

        MaturityLevelsGroup::create([
            'name' => $request->name,
            'companyId' => $id
        ]);

        $MLGroupId = DB::getPdo()->lastInsertId();

        for ($i = 1; $i < 6; $i++) {
            MaturityLevel::create([
                'description' => $mls[$i],
                'companyId' => $id,
                'level' => $i,
                'MLGroupId' => $MLGroupId
            ]);
        }

        return redirect('/admins/maturity/index')->with('mensaje', "Nuevo grupo de niveles de madurez agregado correctamente");
    }

    public function show(Request $request, $id)
    {
        Auth::user()->authorizeRoles(['admin']);
        $idCompany = Auth::user()->companyId;
        $areas = DB::table('areas')->where('areas.companyId','=',$idCompany)->get()->toArray();
        $groupId = MaturityLevelsGroup::where('MLGroupId', $id)->firstOrFail();
        $group = MaturityLevelsGroup::where('MLGroupId', $id)->get()->toArray();
        $maturity_levels = MaturityLevel::where('MLGroupId', $id)
            ->get()->toArray();

        return view('pages.admins.maturity.viewML.showML', compact('groupId', 'maturity_levels', 'group', 'areas'));
    }

    public function edit(Request $request, $id)
    {
        Auth::user()->authorizeRoles(['admin']);
        $idCompany = Auth::user()->companyId;
        $areas = DB::table('areas')->where('areas.companyId','=',$idCompany)->get()->toArray();
        $groupId = MaturityLevelsGroup::where('MLGroupId', $id)->firstOrFail();
        $group = MaturityLevelsGroup::where('MLGroupId', $id)->get()->toArray();
        $maturity_levels = MaturityLevel::where('MLGroupId', $id)
            ->get()->toArray();

        return view('pages.admins.maturity.viewML.editML', compact('groupId', 'maturity_levels', 'group', 'areas'));
    }

    public function cancel(Request $request)
    {
        Auth::user()->authorizeRoles(['admin']);
        return back()->with('mensajeError', 'La edición fue cancelada');
    }

    public function update(Request $request, $groupId)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'maturityName.*' => ['required', 'string', 'max:255']
        ]);

        $levels = DB::table('maturity_levels') ->where('MLGroupId',$groupId)->get();
        foreach ($levels as $T)
        {
            DB::table('maturity_levels')
                ->where([['MLGroupId','=',$groupId], ['maturityLevelId','=',$T->maturityLevelId]])
                ->update(['description' =>$request->maturityName[$T->maturityLevelId]]);
        }

        DB::table('maturity_levels_group')
            ->where('MLGroupId', '=', $groupId)
            ->update([
                'name' => $request->name
            ]);

        History::Logs('Actualizo un grupo de niveles de madurez de la empresa.');
        return back()->with('mensaje', 'Grupo de nivelez de madurez actualizados correctamente.');
    }

}
