<?php

namespace App\Core\Item\Application\UseCases\GetOne;

use App\Core\Item\Presentation\ViewModels\JsonResourceViewModel;

interface GetItemUseCaseInterface
{
    public function getOne(int $distributor_id,int $id);
}
