<?php

namespace App\Core\Shared\City;


use App\Core\Feed\Presentation\ViewModels\JsonResourceViewModel;

interface CityUseCaseOutputInterface
{
    public function index($cities):array;
    public function show($city):JsonResourceViewModel;
}
