<?php

use App\Models\Currency;
use Illuminate\Support\Facades\Log;

/** Money & Curreny */
function Money($amount = 500, $base = null)
{
    $base = $base ?: defaultLocation();

    $app = currency($base);
    if ($app) {
        $convert = $app[2];
        $count = $app[3];
        $symbol = $app[4];

        $money = ($convert != 1) ? ceil($amount / $convert) : $amount;
        $money = NumberFormat($money, $count);

        return '<span class="nowrap">' . $money . ' <sup style="font-size:0.6em;">' . Lang($symbol) . '</sup></span>';
    }

    return $amount;
}

function currency($base)
{
    $currency = getCurrency();
    $location = getLocation();

    if ($currency[0] != $base || $currency[1] != $location) {
        $base_currency = Currency::whereHas('country', function ($c) use ($base) {
            $c->where('code', $base);
        })->first();
        $location_currency = Currency::whereHas('country', function ($c) use ($location) {
            $c->where('code', $location);
        })->first();
        $convert = ConversionRate($base_currency->code, $location_currency->code);
        $count = $location_currency->count;
        $symbol = $location_currency->symbol;

        $currency = [$base, $location, $convert, $count, $symbol];
        setCurrency($currency);
    }

    return $currency;
}

function ConversionRate($baseCode, $locationCode)
{

    $cacheKey = 'conversion_rate_' . $baseCode;

    try{
        if (has_cache($cacheKey)) {
            $data = get_cache($cacheKey);
        } else {
            $response = file_get_contents('https://www.floatrates.com/daily/' . $baseCode . '.json');
            $data = json_decode($response);
            set_cache($cacheKey, $data, 360);
        }

        if ($data && isset($data->{strtolower($locationCode)})) {
            return $data->{strtolower($locationCode)}->inverseRate;
        }

        // Fallback to default rate if not found
        return 1;
    } catch (Exception $e){
        Log::error("Conversion rate error: " . $e->getMessage());
        return 1; // Default fallback
    }
}

/** Phone */
function PhoneCode()
{
    return getCountryData()->phone_code;
}

function PhoneCount()
{
    return getCountryData()->phone_count;
}
