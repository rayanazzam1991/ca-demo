<?php

namespace App\Http\Controllers\V1\Notification;

use App\Core\Notification\Application\UseCases\GetUserNotificationList\GetUserNotificationListUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GetDeliveryManNotificationController extends Controller
{
    public function __construct(private readonly GetUserNotificationListUseCaseInterface $useCase){}

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $viewModel = $this->useCase->index(auth()->guard('delivery')->user()->phone_number,2);
        return ApiResponseHelper::sendResponse(new Result($viewModel));
    }
}
