<?php

use App\Http\Controllers\MstCbgDistController;
use App\Http\Controllers\MstCbgPHController;
use App\Models\MstCbgPH;
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
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Route Master Cabang Distributor
Route::resource('mst_cbg_dist', MstCbgDistController::class);

require __DIR__ . '/auth.php';
