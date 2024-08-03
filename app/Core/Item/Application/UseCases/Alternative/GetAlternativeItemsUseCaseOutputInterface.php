<?php

namespace App\Core\Item\Application\UseCases\Alternative;


interface GetAlternativeItemsUseCaseOutputInterface
{
    public function getList($items,$distributor);
}

