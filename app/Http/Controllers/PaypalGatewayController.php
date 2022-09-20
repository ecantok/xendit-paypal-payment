<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaypalGatewayController extends Controller
{
    private $provider;

    function __construct()
    {
        $this->provider = new PayPalClient;
        $this->provider->setApiCredentials(config('paypal'));
        $token = $this->provider->getAccessToken();
        $this->provider->setAccessToken($token);
    }

    public function createOrder(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $dataOrder = [
            "intent" => "CAPTURE",
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => env('PAYPAL_CURRENCY'),
                        "value" => $data['amount'],
                    ],
                    "description" => "Purchase Of Human Race Dream Project 2022 #001"
                ],
            ],
        ];

        $order = $this->provider->createOrder($dataOrder);

        return response()->json($order);
    }

    public function captureOrder(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $orderId = $data['orderId'];

        // $showOrderCapture = $this->provider->showOrderDetails($orderId);

        $resultCapture = $this->provider->capturePaymentOrder($orderId);

        return response()->json($resultCapture);
    }
}
