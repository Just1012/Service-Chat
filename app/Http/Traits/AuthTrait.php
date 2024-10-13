<?php

namespace App\Http\Traits;
use Illuminate\Http\JsonResponse;

trait AuthTrait
{
    public function onError($status = null, $message = null){
        $array = [
            'status' => $status,
            'message' => $message,
        ];
        return response($array);
    }
}
