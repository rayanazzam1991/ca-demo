<?php

namespace App\Http\Controllers\Media;

use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\Media\StoreRequest;
use App\Http\Resources\Media\MediaResourc;
use App\Core\Media\MediaService;

class StoreController extends Controller
{

    public function __construct(private readonly MediaService $media_service)
    {
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreRequest $request)
    {
        return ApiResponseHelper::sendResponse(new Result(MediaResourc::make($this->media_service->store($request->model_id, $request->model_type, $request->file))));
    }
}
