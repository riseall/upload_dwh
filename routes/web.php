<?php

use App\Http\Controllers\DashboardController;
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
use App\Http\Controllers\UserController;
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
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('wel');

    Route::resource('users', UserController::class)->except('show', 'destroy');
    // Route Master Cabang Distributor
    Route::resource('mst_cbg_dist', MstCbgDistController::class)->except('show', 'create', 'store');
    // Route Master Cabang Phapros
    Route::resource('mst_cbg_ph', MstCbgPHController::class)->except('show', 'create', 'store');
    // Route Master Customer Distributor Phapros
    Route::get('/mst_cust_dist/data', [MstCustDistController::class, 'getData'])->name('mst_cust_dist.data');
    Route::resource('mst_cust_dist', MstCustDistController::class)->only('index', 'store');
    // Route Data Target Operasional
    Route::get('/top_marketing/data', [TopMarketingController::class, 'getData'])->name('top_marketing.data');
    Route::resource('top_marketing', TopMarketingController::class)->only('index', 'store');
    // Route Master Coverage AM
    Route::get('/mst_am/data', [MstAMController::class, 'getData'])->name('mst_am.data');
    Route::resource('mst_am', MstAMController::class)->only('index', 'store');
    // Route Master Coverage GM
    Route::get('/mst_gm/data', [MstGMController::class, 'getData'])->name('mst_gm.data');
    Route::resource('mst_gm', MstGMController::class)->only('index', 'store');
    // Route Master Coverage MR
    Route::get('/mst_mr/data', [MstMRController::class, 'getData'])->name('mst_mr.data');
    Route::resource('mst_mr', MstMRController::class)->only('index', 'store');
    // Route Master Coverage RM
    Route::get('/mst_rm/data', [MstRMController::class, 'getData'])->name('mst_rm.data');
    Route::resource('mst_rm', MstRMController::class)->only('index', 'store');
    // Route Master Coverage SAM
    Route::get('/mst_sam/data', [MstSAMController::class, 'getData'])->name('mst_sam.data');
    Route::resource('mst_sam', MstSAMController::class)->only('index', 'store');
    // Route Selling Out AME
    Route::post('/sell_out_ame/data', [SellOutAMEController::class, 'getData'])->name('sell_out_ame.data');
    Route::resource('sell_out_ame', SellOutAMEController::class)->only('index', 'store');
    // Route Selling Out KME
    Route::post('/sell_out_kme/data', [SellOutKMEController::class, 'getData'])->name('sell_out_kme.data');
    Route::resource('sell_out_kme', SellOutKMEController::class)->only('index', 'store');
});
require __DIR__ . '/auth.php';
