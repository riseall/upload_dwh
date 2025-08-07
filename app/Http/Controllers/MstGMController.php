<?php

namespace App\Http\Controllers;

use App\Models\MstGM;
use Illuminate\Http\Request;

class MstGMController extends Controller
{
    public function index()
    {
        $Gm = MstGM::all();
        return view('mst_gm.index', compact('Gm'));
    }
}
