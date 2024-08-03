<?php

namespace App\Http\Controllers\V1\Favourite;

use App\Core\Favourite\Application\UseCases\GetFavouriteListUseCase\GetFavouriteListUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Request;


class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     * @throws \Exception
     */
    public function __construct(private readonly GetFavouriteListUseCaseInterface $favouriteUseCaseInteractor){}

    public function __invoke(Request $request):JsonResponse
    {
        $view_model =$this->favouriteUseCaseInteractor->index();
        return ApiResponseHelper::sendResponse(new Result($view_model->getResource()));
    }

}
