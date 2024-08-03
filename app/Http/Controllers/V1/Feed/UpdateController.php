<?php

namespace App\Http\Controllers\V1\Feed;

use App\Core\Feed\Application\Mappers\FeedMapper;
use App\Core\Feed\Application\UseCases\UpdateFeed\UpdateFeedUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Feed\UpdateRequest;
use Illuminate\Http\JsonResponse;

class UpdateController extends Controller
{
    public function __construct(private readonly UpdateFeedUseCaseInterface $feedUseCase){}

    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateRequest $request,int $id):JsonResponse
    {
        $this->feedUseCase->update(FeedMapper::fromRequest($request->validated()),$id);
        return ApiResponseHelper::sendResponse(new Result());
    }
}
