<?php

namespace App\Http\Controllers;

use App\Models\SellOutKME;
use Illuminate\Http\Request;

class SellOutKMEController extends Controller
{
    public function index()
    {
        $KME = SellOutKME::all();
        return view('sell_out_kme.index', compact('KME'));
    }
}
