<?php

namespace App\Core\Shift\Application\Repositories;

interface CreateShiftGateWayRepositoryInterface
{
    public function sync(array $shifts,string $phone_number);
}
