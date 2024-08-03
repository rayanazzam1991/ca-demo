<?php

namespace App\Core\Item\Application\UseCases\GetPopularList;

use App\Core\Item\Application\Filter\ItemFilter;
use App\Core\Item\Application\Repositories\GetPopularItemListGateWayRepositoryInterface;
use App\Core\Item\Application\Repositories\GetPriceVariationItemListGateWayRepositoryInterface;
use App\Core\Item\Infrastructure\SharedSystem\Integration\Gateway\GetPoupularItemListGateway;
use App\Core\Item\Presentation\Presenters\GetPriceVariationItemsUseCaseResponse;

class GetPopularItemsUseCaseInteractor implements GetPopularItemsUseCaseInterface
{
    public function __construct(private readonly GetPopularItemListGateWayRepositoryInterface $gateway,
                                private readonly GetPopularUseCaseOutputInterface $output){}

    public function getList(ItemFilter $itemFilter)
    {
        $data = $this->gateway->getItemList($itemFilter);
        return  $this->output->getList(json_decode(json_encode($data),false));
    }

}
