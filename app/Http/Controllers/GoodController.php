<?php

namespace App\Http\Controllers;

use App\Http\Requests\GoodRequest;
use App\Models\Category;
use App\Models\Good;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class GoodController extends Controller
{
    public function index()
    {
        $goods = DB::table('goods')
            ->join('categories', 'categories.id', '=', 'goods.category_id')
            ->join('units', 'units.id', '=', 'goods.unit_id')
            ->select('goods.*', 'categories.name as cat_name', 'units.name as unit_name')
            ->get();

        return Inertia::render('Good/Show', [
            'goods' => $goods,
            'categories' => Category::all(),
            'unites' => Unit::all()
        ]);
    }

    public function createGood(GoodRequest $request)
    {
        /* Creating Good object an assigning incoming filtered data in order to create new record in database */
        $good = new Good();

        $this->setup($request, $good);

        $good->quantity = 0;
        $good->save();

        /* instead of  writing duplicate code we used index function to get back to Goods Show page with it's related
           data */
        return $this->index();
    }

    public function createCategory(Request $request)
    {
        /* Validating incoming data from Register Category form */
        $request->validate([
            'cat_name' => ['bail', 'required', 'regex:/^[\pL\s\-]+$/u', 'min:3', 'max:50']
        ], [
            'required' => 'وارد نمودن :attribute الزامی می باشد',
            'regex' => ':attribute باید تنها حروف الفبا در خود داشته باشد',
            'min' => ':attribute حداقل باید :min حرف باشد',
            'max' => ':attribute حداکثر باید :max حرف باشد',
        ], [
            'cat_name' => 'نام کتگوری'
        ]);

        /* Creating new category Object to record new field in database */
        $category = new Category();
        $category->name = $request->input('cat_name');
        $category->save();

        /* instead of  writing duplicate code we used index function to get back to Goods Show page with it's related
          data */
        return $this->index();
    }

    public function createUnit(Request $request)
    {
        /* Validating incoming data from Register Category form */
        $request->validate([
            'unit_name' => ['bail', 'required', 'regex:/^[\pL\s\-]+$/u', 'min:3', 'max:50']
        ], [
            'required' => 'وارد نمودن :attribute الزامی می باشد',
            'regex' => ':attribute باید تنها حروف الفبا در خود داشته باشد',
            'min' => ':attribute حداقل باید :min حرف باشد',
            'max' => ':attribute حداکثر باید :max حرف باشد',
        ], [
            'unit_name' => 'نام واحد'
        ]);

        /* Creating new category Object to record new field in database */
        $category = new Unit();
        $category->name = $request->input('unit_name');
        $category->save();

        /* instead of  writing duplicate code we used index function to get back to Goods Show page with it's related
          data */
        return $this->index();
    }

    public function editGood(Good $good)
    {
        $goods = DB::table('goods')
            ->join('categories', 'categories.id', '=', 'goods.category_id')
            ->join('units', 'units.id', '=', 'goods.unit_id')
            ->select('goods.*', 'categories.name as cat_name', 'units.name as unit_name')
            ->get();

        return Inertia::render('Good/Partials/ShowGood', [
            'goods' => $goods,
            'categories' => Category::all(),
            'unites' => Unit::all(),
            'good' => $good
        ]);
    }

    public function updateGood(GoodRequest $request)
    {
        $good = Good::find($request->input('id'));
        $this->setup($request, $good);
        $good->save();
        return $this->editGood($good);
    }

    public function setup(GoodRequest $request, Good $good)
    {
        $good->name = $request->input('name');
        $good->category_id = $request->input('category_id');
        $good->unit_id = $request->input('unit_id');
        $good->properties = $request->input('properties');
    }

    public function editUnit(Unit $unit)
    {
        $goods = DB::table('goods')
            ->join('categories', 'categories.id', '=', 'goods.category_id')
            ->join('units', 'units.id', '=', 'goods.unit_id')
            ->select('goods.*', 'categories.name as cat_name', 'units.name as unit_name')
            ->get();

        return Inertia::render('Good/Partials/ShowUnit', [
            'goods' => $goods,
            'categories' => Category::all(),
            'unites' => Unit::all(),
            'unit' => $unit
        ]);
    }

    public function updateUnit(Request $request)
    {
        /* Validating incoming data from Register Category form */
        $request->validate([
            'unit_name' => ['bail', 'required', 'regex:/^[\pL\s\-]+$/u', 'min:3', 'max:50']
        ], [
            'required' => 'وارد نمودن :attribute الزامی می باشد',
            'regex' => ':attribute باید تنها حروف الفبا در خود داشته باشد',
            'min' => ':attribute حداقل باید :min حرف باشد',
            'max' => ':attribute حداکثر باید :max حرف باشد',
        ], [
            'unit_name' => 'نام واحد'
        ]);

        /* Creating new category Object to record new field in database */
        $unit = Unit::find($request->input('id'));
        $unit->name = $request->input('unit_name');
        $unit->save();

        return $this->editUnit($unit);
    }


    public function editCategory(Category $category)
    {
        $goods = DB::table('goods')
            ->join('categories', 'categories.id', '=', 'goods.category_id')
            ->join('units', 'units.id', '=', 'goods.unit_id')
            ->select('goods.*', 'categories.name as cat_name', 'units.name as unit_name')
            ->get();

        return Inertia::render('Good/Partials/ShowCategory', [
            'goods' => $goods,
            'categories' => Category::all(),
            'unites' => Unit::all(),
            'category' => $category
        ]);
    }

    public function updateCategory(Request $request)
    {
        /* Validating incoming data from Register Category form */
        $request->validate([
            'cat_name' => ['bail', 'required', 'regex:/^[\pL\s\-]+$/u', 'min:3', 'max:50']
        ], [
            'required' => 'وارد نمودن :attribute الزامی می باشد',
            'regex' => ':attribute باید تنها حروف الفبا در خود داشته باشد',
            'min' => ':attribute حداقل باید :min حرف باشد',
            'max' => ':attribute حداکثر باید :max حرف باشد',
        ], [
            'cat_name' => 'نام کتگوری'
        ]);

        /* Creating new category Object to record new field in database */
        $category = Category::find($request->input('id'));
        $category->name = $request->input('cat_name');
        $category->save();
        return $this->editCategory($category);
    }
}
