<?php

namespace App\Helpers;

class ResponseHelper
{

    public static function reply($status, $message = '')
    {
        return [
            'status' => $status,
            'message' => $message,
        ];
    }

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
            'status' => true,
            'message' => $message,
            'data' => $data,
        ], 200);
    }

    public static function badRequest($message, $data = null)
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'data' => $data,
        ], 400);
    }

    public static function serverError($message)
    {
        return response()->json([
            'status' => false,
            'message' => $message,
        ], 500);
    }

    public static function unAuthorized($message, $data = null)
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'data' => $data,
        ], 401);
    }

    public static function forbidden($message, $data = null)
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'data' => $data,
        ], 403);
    }

    public static function response($data = 'fail', $status = false)
    {
        return ['status' => $status, 'data' => $data];
    }
}
