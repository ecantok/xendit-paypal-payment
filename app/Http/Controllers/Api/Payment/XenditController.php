<?php

namespace App\Http\Controllers\Api\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Xendit\Xendit;
use Faker\Factory as DummyData;
use Illuminate\Validation\Rules\Unique;

class XenditController extends Controller
{
    public function __construct()
    {
        Xendit::setApiKey(env('XENDIT_API_KEY'));
    }

    public function getListPaymentChannel()
    {
        $getPaymentChannels = \Xendit\VirtualAccounts::getVABanks();

        return response()->json([
            'data' => $getPaymentChannels
        ])->setStatusCode(200);
    }

    public function createVA()
    {
        $DummyData = DummyData::create('id_ID');

        $data = [
            "external_id" => uniqid(),
            "bank_code" => "MANDIRI",
            "name" => $DummyData->name(),
        ];

        $createVA = \Xendit\VirtualAccounts::create($data);

        return response()->json(['data' => $createVA])->setStatusCode(200);
    }

    public function createInvoice(Request $request)
    {
        $request->validate(
            [
                'firstname' => 'required',
                'lastname' => 'required',
                'phonenumber' => 'required',
                'email' => 'required|email',
                'location-form' => 'required',
                'address' => 'required'
            ]
        );


        $data_items = [
            "items" => [
                [
                    "name" => "Human Race Dream Project 2022 #001",
                    "quantity" => 1,
                    "price" => 750000
                ]
            ],
        ];

        $amount = $data_items['items'][0]['price'] * $data_items['items'][0]['quantity'];

        $dataForm = [
            "external_id" => "test_" . uniqid(),
            "payer_email" => $request->email,
            "description" => "testing checkout " . $request->firstname,
            "amount" => $amount,
            "customer" => [
                "given_names" => $request->firstname,
                "surname" => $request->lastname,
                "email" => $request->email,
                "mobile_number" => "+62" . $request->phonenumber,
                "address" => [
                    [
                        "country" => "Indonesia",
                        "state" => "Bali",
                        "city" => $request->location,
                        "street_line1" => $request->address,
                        "street_line2" => $request->address,
                        "postal_code" => '124577'
                    ]
                ]
            ],
            "success_redirect_url" => route("home"),
            "failure_redirect_url" => route("home"),
            'customer_notification_preference' => [
                'invoice_created' => [
                    'whatsapp',
                    'sms',
                    'email'
                ],
                'invoice_reminder' => [
                    'whatsapp',
                    'sms',
                    'email'
                ],
                'invoice_paid' => [
                    'whatsapp',
                    'sms',
                    'email'
                ],
                'invoice_expired' => [
                    'whatsapp',
                    'sms',
                    'email'
                ]
            ],
        ];

        // var_dump(json_encode($dataForm));

        $customerData = array_merge($dataForm, $data_items);

        try {
            $createCustomer = \Xendit\Invoice::create($customerData);
            session()->flash("id_invoices", $createCustomer['id']);
        } catch (\Throwable $error) {
            $createCustomer = $error->getMessage();
            return response()->json(['response_data' => $createCustomer]);
        }

        // return redirect()->away($createCustomer['invoice_url']);

        return response()->json(compact('createCustomer'));
    }
}
