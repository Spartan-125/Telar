<?php

namespace App\Utils;

use Illuminate\Support\Facades\Log;

abstract class ResponseHttp
{
    public static function success($data = [], $message = "Request successful", $code = 200)
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ], $code);
    }

    public static function error($message = "An error occurred", $code = 400, $data = [])
    {
        Log::error($message);
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'data' => $data
        ], $code);
    }
}
