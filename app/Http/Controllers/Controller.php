<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    const SUCCESS_RESPONSE = 200;
    const FAILURE_RESPONSE = 422;
    const NOTFOUND_RESPONSE = 404;

    public function successResponse($data){
        return response()->json([
            'status' => Controller::SUCCESS_RESPONSE,
            'data' => $data,
        ],200);
    }

    public function failureResponse($errors){
        return response()->json([
            'status' => Controller::FAILURE_RESPONSE,
            'error' => $errors
        ],442);
    }


    public function notFoundResponse(){
        return response()->json([
            'status' => Controller::NOTFOUND_RESPONSE,
            'success' => Controller::FAILURE_MESSAGE
        ],404);
    }
}
