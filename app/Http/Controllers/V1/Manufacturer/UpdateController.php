<?php

namespace App\Http\Controllers\V1\Manufacturer;

use App\Core\Manufacturer\Application\Mappers\ManufacturerMapper;
use App\Core\Manufacturer\Application\UseCases\UpdateManufacturer\UpdateManufacturerUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Manufacturer\UpdateRequest;
use Illuminate\Http\JsonResponse;


class UpdateController extends Controller
{
    public function __construct(private readonly UpdateManufacturerUseCaseInterface $useCaseInteractor){}

    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateRequest $request,int $id):JsonResponse
    {
        $this->useCaseInteractor->update(ManufacturerMapper::fromRequest($request->validated()),$id);
        return ApiResponseHelper::sendResponse(new Result());
    }
}
