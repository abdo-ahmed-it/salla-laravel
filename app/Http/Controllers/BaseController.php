<?php

namespace App\Http\Controllers;

class BaseController extends Controller
{
    public function sendSuccess($message, $data)
    {
        $response = [
            'success' => true,
            'message' => $message,
            'data' => $data
        ];
        return response()->json($response, 200);
    }

    public function sendError($error, $errorMessages = [], $code = 404,)
    {
        $response = [
            'success' => false,
            'message' => $error
        ];
        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }
        return response()->json($response, $code);
    }


}
