<?php

namespace App\Http\Controllers\V1\Feed;

use App\Core\Feed\Application\Filter\FeedFilter;
use App\Core\Feed\Application\UseCases\GetList\GetListFeedUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Feed\IndexRequest;
use Illuminate\Http\JsonResponse;

class IndexController extends Controller
{
    public function __construct(private readonly GetListFeedUseCaseInterface $feedUseCase){}

    /**
     * Handle the incoming request.
     */
    public function __invoke(IndexRequest $request):JsonResponse
    {
        $viewModel = $this->feedUseCase->index(FeedFilter::fromRequest($request->validated()));
        return ApiResponseHelper::sendResponse(new Result(
            $viewModel->getResource(),
            $viewModel->getPagination()
        ));
    }
}
