<?php

namespace App\Helpers;

class ResponseHelper
{

    public static function responseDisplay($status, $message, $data = null)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $status);
    }

    public static function success($message, $data = null)
    {
        return response()->json([
            'message' => $message,
            'data' => $data,
        ], 200);
    }

    public static function badRequest($message, $data = null)
    {
        return response()->json([
            'message' => $message,
            'data' => $data,
        ], 400);
    }

    public static function unAuthorized($message, $data = null)
    {
        return response()->json([
            'message' => $message,
            'data' => $data,
        ], 401);
    }

    public static function forbidden($message, $data = null)
    {
        return response()->json([
            'message' => $message,
            'data' => $data,
        ], 403);
    }
    
    public static function response($data = 'fail', $status = false)
    {
        return ['status' => $status, 'data' => $data];
    }
}
