<?php

use App\Http\Controllers\V1\Auth\DeleteAccountController;
use App\Http\Controllers\V1\Auth\SendCodeController;
use App\Http\Controllers\V1\Auth\SignupControoler;
use App\Http\Controllers\V1\Auth\StoreFcmTokenController;
use App\Http\Controllers\V1\Auth\VerifyCodeController;
use App\Http\Controllers\V1\Pharmacy\EditPharmacyController;
use App\Http\Controllers\V1\Pharmacy\GetPharmacyController;
use App\Http\Controllers\V1\User\SignOutController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => "auth/"], function () {
    Route::post('send_code', SendCodeController::class);
    Route::post('verify_code', VerifyCodeController::class);
    Route::post('signup', SignupControoler::class);
});



Route::group(['prefix' => "item/"], function () {
    Route::get('', \App\Http\Controllers\V1\Item\IndexController::class);
    Route::get('price-variation', \App\Http\Controllers\V1\Item\GetPriceVariationController::class);
    Route::get('popular', \App\Http\Controllers\V1\Item\GetPoupularController::class);
    Route::get('search', \App\Http\Controllers\V1\Item\SearchController::class);
    Route::get('{id}', \App\Http\Controllers\V1\Item\ShowController::class);
    Route::get('alternative/{id}', \App\Http\Controllers\V1\Item\GetAlternativeController::class);
});
Route::group(['prefix' => "update/",], function () {
    Route::get('', \App\Http\Controllers\V1\Feed\GetUpdateListController::class);
});
Route::group(['prefix' => "offer/",], function () {
    Route::get('', \App\Http\Controllers\V1\Offer\IndexController::class);
});


Route::group(['middleware' => ['auth', 'role:' . \App\Enums\RoleEnum::Pharmacy->value]], function () {
    Route::group(['prefix' => "auth/"], function () {
        Route::get('my_profile', GetPharmacyController::class);
        Route::post('edit_profile', EditPharmacyController::class);
        Route::get('signout', SignOutController::class);
        Route::post('setFcmToken', StoreFcmTokenController::class);
        Route::delete('delete', DeleteAccountController::class);
    });

    Route::group(['prefix' => "notify/",], function () {
        Route::post('', \App\Http\Controllers\V1\Reminder\StoreController::class);
    });

    Route::group(['prefix' => "favourite/",], function () {
        Route::get('', \App\Http\Controllers\V1\Favourite\IndexController::class);
        Route::post('', \App\Http\Controllers\V1\Favourite\StoreController::class);
    });

    Route::group(['prefix' => "update/",], function () {
        Route::get('{id}', \App\Http\Controllers\V1\Feed\ShowController::class);
        Route::post('', \App\Http\Controllers\V1\Update\CreateUpdateController::class);
    });

    Route::group(['prefix' => "cart",], function () {
        Route::get('', \App\Http\Controllers\V1\Cart\ShowController::class);
        Route::delete('', \App\Http\Controllers\V1\Cart\DeleteController::class);
    });

    Route::group(['prefix' => "order/",], function () {
        Route::get('', \App\Http\Controllers\V1\Order\IndexController::class);
        Route::get('{id}', \App\Http\Controllers\V1\Order\ShowController::class);
        Route::delete('{id}/CancelOrder', \App\Http\Controllers\V1\Order\CancelOrderController::class);
        Route::post('{id}/returnOrder', \App\Http\Controllers\V1\Order\ReturnOrderController::class);
        Route::post('', \App\Http\Controllers\V1\Order\StoreController::class);
    });

    Route::group(['prefix' => "cart-item/",], function () {
        Route::post('', \App\Http\Controllers\V1\CartItem\StoreController::class);
        Route::delete('{id}', \App\Http\Controllers\V1\CartItem\DestroyController::class);
    });

    Route::group(['prefix' => "shift/",], function () {
        Route::get('', \App\Http\Controllers\V1\Shift\IndexController::class);
        Route::post('', \App\Http\Controllers\V1\Shift\StoreController::class);
    });


    Route::group(['prefix' => "category/"], function () {
        Route::get('', \App\Http\Controllers\V1\Distributor\GetDistributorCategoryController::class);
    });

    Route::group(['prefix' => "distributors/"], function () {
        Route::get('payment-type', \App\Http\Controllers\V1\Distributor\GetDistributorPaymentTypeController::class);
        Route::get('manufacturer', \App\Http\Controllers\V1\Distributor\GetDistributorManufacturersController::class);
    });
    Route::group(['prefix' => "pharmacy/notification/"], function () {
        Route::get('', \App\Http\Controllers\V1\Notification\GetPharmacyNotificationController::class);
    });
});
