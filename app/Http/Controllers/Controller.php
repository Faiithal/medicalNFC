<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function BadRequest($validator, $message = "Request didn't pass the validation!"){
        if($validator != null){
        return response()->json([
            "ok" => false,
            "data" => $validator->errors(),
            "message" => $message
        ], 400);
    }
        
    else{
        return response()->json([
                "ok" => false,
                "message" => $message
            ], 400);
    }
    }

    /**
     * Returns a Created Status Code and appropriate message.
     * @param mixed $data
     * @param mixed $message
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function Created($data = [], $message = "Created!"){
        return response()->json([
            "ok" => true,
            "data" => $data,
            "message" => $message
        ], 201);
    }
    
    /**
     * Returns a Unauthorized Status Code and appropriate message.
     * @param mixed $data
     * @param mixed $message
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function Unauthorized($message = "Unauthorized!"){
        return response()->json([
            "ok" => false,
            "message" => $message
        ], 401);
    }

    /**
     * Returns a Ok Response.
     * @param mixed $data
     * @param mixed $message
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function Ok($data = [], $message = "Ok!"){
        return response()->json([
            "ok" => true,
            "data" => $data,
            "message" => $message
        ], 200);
    }
}
