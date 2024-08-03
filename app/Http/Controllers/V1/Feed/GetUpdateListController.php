<?php

namespace App\Http\Controllers\V1\Feed;

use App\Core\Feed\Application\Filter\FeedFilter;
use App\Core\Feed\Application\UseCases\GetUpdateList\GetListUpdateUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Feed\GetUpdateListRequest;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class GetUpdateListController extends Controller
{
    public function __construct(private readonly GetListUpdateUseCaseInterface $feedUseCase){}

    /**
     * Handle the incoming request.
     */
    public function __invoke(GetUpdateListRequest $request):JsonResponse
    {
        $viewModel = $this->feedUseCase->index(FeedFilter::fromRequest(array_merge(['start_date'=>Carbon::now()->subMonths(2)->toDateString(),'end_date' => Carbon::now()->toDateString()],$request->validated())));
        return ApiResponseHelper::sendResponse(new Result(
            $viewModel->getResource(),

        ));
    }
}
