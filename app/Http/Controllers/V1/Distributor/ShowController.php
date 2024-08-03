<?php

namespace App\Http\Controllers\V1\Distributor;

use App\Core\Distributor\Application\UseCases\GetOne\GetOneDistributorUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    public function __construct(private readonly GetOneDistributorUseCaseInterface $distributeurUseCase){}

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request,int $id):JsonResponse
    {
        $viewModel = $this->distributeurUseCase->show($id);
        return ApiResponseHelper::sendResponse(new Result($viewModel->getResource()));
    }
}
