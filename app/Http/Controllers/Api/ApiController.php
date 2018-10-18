<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    /**
     * Responds to api request with the standard format.
     *
     * @param string Message of the action
     * @param array Data to be returned
     * @param int HTTP status code (optional)
     * @return json
     **/
    public function respond($message, $data = [], $statusCode = 200)
    {
        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => $message
        ], $statusCode);
    }

    /**
     * Responds to api request with the failure message.
     *
     * @param string Message of the action
     * @param array Data to be returned
     * @param int HTTP status code (optional)
     * @return json
     **/
    public function respondWithFailure($message, $data = [], $statusCode = 200)
    {
        return response()->json([
            'success' => false,
            'data' => $data,
            'message' => $message
        ], $statusCode);
    }
}
