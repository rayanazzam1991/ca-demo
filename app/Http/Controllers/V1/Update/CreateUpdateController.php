<?php

namespace App\Http\Controllers\V1\Update;

use App\Core\Update\Application\Mappers\UpdateMapper;
use App\Core\Update\Application\UseCases\CreateUpdate\CreateUpdateUseCase;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Update\CreateUpdateRequest;

class CreateUpdateController extends Controller
{
    /**
     * Handle the incoming request.
     */

    public function __construct(
        private readonly CreateUpdateUseCase $createUpdateUseCase
    )
    {
    }

    public function __invoke(CreateUpdateRequest $request): \Illuminate\Http\JsonResponse
    {
        $viewModel = $this->createUpdateUseCase->createUpdate(UpdateMapper::fromRequest($request->validated()));
        return ApiResponseHelper::sendResponse(new Result($viewModel->getResource()));
    }
}
