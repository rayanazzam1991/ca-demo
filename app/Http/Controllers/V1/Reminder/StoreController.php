<?php

namespace App\Http\Controllers\V1\Reminder;

use App\Core\Favourite\Application\Mappers\FavouriteMapper;
use App\Core\Reminder\Application\UseCases\CreateReminder\CreateReminderUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Reminder\StoreRequest;
use Illuminate\Http\JsonResponse;


class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     * @throws \Exception
     */
    public function __construct(private readonly CreateReminderUseCaseInterface $reminderUseCase){}

    public function __invoke(StoreRequest $request):JsonResponse
    {
        $data =$this->reminderUseCase->store(FavouriteMapper::fromRequest($request->validated()));
        return ApiResponseHelper::sendResponse(new Result($data));
    }

}
