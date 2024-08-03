<?php

namespace App\Http\Controllers\V1\PaymentType;

use App\Concerns\BaseFilterMapper;
use App\Core\PaymentType\Application\UseCases\GetPaymentTypeList\GetPaymentTypeListUseCaseInteractor;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\BaseRequest;
use Illuminate\Http\JsonResponse;


class IndexController extends Controller
{
    public function __construct(private readonly GetPaymentTypeListUseCaseInteractor $useCaseInteractor){}

    /**
     * Handle the incoming request.
     */
    public function __invoke(BaseRequest $request):JsonResponse
    {
        $view = $this->useCaseInteractor->index(BaseFilterMapper::fromRequest($request->validated()));
        return ApiResponseHelper::sendResponse(new Result($view->getResource(),$view->getPagination()));
    }
}
