<?php

namespace App\Http\Controllers\V1\Feed;

use App\Core\Feed\Application\UseCases\GetOne\GetOneFeedUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Feed\IndexRequest;
use Illuminate\Http\JsonResponse;

class ShowController extends Controller
{
    public function __construct(private readonly GetOneFeedUseCaseInterface $feedUseCase){}

    /**
     * Handle the incoming request.
     */
    public function __invoke(IndexRequest $request,$id):JsonResponse
    {
        $viewModel = $this->feedUseCase->show($id);
        return ApiResponseHelper::sendResponse(new Result($viewModel->getResource(),));
    }
}
