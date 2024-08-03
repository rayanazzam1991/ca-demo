<?php

namespace App\Http\Controllers\V1\Update;

use App\Core\Update\Application\UseCases\GetOne\GetUpdateUseCase;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Update\IndexRequest;
use Illuminate\Http\JsonResponse;

class ShowController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __construct(private readonly GetUpdateUseCase $getUpdateUseCase){}
    public function __invoke(IndexRequest $request,int $id):JsonResponse
    {
        $viewModel = $this->getUpdateUseCase->getUpdate($id);
        return ApiResponseHelper::sendResponse(new Result($viewModel->getResource(),));
    }
}
