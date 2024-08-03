<?php
namespace App\Core\Cart\Application\UseCases\GetCart;

use App\Core\Cart\Application\Repositories\CartRepositoryInterface;
use App\Core\CartItem\Application\Repositories\CartItemRepositoryInterface;
use App\Core\Distributor\Application\Repositories\DistributorRepositoryInterface;
use App\Core\Item\Application\Filter\ItemFilter;
use App\Core\Item\Application\Repositories\GetItemListGateWayRepositoryInterface;
use App\Core\Tenant\Application\Repositories\TenantRepositoryInterface;
use Saloon\Exceptions\SaloonException;

class GetCartUseCaseInteractor implements GetCartUseCaseInterface
{
    public function __construct(private readonly CartItemRepositoryInterface $cartItemRepository,
                                private readonly CartRepositoryInterface $cartRepository,
                                private readonly GetItemListGateWayRepositoryInterface $itemGateWayRepository,
                                private readonly TenantRepositoryInterface $tenantRepository,
                                private readonly DistributorRepositoryInterface $distributorRepository,
                                private readonly GetCartOutputUseCaseInterface $cartOutputUseCase

    ){}

    public function getCart()
    {
        $cart = $this->cartRepository->getByUser(auth()->id());
        isset($cart)?:throw new SaloonException(__('main.cart_is_empty'),200);
        $distributor = $this->distributorRepository->show($cart->distributor_id);
        $tenant = $this->tenantRepository->getById($distributor->tenant_id);
        $cartItems = $this->cartItemRepository->getItemsByCartId($cart->id);
        $items = $this->itemGateWayRepository->getItemList(ItemFilter::fromRequest(['distributor_id'=>$cart->distributor_id,'items_id'=>$cartItems->pluck('item_id')->toArray()]),$tenant->local_domain);
        return $this->cartOutputUseCase->getCart(json_decode(json_encode($items,false)),$cartItems,$distributor);
    }
}
