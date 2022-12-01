<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class BillController extends Controller
{
    public function index(Purchase $purchase = null)
    {

        $custom = null;
        $proc = null;
        $bills = DB::table('bills')
            ->join('purchases', 'purchases.id', '=', 'bills.purchase_id')
            ->join('goods', 'goods.id', '=', 'purchases.good_id')
            ->join('shops', function ($join) {
                $join->on('shops.purchase_id', '=', 'purchases.id')
                    ->on('shops.price_per', '=', 'purchases.price_per');
            })
            ->where('bills.status', '=', 0)
            ->select('bills.id', 'purchases.quantity', 'purchases.quantity', 'bills.date', 'purchases.description',
                'shops.id as shop_id', 'shops.name', 'shops.total', 'shops.price_per', 'goods.name as good_name')
            ->get();
        $unbills = DB::table('bills')
            ->join('purchases', 'purchases.id', '=', 'bills.purchase_id')
            ->join('goods', 'goods.id', '=', 'purchases.good_id')
            ->join('shops', function ($join) {
                $join->on('shops.purchase_id', '=', 'purchases.id')
                    ->on('shops.price_per', '=', 'purchases.price_per');
            })
            ->where('bills.status', '=', 1)
            ->select('bills.id', 'purchases.quantity', 'purchases.quantity', 'bills.date', 'purchases.description',
                'shops.id as shop_id', 'shops.name', 'shops.total', 'shops.price_per', 'goods.name as good_name')
            ->get();
        if ($purchase != null) {
            $custom = DB::table('purchases')
                ->join('goods', 'goods.id', '=', 'purchases.good_id')
                ->join('shops', function ($join) {
                    $join->on('shops.purchase_id', '=', 'purchases.id')
                        ->on('shops.price_per', '=', 'purchases.price_per');
                })
                ->where('purchases.id', '=', $purchase->id)
                ->select('purchases.*', 'shops.id as shop_id', 'shops.name', 'shops.price_per', 'goods.name as good_name')
                ->get();
            $proc = DB::table('procurements')
                ->where('type', '=', 'معاینه')->get();
        }
        return Inertia::render('Bill/Show', [
            'purchase' => $custom,
            'proc' => $proc,
            'bills' => $bills,
            'unbills' => $unbills,
        ]);
    }

    public function create(Request $request)
    {
        $request->validate([
            "id" => ['bail', 'required', 'unique:bills,purchase_id'],
            "shop_id" => ['bail', 'required', 'exists:shops,id'],
            "proc_id" => ['bail', 'required', 'exists:procurements,id'],
            "good_name" => ['bail', 'required', 'string'],
            "seller" => ['bail', 'required', 'string'],
            "quantity" => ['bail', 'required', 'numeric'],
            "value" => ['bail', 'required', 'numeric'],
            "date" => ['bail', 'required', 'date'],
            "description" => ['bail', 'nullable', 'string'],

        ], [
            /*Custom Validation Messages for Above Validation Rules*/
            'required' => 'وارد نمودن :attribute الزامی می باشد',
            'regex' => ':attribute باید تنها حروف الفبا در خود داشته باشد',
            'min' => ':attribute حداقل باید :min حرف باشد',
            'max' => ':attribute حداکثر باید :max حرف باشد',
            'unique' => 'برای خرید مورد نظر قبلا بیل ترتیب گردیده است',
        ], [
            "shop_id" => 'دکان',
            "proc_id" => 'هیئت تدارکات',
            "good_name" => 'جنس',
            "seller" => 'فروشنده',
            "quantity" => 'تعدا جنس',
            "value" => 'قیمت جنس',
            "date" => 'تاریخ',
            "description" => 'توضیحات',
        ]);
        $purchase = Purchase::find($request->input('id'));
        $purchase->status = 1;
        $purchase->save();
        $bill = new Bill();
        $bill->date = $request->input('date');
        $bill->purchase_id = $request->input('id');
        $bill->shop_id = $request->input('shop_id');
        $bill->proc_id = $request->input('proc_id');
        $bill->status = 0;
        $bill->save();
        return $this->index(Purchase::find($request->input('id')));
    }

    public function edit(Bill $bill)
    {

        $bills = DB::table('bills')
            ->join('purchases', 'purchases.id', '=', 'bills.purchase_id')
            ->join('goods', 'goods.id', '=', 'purchases.good_id')
            ->join('shops', function ($join) {
                $join->on('shops.purchase_id', '=', 'purchases.id')
                    ->on('shops.price_per', '=', 'purchases.price_per');
            })
            ->where('bills.id', '=', $bill->id)
            ->select('bills.*', 'purchases.price_per', 'purchases.total', 'purchases.price_per', 'purchases.quantity',
                'shops.id as shop_id', 'shops.name', 'shops.price_per', 'goods.name as good_name')
            ->get();
        $allbills = DB::table('bills')
            ->join('purchases', 'purchases.id', '=', 'bills.purchase_id')
            ->join('goods', 'goods.id', '=', 'purchases.good_id')
            ->join('shops', function ($join) {
                $join->on('shops.purchase_id', '=', 'purchases.id')
                    ->on('shops.price_per', '=', 'purchases.price_per');
            })->select('bills.id', 'purchases.quantity', 'purchases.quantity', 'bills.date', 'purchases.description',
                'shops.id as shop_id', 'shops.name', 'shops.total', 'shops.price_per', 'goods.name as good_name')
            ->get();
        $proc = DB::table('procurements')
            ->where('type', '=', 'معاینه')->get();

        return Inertia::render('Bill/Partials/EditBill', [
            'bill' => $bills,
            'proc' => $proc,
            'allbills' => $allbills
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            "id" => ['bail', 'required'],
            "shop_id" => ['bail', 'required', 'exists:shops,id'],
            "proc_id" => ['bail', 'required', 'exists:procurements,id'],
            "good_name" => ['bail', 'required', 'string'],
            "seller" => ['bail', 'required', 'string'],
            "quantity" => ['bail', 'required', 'numeric'],
            "value" => ['bail', 'required', 'numeric'],
            "date" => ['bail', 'required', 'date'],
            "description" => ['bail', 'nullable', 'string'],

        ], [
            /*Custom Validation Messages for Above Validation Rules*/
            'required' => 'وارد نمودن :attribute الزامی می باشد',
            'regex' => ':attribute باید تنها حروف الفبا در خود داشته باشد',
            'min' => ':attribute حداقل باید :min حرف باشد',
            'max' => ':attribute حداکثر باید :max حرف باشد',
            'unique' => 'برای خرید مورد نظر قبلا بیل ترتیب گردیده است',
        ], [
            "shop_id" => 'دکان',
            "proc_id" => 'هیئت تدارکات',
            "good_name" => 'جنس',
            "seller" => 'فروشنده',
            "quantity" => 'تعدا جنس',
            "value" => 'قیمت جنس',
            "date" => 'تاریخ',
            "description" => 'توضیحات',
        ]);
        $bill = Bill::find($request->input('id'));
        $bill->date = $request->input('date');
        $bill->save();
        $this->edit($bill);
    }

    public function getBills($id)
    {
        Bill::destroy($id);
        return $this->index();
    }
}
