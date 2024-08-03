<?php

namespace App\Http\Controllers\V1\Manufacturer;

use App\Core\Manufacturer\Application\UseCases\GetManufacturer\GetManufacturerUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\BaseRequest;
use Illuminate\Http\JsonResponse;


class ShowController extends Controller
{
    public function __construct(private readonly GetManufacturerUseCaseInterface $useCaseInteractor){}

    /**
     * Handle the incoming request.
     */
    public function __invoke(BaseRequest $request,int $id):JsonResponse
    {
        $view = $this->useCaseInteractor->show($id);
        return ApiResponseHelper::sendResponse(new Result($view->getResource()));
    }
}
