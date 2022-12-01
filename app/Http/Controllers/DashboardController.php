<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $demands = null;
        $user = Auth::user();
        if ($user == 'کاربر') {
            $demands = DB::table('demands')
                ->join('goods', 'goods.id', '=', 'demands.good_id')
                ->join('users', 'users.id', '=', 'demands.user_id')
                ->select('demands.*', 'users.name', 'goods.name as good_name')
                ->where('status', '=', 0)
                ->where('demands.user_id', '=', $user->id)
                ->get();
        } else {
            $demands = DB::table('demands')
                ->join('goods', 'goods.id', '=', 'demands.good_id')
                ->join('users', 'users.id', '=', 'demands.user_id')
                ->select('demands.*', 'users.name', 'goods.name as good_name')
                ->where('status', '=', 0)->get();
        }
        $demands_count = DB::table('demands')
            ->where('status', '=', 0)->get()->count();
        $account = User::all()->count();
        $stocks = Stock::all()->count();
        return Inertia::render('Dashboard', [
            'totalDemand' => $demands,
            'demands_count' => $demands_count,
            'accounts' => $account,
            'stocks' => $stocks,
            'position' => $user->position
        ]);
    }
}
