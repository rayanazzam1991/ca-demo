<?php

namespace App\Http\Controllers\V1\PrivacyPolicy;

use App\Core\PrivacyPolicy\Application\UseCases\GetPrivacyPolicy\GetPrivacyPolicyUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     * @throws \Exception
     */
    public function __construct(private readonly GetPrivacyPolicyUseCaseInterface $useCase){}

    public function __invoke(Request $request):JsonResponse
    {
        $viewModel = $this->useCase->show();
        return ApiResponseHelper::sendResponse(new Result([
            'description'=>$viewModel->{'description_'.app()->getLocale()}??'',
        ]));
    }

}
