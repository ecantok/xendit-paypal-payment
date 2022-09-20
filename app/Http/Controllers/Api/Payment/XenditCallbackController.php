<?php

namespace App\Http\Controllers\Api\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Xendit\Xendit;

class XenditCallbackController extends Controller
{
    private $TokenCallBack = "teWMPIxCRTsBqvhR79qXVQXVbu1iaXAH0GXKEoXAwTWTzFDr";

    public function __construct()
    {
        Xendit::setApiKey(env("API_KEY"));
    }

    public function InvoicesCallback()
    {
        $callbackUrlParams = [
            'url' => url()->current()
        ];

        $callbackType = 'invoice';
        $setCallbackUrl = \Xendit\Platform::setCallbackUrl($callbackType, $callbackUrlParams);

        var_dump($setCallbackUrl);
    }
}
