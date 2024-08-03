<?php

namespace App\Http\Controllers\V1\Shift;

use App\Core\Shift\Application\Mappers\ShiftMapper;
use App\Core\Shift\Application\UseCases\CreateShift\CreateShiftUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Shift\StoreRequest;
use Illuminate\Http\JsonResponse;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __construct(private readonly CreateShiftUseCaseInterface $createShiftUseCase){}
    public function __invoke(StoreRequest $request):JsonResponse
    {
        $this->createShiftUseCase->sync(ShiftMapper::fromRequest($request->validated()));
        return ApiResponseHelper::sendResponse(new result());
    }
}
