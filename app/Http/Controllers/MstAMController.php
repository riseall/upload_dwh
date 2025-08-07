<?php

namespace App\Http\Controllers;

use App\Models\MstAM;
use Illuminate\Http\Request;

class MstAMController extends Controller
{
    public function index()
    {
        $Am = MstAM::all();
        return view('mst_am.index', compact('Am'));
    }
}
