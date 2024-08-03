<?php

namespace App\Core\Shared\Region;


use App\Core\Feed\Presentation\ViewModels\JsonResourceViewModel;

interface RegionUseCaseOutputInterface
{
    public function index($regions):array;
    public function show($region):JsonResourceViewModel;
}
