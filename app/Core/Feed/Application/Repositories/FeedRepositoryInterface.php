<?php
namespace App\Core\Feed\Application\Repositories;

use App\Concerns\StatusEntity;
use App\Core\Feed\Application\Filter\FeedFilter;
use App\Core\Feed\Domain\Entities\FeedEntity;
use App\Core\Feed\Infrastructure\Eloquent\FeedModel;
use Illuminate\Pagination\LengthAwarePaginator;

interface FeedRepositoryInterface
{
    public function index(FeedFilter $filter):LengthAwarePaginator;
    public function get(FeedFilter $filter);
    public function show(int $id):FeedModel;
    public function store(FeedEntity $entity):FeedModel;
    public function update(FeedEntity $entity,int $id):FeedModel;
    public function changeStatus(int $id,StatusEntity $entity):void;
}
