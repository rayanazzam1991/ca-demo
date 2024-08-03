<?php

namespace App\Http\Controllers\V1\Notification;

use App\Core\Notification\Application\Mappers\NotifictionInformMapper;
use App\Core\Notification\Application\UseCases\InformNotification\InformNotificationUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InformController extends Controller
{
    public function __construct(private readonly InformNotificationUseCaseInterface $useCase){}

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $this->useCase->inform(NotifictionInformMapper::fromRequest($request->all()));
        return ApiResponseHelper::sendResponse(new Result());
    }
}
