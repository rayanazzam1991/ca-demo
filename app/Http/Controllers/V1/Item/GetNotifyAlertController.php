<?php

namespace App\Http\Controllers\V1\Item;

use App\Core\Item\Application\Filter\ItemFilter;
use App\Core\Item\Application\Mappers\NotifyMapper;
use App\Core\Item\Application\UseCases\GetNotifyAlert\GetNotifyAlertUseCaseInterface;
use App\Core\Item\Application\UseCases\GetPopularList\GetPopularItemsUseCaseInteractor;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\BaseRequest;
use App\Http\Requests\V1\Item\NotifyRequest;

class GetNotifyAlertController extends Controller
{
    public function __construct(private readonly GetNotifyAlertUseCaseInterface $itemUseCase){}

    /**
     * Handle the incoming request.
     */
    public function __invoke(NotifyRequest $request)
    {
        $viewModel = $this->itemUseCase->getNotifyAlert(NotifyMapper::fromRequest($request->validated()));
        return ApiResponseHelper::sendResponse(new Result());
    }
}
