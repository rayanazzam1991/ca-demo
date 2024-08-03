<?php

namespace App\Core\Order\Application\UseCases\CreateOrder;

use App\Core\Cart\Application\Repositories\CartRepositoryInterface;
use App\Core\CartItem\Application\Repositories\CartItemRepositoryInterface;
use App\Core\Distributor\Application\Repositories\DistributorRepositoryInterface;
use App\Core\Order\Application\Repositories\OrderRepositoryInterface;
use App\Core\Order\Application\Repositories\CreateOrderGateWayRepositoryInterface;
use App\Core\Order\Domain\Factories\OrderFactory;
use App\Core\PaymentType\Application\Repositories\PaymentMethodRepositoryInterface;
use App\Core\Pharmacy\Application\Mappers\PharmacyMapper;
use App\Core\Pharmacy\Application\Repositories\PharmacyRepositoryInterface;
use App\Core\Pharmacy\Domain\Entities\PharmacyOrderEntity;
use App\Core\Tenant\Application\Repositories\TenantRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CreateOrderUseCaseInteractor implements CreateOrderUseCaseInterface
{
    public function __construct(private readonly CartItemRepositoryInterface $cartItemRepository,
                                private readonly CartRepositoryInterface $cartRepository,
                                private readonly PaymentMethodRepositoryInterface $paymentMethodRepository,
                                private readonly OrderRepositoryInterface $orderRepository,
                                private readonly CreateOrderGateWayRepositoryInterface $createOrderGateWayRepository,
                                private readonly TenantRepositoryInterface $tenantRepository,
                                private readonly DistributorRepositoryInterface $distributorRepository,
    ){}

    public function store($payment_type_code):void
    {
        try {
            DB::beginTransaction();
            $cart = $this->cartRepository->getByUser(auth()->id());
            isset($cart)?: throw ValidationException::withMessages(['cart' => __('main.cart_is_empty')]);
            $distributor = $this->distributorRepository->show($cart->distributor_id);
            $tenant = $this->tenantRepository->getById($distributor->tenant_id);
            $cartItems = $this->cartItemRepository->getItemsByCartId($cart->id);
            $order_entity = OrderFactory::new(['items'=>$cartItems->toArray()],$distributor->id,$payment_type_code);
            $pharmacy_model = auth()->user()->loadMissing(['pharmacy','pharmacy.address','medias'])->toArray();
            $pharmacy = PharmacyOrderEntity::new($pharmacy_model['pharmacy'],$pharmacy_model,$pharmacy_model['pharmacy']['address']);
            $response=$this->createOrderGateWayRepository->store($order_entity,$pharmacy,$tenant->local_domain);
            $this->orderRepository->store($order_entity,$response['data'],$distributor->id);
            $this->cartRepository->delete($cart->id);
            DB::commit();
        } catch (\Throwable $exception) {
            DB::rollBack();
            throw $exception;
        }
    }
}
