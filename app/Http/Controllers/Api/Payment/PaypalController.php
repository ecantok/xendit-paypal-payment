<?php

namespace App\Http\Controllers\Api\Payment;

use Omnipay\Omnipay;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaypalController extends Controller
{
    private $gateway;

    function __construct()
    {
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(env('PAYPAL_SANDBOX_CLIENT_ID'));
        $this->gateway->setSecret(env('PAYPAL_SANDBOX_CLIENT_SECRET'));
        $this->gateway->setTestMode(true);
    }

    public function OrderCheckout(Request $request)
    {
        try {
            $data = [
                'amount' => $request->amount,
                'currency' => env('PAYPAL_CURRENCY'),
                'returnUrl' => url()->route('paypal-success'),
                'cancelUrl' => url()->route('paypal-cancel'),
            ];

            $response = $this->gateway->purchase($data)->send();

            if ($response->isRedirect()) {
                $response->redirect();
            } else {
                return $response->getMessage();
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function OrderSuccess(Request $request)
    {
        if ($request->input('paymentId') && $request->input('PayerID')) {

            $dataInput = [
                'transactionReference' => $request->paymentId,
                'payer_id' =>  $request->input('PayerID'),
                'paymentID' => $request->input('paymentId')
            ];

            $transaction = $this->gateway->completePurchase($dataInput);

            $response = $transaction->send();

            if ($response->isSuccessful()) {
                $data = $response->getData();

                $dataCustomers = [
                    'email' => $data['payer']['payer_info']['email'],
                    'status' => $data['state'],
                ];

                return "Payment Success Your Transaction ID " . $data['id'];
            } else {
                return $response->getMessage();
            }
        }
    }

    public function OrderCancel()
    {
        return "Your Transaction Is Canceled";
    }
}
