<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProcRequest;
use App\Http\Requests\ProcurementRequest;
use App\Models\Person;
use App\Models\Procurement;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use function Symfony\Component\Mime\Header\get;

class ProcurementController extends Controller
{
    public function index()
    {
        $purchasesMembers = $this->member();
        $checksMembers = $this->checks();
        $proc = $this->procUpdate();

        return Inertia::render('Procurement/Show', [
            'purchases' => $purchasesMembers,
            'checks' => $checksMembers,
            'proc' => $proc,
            'procurements' => Procurement::all(),
        ]);
    }

    public function create(ProcurementRequest $request)
    {
        $person = new Person();
        $person->name = $request->input('name');
        $person->last_name = $request->input('last_name');
        $person->position = $request->input('position');
        $person->proc_id = $request->input('type');
        $person->save();
        return $this->index();
    }

    public function edit(Person $person)
    {
        $purchasesMembers = $this->member();
        $checksMembers = $this->checks();
        $proc = $this->procUpdate();

        return Inertia::render('Procurement/Partials/ShowProcurement', [
            'purchases' => $purchasesMembers,
            'checks' => $checksMembers,
            'proc' => $proc,
            'procurements' => Procurement::all(),
            'person' => $person
        ]);
    }

    public function update(ProcurementRequest $request)
    {
        $person = Person::find($request->input('id'));
        $person->name = $request->input('name');
        $person->last_name = $request->input('last_name');
        $person->position = $request->input('position');
        $person->proc_id = $request->input('type');
        $person->save();
        return $this->edit($person);
    }


    public function createProc(ProcRequest $request)
    {
        $exist = DB::table('procurements')
            ->where('procurements.type', '=', $request->post('type'))
            ->where('procurements.end', '>', Carbon::today())
            ->get()->count();
        if ($exist == 0) {
            $procurement = new Procurement();
            $procurement->type = $request->input('type');
            $procurement->start = $request->input('start');
            $procurement->end = $request->input('end');
            $procurement->save();
            return $this->index();
        } else {
            return redirect()->back()->withErrors([
                'create' => 'در حال حاضر یک هیئت فعال از این نوع موجود است'
            ]);
        }
    }

    public function editProc(Procurement $procurement)
    {
        $purchasesMembers = $this->member();
        $checksMembers = $this->checks();
        $proc = $this->procUpdate();

        return Inertia::render('Procurement/Partials/ShowProc', [
            'purchases' => $purchasesMembers,
            'checks' => $checksMembers,
            'proc' => $proc,
            'procurements' => Procurement::all(),
            'updateProc' => $procurement
        ]);
    }

    public function updateProc(ProcRequest $request)
    {
        $proc = Procurement::find($request->input('id'));
        $proc->type = $request->input('type');
        $proc->start = $request->input('start');
        $proc->end = $request->input('end');
        $proc->save();
        return $this->editProc($proc);
    }

    public function member()
    {
        return DB::table('procurements')
            ->where('procurements.type', '=', 'خریداری')
            ->join('persons', 'persons.proc_id', '=', 'procurements.id')
            ->get();
    }

    public function checks()
    {
        return DB::table('persons')
            ->where('type', '=', 'معاینه')
            ->join('procurements', 'persons.proc_id', '=', 'procurements.id')->get();
    }

    public function procUpdate()
    {
        return DB::table('procurements')
            ->where('end', '>', Carbon::today())
            ->select('procurements.id', 'procurements.type', 'procurements.end')
            ->get();
    }
}
