<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\PostController;
use App\Http\Controllers\Frontend\AgencyController;
use App\Http\Controllers\Frontend\HistoryController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\GalleryController;
use App\Http\Controllers\Frontend\SitemapController;
use App\Http\Controllers\Frontend\ProjectController;
use App\Http\Controllers\Frontend\PromotionController;
use App\Http\Controllers\Frontend\RoomController;
use App\Http\Controllers\Frontend\ServiceController;

Route::get('sitemap.xml', [SitemapController::class, 'index']);

Route::middleware(['meta_seo', 'opening'])->group(function () {
    Route::localized(function () {

        Route::controller(HomeController::class)->group(function () {
            Route::get(Lang::uri('/'), 'index')->name('home');
        });

        Route::get(Lang::uri('/contact'), [AgencyController::class, 'index'])->name('contact');

        Route::controller(HistoryController::class)->group(function () {
            Route::get(Lang::uri('about-us'), 'index')->name('histories.index');
        });

        Route::controller(PostController::class)->group(function () {
            Route::get(Lang::uri('posts'), 'index')->name('posts');
            Route::get(Lang::uri('posts') . '/{slug}', 'show')->name('posts.show');
        });

        Route::controller(ServiceController::class)->group(function () {
            Route::get(Lang::uri('services'), 'index')->name('services');
            Route::get(Lang::uri('services') . '/{slug}', 'show')->name('services.show');
        });

        Route::controller(PromotionController::class)->group(function () {
            Route::get(Lang::uri('promotions'), 'index')->name('promotions.index');
            Route::get(Lang::uri('promotions') . '/{slug}', 'show')->name('promotions.show');
        });

        Route::controller(RoomController::class)->group(function () {
            Route::get(Lang::uri('rooms'), 'index')->name('rooms.index');
            Route::get(Lang::uri('rooms') . '/{slug}', 'show')->name('rooms.show');
        });

        Route::controller(ProjectController::class)->group(function () {
            Route::get(Lang::uri('projects'), 'index')->name('projects.index');
            Route::get(Lang::uri('projects') . '/{slug}', 'show')->name('projects.show');
        });

        Route::controller(GalleryController::class)->group(function () {
            Route::get(Lang::uri('gallery'), 'index')->name('galleries.index');
        });

        Route::post(Lang::uri('contacts'), [ContactController::class, 'store'])->name('contact.store');
    });
});

Route::dynamicRedirect();
