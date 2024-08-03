<?php

namespace App\Exceptions;

use App\Helpers\ApiHelper\ErrorResult;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\ErrorValidationResult;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\RecordsNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Validation\ValidationException;
use Nette\NotImplementedException;
use Saloon\Exceptions\SaloonException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register()
    {

        $this->renderable(function (Throwable $exception, $request) {

            switch ($exception) {
                case $exception instanceof AuthenticationException:
                    if ($request->wantsJson()) {
                        return ApiResponseHelper::sendResponse(new ErrorResult( $exception->getMessage() ?? 'unauthenticated', false, 401));
                    }
                    return response()->view('errors.401', 'unauthenticated', 401);
                case $exception instanceof \Spatie\Permission\Exceptions\UnauthorizedException
                    or $exception instanceof AccessDeniedHttpException:
                    if ($request->wantsJson()) {
                        return ApiResponseHelper::sendResponse(new Result($exception->getMessage() ??'unauthorized',null, $exception->getMessage(), false,403));
                    }
                    return response()->view('errors.403');
                case $exception instanceof RecordsNotFoundException
                    or $exception instanceof NotFoundHttpException
                    or $exception instanceof FileNotFoundException
                    or $exception instanceof RouteNotFoundException:
                    if ($request->wantsJson()) {
                        return ApiResponseHelper::sendResponse(new ErrorResult($exception->getMessage(),false,404));
                    }
                    return response()->view('errors.404');
                case $exception instanceof TokenMismatchException:
                    if ($request->wantsJson()) {
                        return ApiResponseHelper::sendResponse('mismatch_token', $exception->getMessage(), false, 419);
                    }
                    return response()->view('errors.419');
                case $exception instanceof ValidationException:
                    if ($request->wantsJson()) {
                        $error =$exception->validator->errors()->toArray();
                        $error = $error[array_key_first($error)][0]??'';
                        return ApiResponseHelper::sendResponse(new Result($exception->errors(),null,$error, false, 422));
                    }
                    return back()->with($exception->errors(), 422);
                case $exception instanceof BadRequestException:
                    if ($request->wantsJson()) {
                        return ApiResponseHelper::sendResponse(new Result('invalid_data',null, $exception->getMessage(), false, 400));
                    }
                    return back()->with($exception->getMessage(), 400);
                case $exception instanceof NotImplementedException:
                    return ApiResponseHelper::sendResponse(new Result('NotImplementedException',null, $exception->getMessage(), false, 404));
                case $exception instanceof SaloonException:
                    return ApiResponseHelper::sendResponse(new Result(null,null, $exception->getMessage(), false, $exception->getCode()));
                    break;
                /* Other Exceptions */
                default:
                    if ($request->wantsJson()) {
                        $res = new Result('Something went wrong, please try again.',
                            null,
                            (app()->isLocal())?$exception->getMessage():'Something went wrong, please try again.',
                            false,
                            500,
                            (app()->isLocal())?$exception->getTraceAsString():'Something went wrong, please try again.');
                        return ApiResponseHelper::sendResponse($res);
                    }
                    return response()->view('errors.500');
            }
        });
    }
}
