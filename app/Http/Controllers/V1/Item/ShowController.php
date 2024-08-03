<?php

namespace App\Http\Controllers\V1\Item;

use App\Core\Item\Application\UseCases\GetOne\GetItemUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Item\ShowRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class ShowController extends Controller
{
    public function __construct(private readonly GetItemUseCaseInterface $itemUseCase){}

    /**
     * Handle the incoming request.
     */
    public function __invoke(ShowRequest $request,int $id)
    {
        $viewModel= $this->itemUseCase->getOne($request->distributor_id,$id);
        return ApiResponseHelper::sendResponse(new Result($viewModel->getResource()));
    }
}
