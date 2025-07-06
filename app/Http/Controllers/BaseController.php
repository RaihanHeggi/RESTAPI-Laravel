<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
  
class BaseController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result, $message, $response_code)
    {
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
            'status' => $response_code
        ];
  
        return response()->json($response, $response_code);
    }
  
    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $response_code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
            'data' => [],
            'status' => $response_code
        ];
  
        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }
  
        return response()->json($response, $response_code);
    }
}
 