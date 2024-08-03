<?php

namespace App\Http\Controllers\V1\DeliveryGroup;

use App\Core\DeliveryGroup\Application\Mappers\DeliveryGroupMapper;
use App\Core\DeliveryGroup\Application\UseCases\UpdateDeliveryGroup\UpdateDeliveryGroupUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\DeliveryGroup\UpdateRequest;
use Illuminate\Http\JsonResponse;


class UpdateController extends Controller
{
    public function __construct(private readonly UpdateDeliveryGroupUseCaseInterface $useCaseInteractor){}

    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateRequest $request,int $id):JsonResponse
    {
        $this->useCaseInteractor->update(DeliveryGroupMapper::fromRequest($request->validated()),$id);
        return ApiResponseHelper::sendResponse(new Result());
    }
}
