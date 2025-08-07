<?php

namespace App\Http\Controllers;

use App\Models\MstCustDist;
use Illuminate\Http\Request;

class MstCustDistController extends Controller
{
    public function index()
    {
        $custDist = MstCustDist::all();
        return view('mst_cust_dist.index', compact('custDist'));
    }
}
