<?php

namespace App\Core\Item\Presentation\ViewModels;

use Illuminate\Http\Resources\Json\JsonResource;

class JsonResourceViewModel
{


    public function __construct(
        private readonly JsonResource $resource,
        private readonly ?string      $message = null)
    {
    }

    public function getResource(): JsonResource
    {
        return $this->resource;
    }

    /**
     * @return string|null
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }
}
