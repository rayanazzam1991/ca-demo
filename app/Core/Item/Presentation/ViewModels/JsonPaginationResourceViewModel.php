<?php

namespace App\Core\Item\Presentation\ViewModels;

use App\Http\Resources\PaginationResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
class JsonPaginationResourceViewModel
{
    public function __construct(
        public   $resource,
        public   $pagination,
        private readonly ?string      $message = null)
    {
    }

    public function getResource()
    {
        return $this->resource;
    }

    public function getPagination()
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
