<?php

namespace App\Http\Controllers\V1\Manufacturer;

use App\Core\Manufacturer\Application\Mappers\ManufacturerMapper;
use App\Core\Manufacturer\Application\UseCases\CreateManufacturer\CreateManufacturerUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Manufacturer\StoreRequest;
use Illuminate\Http\JsonResponse;


class StoreController extends Controller
{
    public function __construct(private readonly CreateManufacturerUseCaseInterface $useCaseInteractor){}

    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreRequest $request):JsonResponse
    {
        $this->useCaseInteractor->store(ManufacturerMapper::fromRequest($request->validated()));
        return ApiResponseHelper::sendResponse(new Result());
    }
}
