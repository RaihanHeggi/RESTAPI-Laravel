<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\ApiResponse;

class BaseController extends Controller
{
    use ApiResponse;

    public function sendSuccess($result, $message, $response_code){
        return $this->success($result, $message, $response_code);
    }

    public function sendError($result, $message=[], $error_code=404){        
        return $this->error($result, $message, $response_code);
    }

}
 