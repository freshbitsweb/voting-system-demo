<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    /**
     * Respond with success
     *
     * @param array $data
     * @param int $status
     * @param string $message
     * @return Json
     **/
    public function respond($data, $message = "success", $status = 200)
    {
        return response()->json([
            'data' => $data,
            'status' => $status,
            'message' => $message
        ]);
    }
}
