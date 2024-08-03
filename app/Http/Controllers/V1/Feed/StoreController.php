<?php

namespace App\Http\Controllers\V1\Feed;

use App\Core\Feed\Application\Mappers\FeedMapper;
use App\Core\Feed\Application\UseCases\CreateFeed\CreateFeedUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Feed\StoreRequest;
use Illuminate\Http\JsonResponse;

class StoreController extends Controller
{
    public function __construct(private readonly CreateFeedUseCaseInterface $feedUseCase){}

    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreRequest $request):JsonResponse
    {
        $this->feedUseCase->store(FeedMapper::fromRequest($request->validated()));
        return ApiResponseHelper::sendResponse(new Result());
    }
}
