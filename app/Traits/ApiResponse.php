<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    public function successResponse($data, $code = 200): JsonResponse
    {
        return response()->json([
            'data' => $data,
            'status' => $code,
        ], $code);
    }

    public function errorResponse($message, $code): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'status' => $code,
        ], $code);
    }
}
