<?php

namespace App\Http\Controllers;

use App\Models\membership;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Total Members
        $memberships_count = membership::count();

        // Total Members per year for last 5 years
        $members_per_year = DB::table('memberships')
            ->groupByRaw('YEAR(gvBrowseUDF_TARIKHMEMOHON)')
            ->selectRaw('YEAR(gvBrowseUDF_TARIKHMEMOHON) as year, count(*) as count')
            ->orderByRaw('YEAR(gvBrowseUDF_TARIKHMEMOHON) DESC')
            ->limit(5)
            ->get();

        // Total payments for last 5 years
        $payments_per_year = DB::table('payments')
            ->groupByRaw('YEAR(payment_date)')
            ->selectRaw('YEAR(payment_date) as year, sum(amount) as sum')
            ->orderByRaw('YEAR(payment_date) DESC')
            ->limit(5)
            ->get();

        return view('home', compact('memberships_count', 'members_per_year', 'payments_per_year'));
    }
}
