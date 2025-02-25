<?php

namespace App\Http\Controllers\V1\DeliveryMan;

use App\Core\DeliveryMan\Application\UseCases\GetDeliveryMan\GetDeliveryManUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\BaseRequest;
use Illuminate\Http\JsonResponse;


class ProfileController extends Controller
{
    public function __construct(private readonly GetDeliveryManUseCaseInterface $useCaseInteractor){}

    /**
     * Handle the incoming request.
     */
    public function __invoke(BaseRequest $request):JsonResponse
    {
        $view = $this->useCaseInteractor->show(auth()->guard('delivery')->id());
        return ApiResponseHelper::sendResponse(new Result($view->getResource()));
    }
}
