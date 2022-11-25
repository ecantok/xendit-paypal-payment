<?php

namespace App\Http\Controllers\Api\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\SUpport\Str;

class VexController extends Controller
{
    public function purchase()
    {
        $data = [
            "status" => "COMPLETED",
            "id" => Str::random(12),
        ];
        return response()->json($data);
    }
}
