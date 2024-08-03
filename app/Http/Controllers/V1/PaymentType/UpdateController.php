<?php

namespace App\Http\Controllers\V1\PaymentType;

use App\Core\PaymentType\Application\Mappers\PaymentTypeMapper;
use App\Core\PaymentType\Application\UseCases\UpdatePaymentType\UpdatePaymentTypeUseCaseInteractor;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\PaymentType\UpdateRequest;
use Illuminate\Http\JsonResponse;


class UpdateController extends Controller
{
    public function __construct(private readonly UpdatePaymentTypeUseCaseInteractor $useCaseInteractor){}

    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateRequest $request,int $id):JsonResponse
    {
        $this->useCaseInteractor->update(PaymentTypeMapper::fromRequest($request->validated()),$id);
        return ApiResponseHelper::sendResponse(new Result());
    }
}
