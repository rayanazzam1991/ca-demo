<?php

namespace App\Core\Feed\Application\UseCases\GetOne;

use App\Core\Feed\Presentation\ViewModels\JsonResourceViewModel;

interface GetOneFeedUseCaseOutputInterface
{
    public function getOne($feed): JsonResourceViewModel;
}
