<?php

use App\Http\Controllers\MstAMController;
use App\Http\Controllers\MstCbgDistController;
use App\Http\Controllers\MstCbgPHController;
use App\Http\Controllers\MstCustDistController;
use App\Http\Controllers\MstGMController;
use App\Http\Controllers\MstMRController;
use App\Http\Controllers\MstRMController;
use App\Http\Controllers\MstSAMController;
use App\Http\Controllers\SellOutAMEController;
use App\Http\Controllers\SellOutKMEController;
use App\Http\Controllers\TopMarketingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('wel');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Route Master Cabang Distributor
Route::resource('mst_cbg_dist', MstCbgDistController::class)->except('show', 'create', 'store');
// Route Master Cabang Phapros
Route::resource('mst_cbg_ph', MstCbgPHController::class)->except('show', 'create', 'store');
// Route Master Customer Distributor Phapros
Route::get('/mst_cust_dist/data', [MstCustDistController::class, 'getData'])->name('mst_cust_dist.data');
Route::resource('mst_cust_dist', MstCustDistController::class)->only('index', 'create', 'store');
// Route Data Target Operasional
Route::resource('top_marketing', TopMarketingController::class)->only('index', 'create', 'store');
// Route Master Coverage AM
Route::resource('mst_am', MstAMController::class)->only('index', 'create', 'store');
// Route Master Coverage GM
Route::resource('mst_gm', MstGMController::class)->only('index', 'create', 'store');
// Route Master Coverage MR
Route::resource('mst_mr', MstMRController::class)->only('index', 'create', 'store');
// Route Master Coverage RM
Route::resource('mst_rm', MstRMController::class)->only('index', 'create', 'store');
// Route Master Coverage SAM
Route::resource('mst_sam', MstSAMController::class)->only('index', 'create', 'store');
// Route Selling Out AME
Route::resource('sell_out_ame', SellOutAMEController::class)->only('index', 'create', 'store');
// Route Selling Out KME
Route::resource('sell_out_kme', SellOutKMEController::class)->only('index', 'create', 'store');

require __DIR__ . '/auth.php';
