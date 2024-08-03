<?php

namespace App\Http\Controllers\V1\Manufacturer;

use App\Concerns\StatusMapper;
use App\Core\Manufacturer\Application\UseCases\ChangeStatusManufacturer\ChangeStatusManufacturerUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Banner\ChangeStatusRequest;
use Illuminate\Http\JsonResponse;

class ChangeStatusController extends Controller
{
    public function __construct(private readonly ChangeStatusManufacturerUseCaseInterface $useCase){}

    public function __invoke(int $id,ChangeStatusRequest $request):JsonResponse
    {
        $this->useCase->changeStatus(StatusMapper::fromRequest($request->validated()),$id);
        return ApiResponseHelper::sendResponse(new Result());
    }
}
