<?php

namespace App\Http\Controllers;

use App\Models\Arrival;
use App\Models\Bill;
use App\Models\Good;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ArrivalController extends Controller
{
    public function index($id = null)
    {
        $item = [null];
        $stocks = null;

        $items = DB::table('arrivals')
            ->join('purchases', 'purchases.id', '=', 'arrivals.purchase_id')
            ->join('goods', function ($join) {
                $join->on('purchases.good_id', '=', 'goods.id');
            })
            ->join('users', 'users.id', '=', 'arrivals.user_id')
            ->join('stocks', function ($join) {
                $join->on('users.id', '=', 'stocks.user_id');
            })
            ->select('arrivals.*', 'goods.name as good_name', 'stocks.name', 'purchases.quantity')
            ->get();

        if ($id) {
            $item = DB::table('bills')
                ->join('purchases', 'purchases.id', '=', 'bills.purchase_id')
                ->join('goods', function ($join) {
                    $join->on('purchases.good_id', '=', 'goods.id');
                })
                ->select('bills.id as bill_id', 'purchases.id', 'purchases.quantity', 'goods.name', 'goods.id as good_id')
                ->where('bills.id', '=', $id)->get();
            $stocks = DB::table('stocks')
                ->join('users', 'stocks.user_id', '=', 'users.id')
                ->select('stocks.name', 'users.id', 'users.name as user_name', 'users.last_name')
                ->get();
        }
        return Inertia::render('Arrival/Show', [
            'item' => $item[0],
            'items' => $items,
            'stocks' => $stocks
        ]);
    }

    public function create(Request $request)
    {
        $request->validate([
            "id" => ['bail', 'required', 'unique:arrivals,purchase_id'],
            "good_id" => ['bail', 'required', 'exists:goods,id'],
            "stock_id" => ['bail', 'required', 'exists:users,id'],
            "date" => ['bail', 'required', 'date'],
            "model_number" => ['bail', 'required']
        ], [
            /*Custom Validation Messages for Above Validation Rules*/
            'required' => 'وارد نمودن :attribute الزامی می باشد',
            'regex' => ':attribute باید تنها حروف الفبا در خود داشته باشد',
            'min' => ':attribute حداقل باید :min حرف باشد',
            'max' => ':attribute حداکثر باید :max حرف باشد',
            'unique' => 'برای خرید مورد نظر قبلا بیل ترتیب گردیده است',
        ], [
            "id" => 'خریداری',
            "good_id" => 'جنس',
            "stock_id" => 'تحویلدار',
            "date" => 'تاریخ',
            "model_number" => 'مودل نمبر',
        ]);
        DB::beginTransaction();
        $arrival = new Arrival();
        $arrival->date = $request->input('date');
        $arrival->purchase_id = $request->input('id');
        $arrival->user_id = $request->input('stock_id');
        $arrival->quantity = $request->input('quantity');
        $arrival->model_number = $request->input('model_number');
        $arrival->save();

        /* Increasing the specific good amount by the specified quantity */
        $good = Good::find($request->input('good_id'));
        $good->quantity += $request->input('quantity');
        $good->save();

        /* changing the status of depend bill to mark it done*/
        $bill = Bill::find($request->input('bill_id'));
        $bill->status = 1;
        $bill->save();
        DB::commit();
        return redirect()->back();
    }
}
