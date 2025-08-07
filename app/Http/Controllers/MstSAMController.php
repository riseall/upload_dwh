<?php

namespace App\Http\Controllers;

use App\Models\MstSAM;
use Illuminate\Http\Request;

class MstSAMController extends Controller
{
    public function index()
    {
        $Sam = MstSAM::all();
        return view('mst_sam.index', compact('Sam'));
    }
}
