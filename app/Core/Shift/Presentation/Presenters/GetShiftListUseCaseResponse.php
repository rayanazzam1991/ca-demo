<?php
namespace App\Core\Shift\Presentation\Presenters;

use App\Core\Shift\Application\UseCases\GetShiftList\GetShiftistOutputUseCaseInterface;
use App\Core\Shift\Presentation\ViewModels\JsonPaginationResourceViewModel;
use App\Http\Resources\V1\SharedSystem\ShiftResource;

class GetShiftListUseCaseResponse implements GetShiftistOutputUseCaseInterface
{
    public function index($shifts):JsonPaginationResourceViewModel
    {
        return new JsonPaginationResourceViewModel(
            ShiftResource::collection($shifts),
            null
        );
    }
}
