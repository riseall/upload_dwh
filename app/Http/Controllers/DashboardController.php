<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $cbg_dist = DB::table('mst_cbg_dist')->Count();
        $cbg_ph = DB::table('mst_cbg_ph')->Count();
        $cust_dist = DB::table('mst_cust_dist')->count();
        $cov_am = DB::table('mst_am')->Count();
        $cov_gm = DB::table('mst_gm')->Count();
        $cov_mr = DB::table('mst_mr')->Count();
        $cov_rm = DB::table('mst_rm')->Count();
        $cov_sam = DB::table('mst_sam')->Count();
        $top = DB::table('top_marketing')->count();

        return view('welcome', compact('cbg_dist', 'cbg_ph', 'cust_dist', 'cov_am', 'cov_gm', 'cov_mr', 'cov_rm', 'cov_sam', 'top'));
    }
}
