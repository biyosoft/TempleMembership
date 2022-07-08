<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\membership;
use App\Models\sync;
use Illuminate\Support\Facades\Auth;
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
        //Displaying sync based on last value 
        $sync = sync::all();
        
        $is_sync =DB::table('syncs')
        ->orderBy('id','DESC')
        ->first();

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

        return view('home', compact('memberships_count', 'members_per_year', 'payments_per_year','is_sync'));
    }

    public function is_sync(Request $request){
        $user_id = Auth::user()->id;
        $sync = new Sync;
        $sync->status = 1;
        $sync->user_id = $user_id;
        $sync->save();
        return redirect()->back()->with('success','Synced Request Is Submitted !');
    }
}
