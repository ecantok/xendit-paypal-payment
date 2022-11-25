<?php

namespace App\Http\Controllers;

use Xendit\Xendit;

use Illuminate\Http\Request;
use AmrShawky\LaravelCurrency\Facade\Currency;
use MoneyCurrency;

class productController extends Controller
{
    public function index()
    {
        Xendit::setApiKey(env("API_KEY"));

        $priceIDR = 100000;
        $priceUSD = MoneyCurrency::IDRToUSD($priceIDR);
        $priceVEX = "0.0001 VEX";

        $data = [
            "price" => (session()->get("localization_currency") == "USD") ? $priceUSD : 
                        ((session()->get("localization_currency") == "VEX") ? $priceVEX : number_format($priceIDR))
                ,
        ];

        if (session()->get('localization_currency') == "ID") {
            $id = session("id_invoices");

            if (isset($id)) {
                $getInvoices = \Xendit\Invoice::retrieve($id);
                if ($getInvoices) {
                    if ($getInvoices['status'] != "PENDING") {
                        session()->flash("message_success", "Payment Success, please check your email or whatsapp for notification");
                    } else {
                        session()->flash("message_failed", "Your Process Payment is not completed, check email or whatsapp to get invoices and completed your payment process");
                    }
                }
            }
        }

        return view('product.index', compact('data'));
    }

    public function changeRegion($region)
    {
        Session()->put("localization_currency", $region);

        return redirect()->back();
    }
}
