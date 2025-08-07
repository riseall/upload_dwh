<?php

namespace App\Http\Controllers;

use App\Models\MstRM;
use Illuminate\Http\Request;

class MstRMController extends Controller
{
    public function index()
    {
        $Rm = MstRM::all();
        return view('mst_rm.index', compact('Rm'));
    }
}
