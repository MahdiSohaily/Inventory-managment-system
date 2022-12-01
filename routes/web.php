<?php

use App\Http\Controllers\ArrivalController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DemandController;
use App\Http\Controllers\DistributeController;
use App\Http\Controllers\GoodController;
use App\Http\Controllers\ProcurementController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\StockController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    /*Dashboard Route*/
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /*Profile related Routes*/
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'index')->name('profile'); /* Showing Profile Main Page*/
        Route::post('/profile', 'create')->name('profile.create'); /* Creating new Account*/
        Route::put('/profile', 'update')->name('profile.update'); /* updating user Account*/
        Route::put('/password', 'password')->name('password.update'); /* updating user Account password*/
        Route::delete('/profile/{user}', 'delete')->name('delete.profile'); /* deleting user Account*/
        Route::get('/user/edit/{user}', 'edit')->name('edit.user'); /* deleting user Account*/
    });


    /*Goods Related Routes*/
    Route::controller(GoodController::class)->group(function () {
        Route::get('/goods', 'index')->name('good'); /*Showing Goods Main Pages*/
        Route::post('/goods', 'createGood')->name('good.create'); /* Registering New Good */
        Route::get('/goods/{good}', 'editGood')->name('good.edit'); /* Registering New Good */
        Route::put('/goods', 'updateGood')->name('good.update'); /* Registering New Good */
        Route::post('/category', 'createCategory')->name('category.create'); /* Register New Category*/
        Route::get('/category/{category}', 'editCategory')->name('category.edit'); /* Register New Category*/
        Route::put('/category', 'updateCategory')->name('category.update'); /* Register New Category*/
        Route::post('/unit', 'createUnit')->name('Unit.create'); /* Registering New Unit */
        Route::get('/unit/{unit}', 'editUnit')->name('unit.edit'); /* Registering New Unit */
        Route::put('/unit/', 'updateUnit')->name('unit.update'); /* Registering New Unit */
    });

    /* Demands Related Routes */
    Route::controller(DemandController::class)->group(function () {
        Route::get('/demand/{demand?}', 'index')->name('demand'); /* Showing Demand of Request page */
        Route::post('/demand', 'create')->name('demand.create'); /* Route to the create function */
        Route::put('/demand', 'update')->name('demand.update'); /* Route to the update specified Demand */
        Route::get('/goods/get/{id}', 'getGoods')->name('goods.get'); /* Route to get specific goods based on a category */
    });

    /*Procurement Related Routes*/
    Route::controller(ProcurementController::class)->group(function () {
        Route::get('/procurement', 'index')->name('procurement');
        Route::post('/procurement', 'create')->name('procurement.create');
        Route::get('/procurement/{person}', 'edit')->name('procurement.edit');
        Route::put('/procurement', 'update')->name('procurement.update');
        /* Proc Create Routes */
        Route::post('/proc', 'createProc')->name('proc.create');
        Route::get('/proc/{procurement}', 'editProc')->name('proc.edit');
        Route::put('/proc', 'updateProc')->name('proc.update');
    });

    /* Stock Related Routes */
    Route::controller(StockController::class)->group(function () {
        Route::get('/stock/{stock?}', 'index')->name('stock');
        Route::post('/stock', 'create')->name('stock.create');
        Route::put('/stock', 'update')->name('stock.update');

    });

    /* Purchase Related Routes */
    Route::controller(PurchaseController::class)->group(function () {
        Route::get('/purchase/{purchase?}', 'index')->name('purchase');
        Route::post('/purchase', 'create')->name('purchase.create');
        Route::put('/purchase', 'update')->name('purchase.update');

    });

    /* Purchase Related Routes */
    Route::controller(BillController::class)->group(function () {
        Route::get('/bill/{purchase?}', 'index')->name('bill');
        Route::post('/bill', 'create')->name('bill.create');
        Route::get('/edit/{bill?}', 'edit')->name('bill.edit');
        Route::put('/bill', 'update')->name('bill.update');
        Route::get('/bills/get/{id}', 'getBills')->name('bills.get'); /* Route to get specific goods based on a category */
    });
    /* Arrival Related Routes */
    Route::controller(ArrivalController::class)->group(function () {
        Route::get('/arrival/{id?}', 'index')->name('arrival');
        Route::post('/arrival', 'create')->name('arrival.create');
        Route::get('/edit/{arrival?}', 'edit')->name('arrival.edit');
        Route::put('/arrival', 'update')->name('arrival.update');
        Route::get('/arrivals/get/{id}', 'getArrivals')->name('arrivals.get'); /* Route to get specific goods based on a category */
    });

    /* Distribute Related Routes */
    Route::controller(DistributeController::class)->group(function () {
        Route::get('/distribute/list', 'Distribute_list')->name('distribute.list');
        Route::get('/distribute/{id?}', 'index')->name('distribute');
        Route::post('/distribute', 'create')->name('distribute.create');
    });
});
