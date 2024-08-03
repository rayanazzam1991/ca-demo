<?php

namespace App\Core\Distributor\Presentation\ViewModels;

use App\Http\Resources\PaginationResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
class JsonPaginationResourceViewModel
{
    public function __construct(
        public readonly AnonymousResourceCollection $resource,
        public readonly PaginationResource $pagination,
        private readonly ?string      $message = null)
    {
    }

    public function getResource(): AnonymousResourceCollection
    {
        return $this->resource;
    }

    public function getPagination(): PaginationResource
    {
        return $this->pagination;
    }

    /**
     * @return string|null
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }
}
