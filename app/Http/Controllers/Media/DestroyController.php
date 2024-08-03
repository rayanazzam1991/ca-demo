<?php

namespace App\Http\Controllers\Media;

use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Core\Media\MediaService;
use Illuminate\Http\Request;

class DestroyController extends Controller
{
    protected MediaService $media_service;
    public function __construct()
    {
        $this->media_service = new MediaService();
    }
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request,int $id)
    {
        $this->media_service->destroy($id);
        return ApiResponseHelper::sendResponse(new Result());
    }
}
