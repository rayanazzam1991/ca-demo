<?php

namespace App\Http\Controllers\V1\Manufacturer;

use App\Core\Manufacturer\Application\Filter\ManufacturerFilter;
use App\Core\Manufacturer\Application\UseCases\GetManufacturerList\GetManufacturerListUseCaseInteractor;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Manufacturer\IndexRequest;
use Illuminate\Http\JsonResponse;


class IndexController extends Controller
{
    public function __construct(private readonly GetManufacturerListUseCaseInteractor $useCaseInteractor){}

    /**
     * Handle the incoming request.
     */
    public function __invoke(IndexRequest $request):JsonResponse
    {
        $view = $this->useCaseInteractor->index(ManufacturerFilter::fromRequest($request->validated()));
        return ApiResponseHelper::sendResponse(new Result($view->getResource(),$view->getPagination()));
    }
}
