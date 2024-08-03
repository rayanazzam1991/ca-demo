<?php

namespace App\Core\Item\Application\UseCases\GetOne;

use App\Core\Item\Presentation\ViewModels\JsonResourceViewModel;

interface GetItemUseCaseOutputInterface
{
    public function getOne($item,$distributor);
}

