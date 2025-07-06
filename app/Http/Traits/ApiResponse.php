<?php

namespace App\Http\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse{
   protected function success($data = null, $message = 'Success', $code = 200): JsonResponse
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'code' => $code,
            'data' => $data,
        ], $code);
    }

    protected function error($data = null, $message = 'Error', $code = 400): JsonResponse
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'code' => $code,
            'data' => $data,
        ], $code);
    }
}