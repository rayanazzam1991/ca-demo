<?php
namespace App\Core\Shift\Application\UseCases\GetShiftList;
use App\Core\Shift\Presentation\ViewModels\JsonPaginationResourceViewModel;

interface GetShiftistOutputUseCaseInterface
{
    public function index($shifts):JsonPaginationResourceViewModel;
}
