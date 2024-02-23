<?php

namespace App\Trait;
use Illuminate\Http\Resources\Json\JsonResource;

trait HttpResponses
{
    public function response(int $code, $message = "", array|JsonResource $data = [])
    {
        return response()->json([
            "message"=> $message,
            "code"=> $code,
            "data"=> $data,
        ], $code);
    }
}
