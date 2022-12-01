<?php

namespace App\Http\Controllers;

use App\Http\Requests\DemandRequest;
use App\Models\Category;
use App\Models\Demand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class DemandController extends Controller
{
    /* This function is used to show request main page and sends it's data */
    public function index(Demand $demand = null)
    {
        $demands = DB::table('demands')
            ->join('goods', 'goods.id', '=', 'demands.good_id')
            ->join('users', 'users.id', '=', 'demands.user_id')
            ->select('demands.*', 'goods.name as good_name', 'goods.quantity as good_quantity', 'users.name', 'users.section')
            ->get();
        $category_id = null;
        if ($demand) {
            $category_id = DB::table('goods')
                ->where('goods.id', '=', $demand->good_id)
                ->select('goods.category_id')->get()->map(function ($cat) {
                    return [
                        'category_id' => $cat->category_id,
                    ];
                });
        }

        return Inertia::render('Demand/Show', [
            'demands' => $demands,
            'categories' => Category::all(),
            'demand' => $demand,
            'category_id' => $category_id,
            'user' => Auth::user()
        ]);
    }

    /* This function is being used to create a new Request with pending status */
    public function create(DemandRequest $request)
    {

        /* Creating new demand object to store as a record in our database */
        $demand = new Demand();
        $this->setup($request, $demand);
        $demand->status = 0;
        $demand->save();

        /* Using the index method to avoid duplicate code for redirection and fetching data from database */
        return $this->index();
    }

    /* This function is being used to create a new Request with pending status */
    public function update(Request $request)
    {
        /* Creating new demand object to store as a record in our database */
        $demand = Demand::find($request->input('id'));
        $this->setup($request, $demand);
        $demand->status = $request->input('status');
        $demand->save();

        /* Using the index method to avoid duplicate code for redirection and fetching data from database */
        return $this->index($demand);
    }

    /* This function is being used by axis library to get specific good */
    public function getGoods($id)
    {
        return DB::table('goods')
            ->where('category_id', '=', $id)
            ->select('goods.id', 'goods.name')->get()->map(function ($good) {
                return [
                    'id' => $good->id,
                    'name' => $good->name,
                ];
            });
    }


    public function setup(Request $request, Demand $demand)
    {
        $demand->user_id = Auth::user()->id;
        $demand->date = $request->input('date');
        $demand->good_id = $request->input('good_id');
        $demand->quantity = $request->input('quantity');
        $demand->description = $request->input('description');
    }
}
