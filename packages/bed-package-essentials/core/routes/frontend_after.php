<?php

use Illuminate\Support\Facades\Route;



Route::localized(function () {
    Route::get('/{path}', fn() => abort(404))->where('path', '^(?!admin|totem).*$');
});
