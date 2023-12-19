<?php

namespace App\Traits;

use Symfony\Component\HttpFoundation\Response;

trait JsonResponse
{
    public function successResponse($data, $message = 'Operation Successful', $statusCode = Response::HTTP_OK)
    {
        $response = [
            'success' => true,
            'data' => $data,
            'message' => $message,
        ];

        return response()->json($response, $statusCode);
    }

    public function errorResponse($message = 'Operation Failed', $data = null, $statusCode = Response::HTTP_BAD_REQUEST)
    {
        $response = [
            'success' => false,
            'data' => $data,
            'message' => $message,
        ];

        return response()->json($response, $statusCode);
    }
}
