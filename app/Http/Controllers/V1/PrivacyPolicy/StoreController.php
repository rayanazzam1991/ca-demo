<?php

namespace App\Http\Controllers\V1\PrivacyPolicy;

use App\Core\PrivacyPolicy\Application\UseCases\CreatePrivacyPolicy\CreatePrivacyPolicyUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\PrivacyPolicy\StoreRequest;
use Illuminate\Http\JsonResponse;

class StoreController extends Controller
{
    public function __construct(private readonly CreatePrivacyPolicyUseCaseInterface $useCase){}

    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreRequest $request):JsonResponse
    {
        $this->useCase->store($request->description_ar,$request->description_en);
        return ApiResponseHelper::sendResponse(new Result());
    }
}
