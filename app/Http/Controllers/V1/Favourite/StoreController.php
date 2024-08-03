<?php

namespace App\Http\Controllers\V1\Favourite;

use App\Core\Favourite\Application\Mappers\FavouriteMapper;
use App\Core\Favourite\Application\UseCases\CreateFavourite\CreateFavouriteUseCaseInteractor;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Favourite\StoreRequest;
use Illuminate\Http\JsonResponse;


class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     * @throws \Exception
     */
    public function __construct(private readonly CreateFavouriteUseCaseInteractor $favouriteUseCaseInteractor){}

    public function __invoke(StoreRequest $request):JsonResponse
    {
       $data= $this->favouriteUseCaseInteractor->store(FavouriteMapper::fromRequest($request->validated()));
        return ApiResponseHelper::sendResponse(new Result($data));
    }

}
