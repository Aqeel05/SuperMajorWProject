<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema; // Required
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // In previous versions of Laravel, the data limit of any cell was 767 bytes, so the max number of characters allowed without
        // going beyond this limit was 191
        // According to our error 1071, the current data limit is 1000 bytes, so the max number of characters becomes 250
        // but I went with 200 to limit the data storage
        Schema::defaultStringLength(200);
    }
}
