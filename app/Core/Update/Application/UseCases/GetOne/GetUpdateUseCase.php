<?php

namespace App\Core\Update\Application\UseCases\GetOne;

use App\Core\Update\Presentation\ViewModels\JsonResourceViewModel;

interface GetUpdateUseCase
{
    public function getUpdate(int $id):JsonResourceViewModel;
}
