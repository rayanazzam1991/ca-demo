<?php

namespace App\Http\Controllers\V1\Distributor;

use App\Concerns\StatusMapper;
use App\Core\Distributor\Application\UseCases\ChangeStatus\ChangeStatusDistributorUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Banner\ChangeStatusRequest;
use Illuminate\Http\JsonResponse;

class ChangeStatusController extends Controller
{
    public function __construct(private readonly ChangeStatusDistributorUseCaseInterface $distributorUseCase){}

    public function __invoke(int $id,ChangeStatusRequest $request):JsonResponse
    {
        $this->distributorUseCase->changeStatus($id,StatusMapper::fromRequest($request->validated()));
        return ApiResponseHelper::sendResponse(new Result());
    }
}
