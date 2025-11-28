<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\KeywordController;
use App\Http\Controllers\Api\SepayWebhookController;

Route::localized(function () {
    Route::controller(ProductController::class)->group(function () {
        Route::get(Lang::uri('products'), 'index')->name('api.products');
        Route::get(Lang::uri('rating') . '/{product_id}', 'rating')->name('rating');
        Route::get(Lang::uri('instant-search') . '/{keyword}', 'instantSearch')->name('instant_search');
        Route::get(Lang::uri('product-sale'), 'flashSale')->name('api.flash_sale');
        Route::post('sepay-webhook', [SepayWebhookController::class, 'storeTransaction'])->name('api.cart.index');
    });
});

Route::get('keywords/index', [KeywordController::class, 'index'])
    ->name('api.keywords.index');
