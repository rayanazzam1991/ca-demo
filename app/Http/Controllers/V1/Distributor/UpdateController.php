<?php

namespace App\Http\Controllers\V1\Distributor;

use App\Core\Distributor\Application\Mappers\DistributorMapper;
use App\Core\Distributor\Application\UseCases\UpdateDistributor\UpdateDistributorUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Distributor\UpdateDistributorRequest;
use Illuminate\Http\JsonResponse;

class UpdateController extends Controller
{
    /**
     * Handle the incoming request.
     * @throws \Exception
     */
    public function __construct(private readonly UpdateDistributorUseCaseInterface $distributorUseCase){}

    public function __invoke(int $id,UpdateDistributorRequest $request):JsonResponse
    {
        $this->distributorUseCase->update($id,DistributorMapper::fromRequest($request->validated(),$request->image));
        return ApiResponseHelper::sendResponse(new Result());

    }

}
