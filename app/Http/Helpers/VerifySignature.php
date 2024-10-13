<?php

namespace App\Http\Helpers;



class VerifySignature
{


    public static function verifyRedirectSignature(){
        $queryString = "";
        $secret = env('KASHIER_PUBLIC_KEY');
        foreach ($_GET as $key => $value) {
            if($key == "signature" || $key== "mode"){
                continue;
            }
            $queryString = $queryString."&".$key."=".$value;
        }
        $queryString = ltrim($queryString, $queryString[0]);
        $signature = hash_hmac( 'sha256' , $queryString , $secret ,false);
        return $signature == $_GET["signature"];
    }

}