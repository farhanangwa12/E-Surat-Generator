<?php

use App\Http\Controllers\KontrakKerjaController;
use App\Http\Controllers\VendorController;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/showbyid/{id}', [VendorController::class, 'showbyid'])->name('vendor.showbyid');
Route::post('/simpanttd', [KontrakKerjaController::class, 'simpanttd'])->name('tandatangan.pengadaan.simpanttd');
