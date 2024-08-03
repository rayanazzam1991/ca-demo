<?php


namespace App\Helpers\ApiHelper;


use Illuminate\Http\JsonResponse;

class ApiResponseHelper
{

    public static function sendResponse(Result $result): JsonResponse
    {

        $response = [
            'success' => $result->isOk,
            'error_code' => $result->code,
            'message' => $result->message,
            'data' => $result->result ?? null,
            'pagination' => $result->paginate ?? null
        ];
        if (env('APP_ENV') != 'production') {
            if ($result->exception != null) $response['exception'] = $result->exception;
        }
        return response()->json($response, (int)$result->code);
    }
//    public static function sendResponse($message, $data = null, $result = true, $code = 200, $exception = null):JsonResponse
//    {
//        $response = [
//            'message' => __('main.'.$message),
//            'success' => $result,
//            'code'=>$code,
//            'data' => (isset($data['data']))?$data['data']:$data,
//        ];
//        !isset($data['pagination'])?:$response['pagination'] = $data['pagination'];
//        if (env('app_env') != 'production') {
//            if ($exception != null) $response['exception'] = $exception;
//        }
//        return response()->json($response, (int)$code);
//    }
//    public static function sendErrorResponse(ErrorResult|ErrorValidationResult $response)
//    {
//        return \Response::json([
//            'message' => $response->message,
//            'success' => $response->isOk,
//            'code'=>$response->code,
//            'data' => null,
//        ], $response->code);
//    }
}
