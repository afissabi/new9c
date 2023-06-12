<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function successJson($message, $data, $code = 200)
    {
        return response()->json([
            "code" => $code,
            "success" => true,
            "message" => $message,
            "data" => $data,
        ]);
    }

    public function failedJson($message, $data, $code = 404)
    {
        return response()->json([
            "code" => $code,
            "success" => false,
            "message" => $message,
            "data" => $data,
        ], 404);
    }
}
