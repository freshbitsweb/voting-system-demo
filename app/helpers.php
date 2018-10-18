<?php

/**
 * Responds to api request with the standard format.
 *
 * @param string Message of the action
 * @param array Data to be returned
 * @param int HTTP status code (optional)
 * @param bool Values for the success parameter
 * @return json
 **/
function apiResponse($message, $data = [], $statusCode = 200, $success = true)
{
    return response()->json([
        'success' => $success,
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
function apiFailureResponse($message, $data = [], $statusCode = 200)
{
    return apiResponse($message, $data, $statusCode, $success = false);
}
