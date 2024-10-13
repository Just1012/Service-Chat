<?php

namespace App\Http\Helpers;



class Hashing
{


   public static function generateKashierOrderHash($order){
        $mid = env('KASHIER_MERCHANT_ID');
        $amount = $order->total;
        $currency = $order->currency;
        $orderId = $order->order_merchant_id;
        $secret = env('KASHIER_PUBLIC_KEY');

        $path = "/?payment=".$mid.".".$orderId.".".$amount.".".$currency;
        $hash = hash_hmac( 'sha256' , $path , $secret ,false);
        return $hash;
    }

}