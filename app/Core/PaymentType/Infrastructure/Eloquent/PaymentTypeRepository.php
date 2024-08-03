<?php
namespace App\Core\PaymentType\Infrastructure\Eloquent;

use App\Concerns\BaseFilter;
use App\Concerns\StatusEntity;
use App\Core\PaymentType\Application\Repositories\PaymentMethodRepositoryInterface;
use App\Core\PaymentType\Domain\Entities\PaymentTypeEntity;
use Illuminate\Pagination\LengthAwarePaginator;

class PaymentTypeRepository implements PaymentMethodRepositoryInterface
{
   public function index(BaseFilter $filter):LengthAwarePaginator
   {
       return PaymentTypeModel::query()
       ->when($filter->search,function ($q)use($filter){
           return $q
           ->where('name_en','like','%'.$filter->search.'%')
           ->orWhere('name_ar','like','%'.$filter->search.'%')
           ->orWhere('id','like','%'.$filter->search.'%');
       })
       ->when(isset($filter->status),function ($q)use($filter){
           return $q->where('status',$filter->status);
       })
       ->when(isset(request()->order),function ($q)use($filter){
           return $q->orderBy('created_at',request()->order);
       })
       ->paginate($filter->per_page);
   }

    public function show($id):PaymentTypeModel
    {
        return PaymentTypeModel::query()->whereId($id)->firstOrFail();
    }
    public function store(PaymentTypeEntity $entity):PaymentTypeModel
    {
       return PaymentTypeModel::create(array_filter($entity->toArray(), function ($value) {return $value !== null;}));
    }

    public function update(PaymentTypeEntity $entity,$id):PaymentTypeModel
    {
       $type = PaymentTypeModel::whereId($id)->firstOrFail();
       $type->update(array_filter($entity->toArray(), function ($value) {return $value !== null;}));
       return $type;
    }

    public function changeStatus(StatusEntity $entity,int $id):PaymentTypeModel
    {
        $type = PaymentTypeModel::whereId($id)->firstOrFail();
        $type->update($entity->toArray());
        return $type;
    }
}
