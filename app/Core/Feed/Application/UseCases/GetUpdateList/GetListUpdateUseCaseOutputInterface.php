<?php

namespace App\Core\Feed\Application\UseCases\GetUpdateList;

use App\Core\Feed\Presentation\ViewModels\JsonResourceViewModel;

interface GetListUpdateUseCaseOutputInterface
{
    public function getList($news,$updates): JsonResourceViewModel;
}
