<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MoneyCurrency;
use Illuminate\Support\Facades\Cache;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaypalGatewayController extends Controller
{
    private $provider;

    function __construct()
    {
        $this->provider = new PayPalClient;
        $this->provider->setApiCredentials(config('paypal'));
        $token = Cache::get('paypal-token-'.config('paypal.mode', 'live'));

        if (empty($token)) {
            $token = $this->provider->getAccessToken();
            Cache::put('paypal-token', $token, ($token['expires_in'] - 10));
        }

        $this->provider->setAccessToken($token);
    }

    public function createOrder(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        // $priceIDR = 100000;
        $priceUSD = 12;
        $dataOrder = [
            "intent" => "CAPTURE",
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => config('paypal.currency'),
                        "value" => $priceUSD,
                    ],
                    "description" => "Purchase Of Human Race Dream Project 2022 #001"
                ],
            ],
            'application_context' => [
                'shipping_preference' => 'NO_SHIPPING',
           ]
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
