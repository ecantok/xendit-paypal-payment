<?php

use AmrShawky\LaravelCurrency\Facade\Currency;

class MoneyCurrency
{
    public static function IDRToUSD($amount)
    {
        $USDConvert = Currency::convert()->from('IDR')->to('USD')->amount($amount)->get();

        return number_format($USDConvert, 2, ".", ".");
    }
}
