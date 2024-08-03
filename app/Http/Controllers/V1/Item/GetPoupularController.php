<?php

namespace App\Http\Controllers\V1\Item;

use App\Core\Item\Application\Filter\ItemFilter;
use App\Core\Item\Application\UseCases\GetPopularList\GetPopularItemsUseCaseInteractor;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\BaseRequest;

class GetPoupularController extends Controller
{
    public function __construct(private readonly GetPopularItemsUseCaseInteractor $itemUseCase){}

    /**
     * Handle the incoming request.
     */
    public function __invoke(BaseRequest $request)
    {
        $viewModel = $this->itemUseCase->getList(ItemFilter::fromRequest($request->validated()));
        return ApiResponseHelper::sendResponse(new Result(
            $viewModel->getResource(),
            $viewModel->getPagination()
        ));
    }
}
