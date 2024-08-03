<?php

namespace App\Http\Controllers\V1\Distributor;

use App\Core\Distributor\Application\Mappers\DistributorMapper;
use App\Core\Distributor\Application\UseCases\CreateDistributor\CreateDistributorUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Distributor\OnboardDistributorRequest;
use Illuminate\Http\JsonResponse;

class OnboardController extends Controller
{
    /**
     * Handle the incoming request.
     * @throws \Exception
     */
    public function __construct(private readonly CreateDistributorUseCaseInterface $distributorUseCase)
    {
    }

    public function __invoke(OnboardDistributorRequest $request): JsonResponse
    {
        $response = $this->distributorUseCase->store(DistributorMapper::fromRequest($request->validated(), $request->image), $request->username);
        return ApiResponseHelper::sendResponse(new Result($response));
    }
}
