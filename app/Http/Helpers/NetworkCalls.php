<?php

namespace App\Http\Helpers;

use Illuminate\Support\Facades\Http;


class NetworkCalls
{

    public static function apiGet($url, $queryParameters, $headers = '')
    {
        $response = Http::withHeaders($headers)->Get($url,
            $queryParameters);
        return $response;
    }

    public static function apiPost($url, $body, $headers = '')
    {
        $response = Http::withHeaders($headers)->post($url,
            $body);
        return $response;
    }

    public static function apiPut($url, $body, $headers = '')
    {
        $response = Http::withHeaders($headers)->put($url,
            $body);
        return $response;
    }
}