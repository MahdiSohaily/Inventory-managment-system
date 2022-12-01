<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseRequest;
use App\Models\Category;
use App\Models\Purchase;
use App\Models\Shop;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class PurchaseController extends Controller
{
    public function index(Purchase $purchase)
    {
        $proc = DB::table('procurements')
            ->where('type', '=', 'خریداری')
            ->where('end', '>', Carbon::today())
            ->select('type', 'id')
            ->get();
        $purchases = DB::table('purchases')
            ->join('goods', 'goods.id', '=', 'purchases.good_id')
            ->where('purchases.status', '=', 0)
            ->select('purchases.id', 'purchases.quantity', 'purchases.price_per', 'purchases.total', 'purchases.date',
                'purchases.description', 'goods.name')
            ->get();
        $delivered_purchases = DB::table('purchases')
            ->join('goods', 'goods.id', '=', 'purchases.good_id')
            ->where('purchases.status', '=', 1)
            ->select('purchases.id', 'purchases.quantity', 'purchases.price_per', 'purchases.total', 'purchases.date',
                'purchases.description', 'goods.name')
            ->get();
        $custom = null;
        if ($purchase->id) {
            $custom = DB::table('purchases')
                ->join('shops', 'shops.purchase_id', '=', 'purchases.id')
                ->where('purchases.id', '=', $purchase->id)
                ->select('purchases.*', 'shops.id as shop_id', 'shops.name', 'shops.price_per', 'shops.total')
                ->get();
        }
        $category_id = null;
        if ($purchase) {
            $category_id = DB::table('goods')
                ->where('goods.id', '=', $purchase->good_id)
                ->select('goods.category_id')->get()->map(function ($cat) {
                    return [
                        'category_id' => $cat->category_id,
                    ];
                });
        }
        return Inertia::render('Purchase/Show', [
            'categories' => Category::all(),
            'proc' => $proc,
            'delivered_purchases' => $delivered_purchases,
            'purchases' => $purchases,
            'purchase' => $custom,
            'category_id' => $category_id
        ]);
    }

    public function create(PurchaseRequest $request)
    {
        $purchase = new Purchase();
        $this->setup($purchase, $request);
        $id = $purchase->save();
        $this->registerShop($request->input('seller_one'), $id,
            $request->input('quantity'), $request->input('price_one'));
        $this->registerShop($request->input('seller_two'), $id,
            $request->input('quantity'), $request->input('price_two'));
        $this->registerShop($request->input('seller_three'), $id,
            $request->input('quantity'), $request->input('price_three'));

        $proc = DB::table('procurements')
            ->where('type', '=', 'خریداری')
            ->where('end', '>', Carbon::today())
            ->select('type', 'id')
            ->get();
        return Inertia::render('Purchase/Show', [
            'categories' => Category::all(),
            'proc' => $proc
        ]);
    }

    public function registerShop($name, $purchase_id, $quantity, $price_per)
    {
        $shop = new Shop();
        $shop->name = $name;
        $shop->purchase_id = $purchase_id;
        $shop->quantity = $quantity;
        $shop->price_per = $price_per;
        $shop->total = $price_per * $quantity;
        $shop->save();
    }


    public function update(PurchaseRequest $request)
    {
        $purchase = Purchase::find($request->input('id'));
        $this->setup($purchase, $request);
        $purchase->save();
        $this->updateShop($request->input('shop_one'), $request->input('seller_one'),
            $request->input('id'), $request->input('quantity'), $request->input('price_one'));
        $this->updateShop($request->input('shop_two'), $request->input('seller_two'),
            $request->input('id'), $request->input('quantity'), $request->input('price_two'));
        $this->updateShop($request->input('shop_three'), $request->input('seller_three'),
            $request->input('id'), $request->input('quantity'), $request->input('price_three'));
        return $this->index($purchase);
    }

    public function updateShop($id, $name, $purchase_id, $quantity, $price_per)
    {
        $shop = Shop::find($id);
        $shop->name = $name;
        $shop->purchase_id = $purchase_id;
        $shop->quantity = $quantity;
        $shop->price_per = $price_per;
        $shop->total = $price_per * $quantity;
        $shop->save();
    }

    public function setup(Purchase $purchase, Request $request)
    {

        $price_per = null;
        if ($request->input('price_one') >= $request->input('price_two')) {
            $price_per = $request->input('price_two');
        } else {
            $price_per = $request->input('price_one');
        }
        if ($request->input('price_three') <= $price_per) {
            $price_per = $request->input('price_three');
        }

        $total = $price_per * $request->input('quantity');
        $purchase->good_id = $request->input('good_id');
        $purchase->quantity = $request->input('quantity');
        $purchase->date = $request->input('date');
        $purchase->price_per = (int)$price_per;
        $purchase->total = $total;
        $purchase->proc_id = $request->input('proc_id');
        $purchase->status = $request->input('status');
        $purchase->description = $request->input('description');
        $purchase->sokok = $request->input('sokok');
        $purchase->tax = $request->input('tax');
        $purchase->taminat = $request->input('taminat');
        $purchase->kasrat = $request->input('kasrat');
        $purchase->payment = (int)$request->input('payment');
        $purchase->prepared = $request->input('prepared');
        $purchase->manzori = $request->input('manzori');
        $purchase->amer = $request->input('amer');
        $purchase->boss = $request->input('boss');
    }
}
