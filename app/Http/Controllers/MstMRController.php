<?php

namespace App\Http\Controllers;

use App\Models\MstMR;
use Illuminate\Http\Request;

class MstMRController extends Controller
{
    public function index()
    {
        $mr = MstMR::all();
        return view('mst_mr.index', compact('mr'));
    }
}
