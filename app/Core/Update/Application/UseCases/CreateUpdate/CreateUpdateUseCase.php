<?php

namespace App\Core\Update\Application\UseCases\CreateUpdate;

use App\Core\Update\Domain\Entities\Update;

interface CreateUpdateUseCase
{

    public function createUpdate(Update $updateAggregate);

}
