<?php

namespace App\Http\Controllers\V1\Notification;

use App\Core\Notification\Application\Mappers\NotifictionMapper;
use App\Core\Notification\Application\UseCases\CreateNotification\CreateNotificationUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Notification\StoreRequest;

class StoreController extends Controller
{
    public function __construct(private readonly CreateNotificationUseCaseInterface $useCase){}

    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreRequest $request)
    {
        $this->useCase->store(NotifictionMapper::fromRequest($request->validated()));
        return ApiResponseHelper::sendResponse(new Result());
    }
}
