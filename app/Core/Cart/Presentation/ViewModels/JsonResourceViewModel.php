<?php

namespace App\Core\Cart\Presentation\ViewModels;

use Illuminate\Http\Resources\Json\JsonResource;

class JsonResourceViewModel
{


    public function __construct(
        private readonly JsonResource $resource,
        private   $cart,
        private readonly ?string      $message = null)
    {
    }

    public function getResource(): JsonResource
    {
        return $this->resource;
    }
    public function getCart(): JsonResource
    {
        return $this->cart;
    }

    /**
     * @return string|null
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }
}
