<?php

namespace App\Http\Controllers;

use App\Models\SellOutAME;
use Illuminate\Http\Request;

class SellOutAMEController extends Controller
{
    public function index()
    {
        $AME = SellOutAME::all();
        return view('sell_out_ame.index', compact('AME'));
    }
}
