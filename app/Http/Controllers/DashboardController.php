<?php

namespace App\Http\Controllers;

use App\Models\MstAM;
use App\Models\MstCbgDist;
use App\Models\MstCbgPH;
use App\Models\MstCustDist;
use App\Models\MstGM;
use App\Models\MstMR;
use App\Models\MstRM;
use App\Models\MstSAM;
use App\Models\TopMarketing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $cbg_dist = MstCbgDist::all()->Count();
        $cbg_ph = MstCbgPH::all()->Count();
        $cust_dist = MstCustDist::all()->Count();
        $cov_am = MstAM::all()->Count();
        $cov_gm = MstGM::all()->Count();
        $cov_mr = MstMR::all()->Count();
        $cov_rm = MstRM::all()->Count();
        $cov_sam = MstSAM::all()->Count();
        $top = DB::table('top_marketing')->count();;

        return view('welcome', compact('cbg_dist', 'cbg_ph', 'cust_dist', 'cov_am', 'cov_gm', 'cov_mr', 'cov_rm', 'cov_sam', 'top'));
    }
}
