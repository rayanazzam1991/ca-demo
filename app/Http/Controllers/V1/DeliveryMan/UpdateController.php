<?php

namespace App\Http\Controllers\V1\DeliveryMan;

use App\Core\DeliveryMan\Application\Mappers\DeliveryManMapper;
use App\Core\DeliveryMan\Application\UseCases\UpdateDeliveryMan\UpdateDeliveryManUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\DeliveryMan\UpdateRequest;
use Illuminate\Http\JsonResponse;


class UpdateController extends Controller
{
    public function __construct(private readonly UpdateDeliveryManUseCaseInterface $useCaseInteractor){}

    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateRequest $request,int $id):JsonResponse
    {
        $this->useCaseInteractor->update(DeliveryManMapper::fromRequest($request->validated()),$id);
        return ApiResponseHelper::sendResponse(new Result());
    }
}
