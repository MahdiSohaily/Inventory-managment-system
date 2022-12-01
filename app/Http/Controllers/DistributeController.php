<?php

namespace App\Http\Controllers;

use App\Models\Distribute;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class DistributeController extends Controller
{
    public function index($id = null)
    {
        $item = [null];
        if ($id != null) {
            $item = DB::table('demands')
                ->join('goods', 'goods.id', '=', 'demands.good_id')
                ->join('users', 'users.id', '=', 'demands.user_id')
                ->where('demands.id', '=', $id)
                ->select('demands.id', 'demands.quantity', 'demands.description', 'demands.user_id', 'goods.name',
                    'users.name as user_name', 'users.last_name')
                ->get();
        }
        return Inertia::render('Distribute/Partials/ShowRegister', [
            'demand' => $item[0]
        ]);
    }

    public function Distribute_list()
    {
        $deposits = DB::table('deposits')
            ->join('demands','demands.id','=','deposits.demand_id')
            ->join('goods',function ($join){
                $join->on('demands.good_id','=','goods.id');
            })
            ->join('users','users.id','=','deposits.user_id')
            ->select('deposits.id','deposits.year','demands.quantity','demands.date',
            'goods.name','users.name as user_name')
            ->get();
        return Inertia::render('Distribute/Show',[
            'deposits'=> $deposits
        ]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'user_id' => ['bail', 'required', 'exists:users,id'],
            'name' => ['bail', 'required', 'string'],
            'quantity' => ['bail', 'required', 'numeric'],
            'year' => ['bail', 'required', 'numeric', 'min:4', 'max:4'],

        ],
            [
                /*Custom Validation Messages for Above Validation Rules*/
                'required' => 'وارد نمودن :attribute الزامی می باشد',
                'regex' => ':attribute باید تنها حروف الفبا در خود داشته باشد',
                'min' => ':attribute حداقل باید :min حرف باشد',
                'max' => ':attribute حداکثر باید :max حرف باشد',
                'unique' => 'برای خرید مورد نظر قبلا بیل ترتیب گردیده است',
            ],
            [
                'user_id' => 'درخواست کننده',
                'name' => 'جنس', 'quantity' => 'تعداد جنس',
                'year' => 'سال مالی'
            ]
        );
        $deposit = new Distribute();
        $deposit->date = Carbon::today();
        $deposit->user_id = $request->input('user_id');
        $deposit->demand_id = $request->input('id');
        $deposit->year = $request->input('year');
        $deposit->save();

        return back();
    }
}
