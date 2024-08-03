<?php

namespace App\Core\PaymentType\Application\Repositories;

use App\Concerns\BaseFilter;
use App\Concerns\StatusEntity;
use App\Core\PaymentType\Domain\Entities\PaymentTypeEntity;
use App\Core\PaymentType\Infrastructure\Eloquent\PaymentTypeModel;
use App\Models\PaymentType;
use Illuminate\Pagination\LengthAwarePaginator;

interface PaymentMethodRepositoryInterface
{
    public function index(BaseFilter $filter):LengthAwarePaginator;
    public function show($id):PaymentTypeModel;
    public function store(PaymentTypeEntity $entity):PaymentTypeModel;
    public function update(PaymentTypeEntity $entity,$id):PaymentTypeModel;
    public function changeStatus(StatusEntity $entity,int $id):PaymentTypeModel;

}
