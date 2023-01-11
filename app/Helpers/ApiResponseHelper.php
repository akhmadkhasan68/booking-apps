<?php
namespace App\Helpers;

class ApiResponseHelper {
    public static function successResponse(string $message, $data) {
        return response([
            'message' => $message,
            'data' => $data
        ]);
    }

    public static function errorResponse(string $message, $errorCode = 500) {
        return response([
            'message' => $message ?? "Error",
        ], $errorCode != 0 ? $errorCode : 500); 
    }
}
