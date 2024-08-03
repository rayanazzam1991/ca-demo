<?php

namespace App\Enums;


use App\Core\Banner\BannerModel;
use App\Core\DeliveryMan\Infrastructure\Eloquent\DeliveryManModel;
use App\Core\Distributor\Infrastructure\Eloquent\DistributorModel;
use App\Core\Feed\Infrastructure\Eloquent\FeedModel;
use App\Core\Item\Infrastructure\Eloquent\ItemModel;
use App\Core\Manufacturer\Infrastructure\Eloquent\ManufacturerModel;
use App\Core\Shared\User\UserModel;

enum PathEnum: string
{
    case other = "other/";
    case banner = "banner/";
    case item = "item/";
    case feed = "feed/";
    case distributor = "distributor/";
    case deliverMan = "deliveryMan/";
    case user = "user/";
    case manufacturer = "manufacturer/";

    public static function asArray(): array
    {
        return array_map(fn ($x) => $x->value, self::cases());
    }

    public static function getPath($model_class): string
    {

        switch ($model_class) {
            case BannerModel::class:
                return self::banner->value;
            case ItemModel::class:
                return self::item->value;
            case FeedModel::class:
                return self::feed->value;
            case DistributorModel::class:
                return self::distributor->value;
            case UserModel::class:
                return self::user->value;
            case DeliveryManModel::class:
                return self::deliverMan->value;
            case ManufacturerModel::class:
                return self::manufacturer->value;
            default:
                return self::other->value;
        }
    }

    public static function getModelClass($model): string
    {
        return match ($model) {
            MediaModelsEnum::banner->value => BannerModel::class,
            MediaModelsEnum::item->value => ItemModel::class,
            MediaModelsEnum::feed->value => FeedModel::class,
            MediaModelsEnum::distributor->value => DistributorModel::class,
            MediaModelsEnum::user->value => UserModel::class,
            MediaModelsEnum::deliveryMan->value => DeliveryManModel::class,
            MediaModelsEnum::manufacturer->value => ManufacturerModel::class,
            default => null,
        };
    }
}
