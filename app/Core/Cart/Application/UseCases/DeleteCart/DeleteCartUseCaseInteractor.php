<?php
namespace App\Core\Cart\Application\UseCases\DeleteCart;

use App\Core\Cart\Application\Repositories\CartRepositoryInterface;
use Illuminate\Validation\ValidationException;


class DeleteCartUseCaseInteractor implements DeleteCartUseCaseInterface
{
    public function __construct(private readonly CartRepositoryInterface $cartRepository){}

    public function deleteCart():void
    {
        $cart = $this->cartRepository->getByUser(auth()->id());
        isset($cart)?: throw ValidationException::withMessages(['cart' => __('main.cart_is_empty')]);
         $this->cartRepository->deleteByUser(auth()->id());
    }
}
