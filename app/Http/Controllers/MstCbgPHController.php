<?php

namespace App\Http\Controllers;

use App\Models\MstCbgPH;
use Illuminate\Http\Request;

class MstCbgPHController extends Controller
{
    public function index()
    {
        $cbgPH = MstCbgPH::all();
        return view('mst_cbg_ph.index', compact('cbgPH'));
    }
}
