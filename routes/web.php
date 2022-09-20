<?php

use App\Http\Controllers\Api\Payment\PaypalController;
use App\Http\Controllers\Api\Payment\XenditCallbackController;
use App\Http\Controllers\Api\Payment\XenditController;
use App\Http\Controllers\productController;
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

Route::get('/', [productController::class, "index"])->name("home");
Route::post('/checkout', [XenditController::class, "createInvoice"])->name("checkout");
Route::get("/region/{region}", [productController::class, "changeRegion"])->name("change-currency");
