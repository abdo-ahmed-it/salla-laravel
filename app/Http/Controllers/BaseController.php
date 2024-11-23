<?php

namespace App\Http\Controllers;

class BaseController extends Controller
{
    public function sendSuccess($data, $message = Null)
    {
        $response = [
            'success' => true,
            'message' => $message ?? 'success',
            'data' => $data
        ];
        return response()->json($response, 200);
    }

    public function sendError($error, $errorMessages = [], $code = 404,)
    {
        $response = [
            'success' => false,
            'errors' => $error
        ];
        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }
        return response()->json($response, $code);
    }


}
