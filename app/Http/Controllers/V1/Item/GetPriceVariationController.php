<?php

namespace App\Http\Controllers\V1\Item;

use App\Core\Item\Application\Filter\ItemFilter;
use App\Core\Item\Application\UseCases\GetList\GetItemsUseCaseInterface;
use App\Core\Item\Application\UseCases\GetPriceVariationList\GetPriceVariationItemsUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Item\IndexRequest;
use App\Http\Requests\V1\Item\PriceVariationRequest;
use Illuminate\Http\JsonResponse;

class GetPriceVariationController extends Controller
{
    public function __construct(private readonly GetPriceVariationItemsUseCaseInterface $itemUseCase){}

    /**
     * Handle the incoming request.
     */
    public function __invoke(PriceVariationRequest $request)
    {
        $viewModel = $this->itemUseCase->getList(ItemFilter::fromRequest($request->validated()));
        return ApiResponseHelper::sendResponse(new Result($viewModel->getResource()));
    }
}
