<?php

namespace App\Http\Controllers;

use App\Models\TopMarketing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TopMarketingController extends Controller
{
    public function index()
    {
        $tp = TopMarketing::all();
        return view('top_marketing.index', compact('tp'));
    }
}
