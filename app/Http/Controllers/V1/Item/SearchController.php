<?php

namespace App\Http\Controllers\V1\Item;

use App\Core\Item\Application\Filter\ItemFilter;
use App\Core\Item\Application\UseCases\Search\SearchItemsUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Item\ItemSearchRequest;

class SearchController extends Controller
{
    public function __construct(private readonly SearchItemsUseCaseInterface $itemUseCase){}

    /**
     * Handle the incoming request.
     */
    public function __invoke(ItemSearchRequest $request)
    {
        $viewModel = $this->itemUseCase->getList(ItemFilter::fromRequest($request->validated()));
        return ApiResponseHelper::sendResponse(new Result($viewModel->getResource(),$viewModel->getPagination()));
    }
}
