<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaypalGatewayController;
use App\Http\Controllers\Api\Payment\PaypalController;
use App\Http\Controllers\Api\Payment\VexController;
use App\Http\Controllers\Api\Payment\XenditController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('xendit/va/list', [XenditController::class, "getListPaymentChannel"]);
Route::get('xendit/va/create', [XenditController::class, "createVA"]);

Route::prefix("paypal")->group(function () {
    Route::post("/checkout", [PaypalController::class, "OrderCheckout"])->name("paypal-checkout");
    Route::get("/success", [PaypalController::class, "OrderSuccess"])->name("paypal-success");
    Route::get("/cancel", [PaypalController::class, "OrderCancel"])->name("paypal-cancel");
});

Route::prefix("paypal-gateway")->group(function () {
    Route::post("/checkout", [PaypalGatewayController::class, "createOrder"])->name('paypal-gateway-checkout');
    Route::post("/capture", [PaypalGatewayController::class, "captureOrder"])->name("paypal-gateway-capture");
    Route::get("/OrderDetails", [PaypalGatewayController::class, "getOrderData"]);
});

Route::prefix("v1")->group(function () {
    Route::post("/vex/purchase", [VexController::class, "purchase"]);
});
