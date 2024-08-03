<?php

namespace App\Core\Shift\Application\Repositories;

interface ShiftRepositoryInterface
{
    public function index();
    public function sync($shifts):void;
}
