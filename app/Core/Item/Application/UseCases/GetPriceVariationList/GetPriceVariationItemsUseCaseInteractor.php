<?php

namespace App\Core\Item\Application\UseCases\GetPriceVariationList;

use App\Core\Item\Application\Filter\ItemFilter;
use App\Core\Item\Application\Repositories\GetPriceVariationItemListGateWayRepositoryInterface;
use App\Core\Item\Presentation\Presenters\GetPriceVariationItemsUseCaseResponse;

class GetPriceVariationItemsUseCaseInteractor implements GetPriceVariationItemsUseCaseInterface
{
    public function __construct(private readonly GetPriceVariationItemListGateWayRepositoryInterface $gateway,
                                private readonly GetPriceVariationItemsUseCaseResponse $output,){}

    public function getList(ItemFilter $itemFilter)
    {
        $data = $this->gateway->getItemList($itemFilter);
        return  $this->output->getList(json_decode(json_encode($data),false));
    }

}
