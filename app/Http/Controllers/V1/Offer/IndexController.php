<?php

namespace App\Http\Controllers\V1\Offer;

use App\Concerns\BaseFilterMapper;
use App\Core\Offer\Application\UseCases\GetOfferList\GetOfferListUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\BaseRequest;
use Illuminate\Http\JsonResponse;


class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     * @throws \Exception
     */
    public function __construct(private readonly GetOfferListUseCaseInterface $offerUseCase){}

    public function __invoke(BaseRequest $request):JsonResponse
    {
        $viewModel = $this->offerUseCase->getList(BaseFilterMapper::fromRequest($request->validated()));
        return ApiResponseHelper::sendResponse(new Result($viewModel->getResource(), $viewModel->getPagination()));
    }

}
