<?php

namespace App\Core\CartItem\Application\UseCases\DeleteCartItem;

use App\Core\Cart\Application\Repositories\CartRepositoryInterface;
use App\Core\CartItem\Application\Repositories\CartItemRepositoryInterface;
use App\Core\CartItem\Application\UseCases\CreateCartItem\CreateCartItemUseCaseInterface;
use App\Core\CartItem\Domain\Entities\CartItemEntity;
use App\Core\Distributor\Application\Repositories\DistributorRepositoryInterface;
use App\Core\Item\Application\Repositories\GetItemGateWayRepositoryInterface;
use App\Core\Tenant\Application\Repositories\TenantRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class DeleteCartItemUseCaseInteractor implements DeleteCartItemUseCaseInterface
{
    public function __construct(private readonly CartItemRepositoryInterface $cartItemRepository){}

    public function delete($cart_item_id):void
    {
        $this->cartItemRepository->destroy($cart_item_id);
    }
}
