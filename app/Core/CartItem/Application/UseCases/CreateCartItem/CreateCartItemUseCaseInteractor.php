<?php

namespace App\Core\CartItem\Application\UseCases\CreateCartItem;

use App\Core\Cart\Application\Repositories\CartRepositoryInterface;
use App\Core\CartItem\Application\Repositories\CartItemRepositoryInterface;
use App\Core\CartItem\Domain\Entities\CartItemEntity;
use App\Core\Distributor\Application\Repositories\DistributorRepositoryInterface;
use App\Core\Item\Application\Repositories\GetItemGateWayRepositoryInterface;
use App\Core\Tenant\Application\Repositories\TenantRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CreateCartItemUseCaseInteractor implements CreateCartItemUseCaseInterface
{
    public function __construct(private readonly CartItemRepositoryInterface $cartItemRepository,
                                private readonly CartRepositoryInterface $cartRepository,
                                private readonly GetItemGateWayRepositoryInterface $itemGateWayRepository,
                                private readonly TenantRepositoryInterface $tenantRepository,
                                private readonly DistributorRepositoryInterface $distributorRepository,

    ){}

    public function store(CartItemEntity $entity):void
    {
        try {
            DB::beginTransaction();
            $cart = $this->cartRepository->getByUser($entity->cartEntity->user_id);
            isset($cart)?:$cart=$this->cartRepository->store($entity->cartEntity);
            if($cart->distributor_id != $entity->cartEntity->distributor_id)
                throw ValidationException::withMessages(['distributor_id' => __('main.cant_add_item_from_diff_distributor')]);
            $tenant_id = $this->distributorRepository->show($entity->cartEntity->distributor_id)->tenant_id;
            $tenant = $this->tenantRepository->getById($tenant_id);
            $item = $this->itemGateWayRepository->getItem($tenant->local_domain,$entity->item_id)['data'];
            $unit_price = collect($item['units_prices'])->where('id',$entity->unit_item_id)->first();
            isset($unit_price)?:throw ValidationException::withMessages(['item_unit_price' => __('main.unit_item_id_wrong')]);
//            if(((int) str_replace(',', '', $item['current_quantity'])-$entity->qty) < (int) str_replace(',', '', $item['safety_stock']))
//                throw  ValidationException::withMessages(['qty' => __('main.qty_not_available')]);
//            if($entity->qty <((int) str_replace(',', '',  $item['min_quantity']) / (int) str_replace(',', '',  $unit_price['conversion_factor'])))
//                throw  ValidationException::withMessages(['qty' => __('main.min_qty').":".((int) str_replace(',', '',  $item['min_quantity']) / (int) str_replace(',', '',  $unit_price['conversion_factor']))]);
//            if($entity->qty >((int) str_replace(',', '',  $item['max_quantity'])/ (int) str_replace(',', '',  $unit_price['conversion_factor'])))
//                throw  ValidationException::withMessages(['qty' => __('main.max_qty').":".((int) str_replace(',', '',  $item['max_quantity'])/ (int) str_replace(',', '',  $unit_price['conversion_factor']))]);
            $this->cartItemRepository->store($entity,$cart->id);
            DB::commit();
        } catch (\Throwable $exception) {
            DB::rollBack();
            throw $exception;
        }
    }
}
