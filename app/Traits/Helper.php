<?php 

namespace App\Traits;

trait Helper
{
    public function jsonResponse($status, $message, $data = null)
    {

        $response = [
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ];
        return response()->json($response);
    }

}