<?php

namespace App\Http\Controllers\V1\Item;

use App\Core\Item\Application\Filter\ItemFilter;
use App\Core\Item\Application\UseCases\Alternative\GetAlternativeItemUseCaseInterface;
use App\Core\Item\Application\UseCases\GetList\GetItemsUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Item\IndexRequest;
use Illuminate\Http\JsonResponse;

class GetAlternativeController extends Controller
{
    public function __construct(private readonly GetAlternativeItemUseCaseInterface $itemUseCase){}

    /**
     * Handle the incoming request.
     */
    public function __invoke(IndexRequest $request,int $id)
    {
        $viewModel = $this->itemUseCase->getAlternativeItemList(ItemFilter::fromRequest($request->validated()),$id);
        return ApiResponseHelper::sendResponse(new Result(
            $viewModel->getResource(),
            $viewModel->getPagination(),
        ));
    }
}
