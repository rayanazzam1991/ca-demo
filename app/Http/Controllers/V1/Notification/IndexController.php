<?php

namespace App\Http\Controllers\V1\Notification;

use App\Core\Notification\Application\Filter\NotificationFilter;
use App\Core\Notification\Application\UseCases\GetNotificationList\GetNotificationListUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Notification\IndexRequest;

class IndexController extends Controller
{
    public function __construct(private readonly GetNotificationListUseCaseInterface $useCase){}

    /**
     * Handle the incoming request.
     */
    public function __invoke(IndexRequest $request)
    {
        $viewModel = $this->useCase->index(NotificationFilter::fromRequest($request->validated()));
        return ApiResponseHelper::sendResponse(new Result(
            $viewModel->getResource(),
            $viewModel->getPagination(),
        ));
    }
}
