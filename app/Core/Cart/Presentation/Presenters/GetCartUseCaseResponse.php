<?php

namespace App\Core\Cart\Presentation\Presenters;

use App\Core\Cart\Application\UseCases\GetCart\GetCartOutputUseCaseInterface;
use App\Core\Cart\Presentation\ViewModels\JsonResourceViewModel;
use App\Http\Resources\V1\Cart\CartResource;
use App\Http\Resources\V1\Cart\ItemResource;
use App\Http\Resources\V1\Distributor\DistributorResource;
use App\Http\Resources\V1\SharedSystem\ItemOfferResource;
use Illuminate\Support\Facades\Log;

class GetCartUseCaseResponse implements GetCartOutputUseCaseInterface
{
    public function getCart($items,$cartItem,$distributor)
    {
        $data=json_decode(json_encode($this->prepareResponse($items?->data,$cartItem,$distributor),false));
        $all_items = ItemResource::collection($data);
        $cart_data =['sub_total'=> array_sum(array_column($data, 'total_price'))];
        CartResource::using($distributor);
        return new JsonResourceViewModel($all_items,CartResource::make($cart_data));
    }

    public function prepareResponse($items,$cartItems,$ditributor)
    {
        $result = [];
        foreach ($items  as $item)
        {
            $item_units_price = 0;
            $item_unit_name = "";
            $img_url = "";
            $cartItem =  $cartItems->where('item_id',$item->id)->first();

            foreach ($item->units_prices as $unit)
            {
                if($unit->id == $cartItem->unit_item_id)
                {
                    $item_unit_name = $unit->unit->{'name_'.app()->getLocale()} ?? $unit->unit->name_ar;
                    $item_units_price = (int) str_replace(',', '',  $unit->current_purchase_price);
                }
            }

            foreach ($item->files as $file)
            {
                if($file->is_featured)
                {
                    $img_url=$file->full_path;
                    break;
                }

            }

            $result[]=[
                'id' =>  $cartItem?->id,
                'item_id' => $item->id,
                'item_unit_id'=>$cartItem?->unit_item_id,
                'name' => $item->{'name_'.app()->getLocale()} ?? $item->name_ar,
                'qty' => $cartItem?->qty,
                'unit_name' => $item_unit_name,
                'order_limit' => $item->order_limit,
                'order_limit_num' => $item->order_limit_num,
                'price' => $item_units_price,
                'total_price' => $item_units_price*$cartItem?->qty,
                'img' =>$img_url,
                'dosage' => $item?->dosage?->{'name_'.app()->getLocale()},
                'item_offers' =>(isset($item?->item_offers))? ItemOfferResource::collection($item->item_offers):null,
                'distributor' => DistributorResource::make($ditributor),
            ];
        }
        return $result;
    }
}
