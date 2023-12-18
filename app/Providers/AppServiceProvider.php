<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// The Date facade
use Illuminate\Support\Facades\Date;

// And the CarbonImmutable class
use Carbon\CarbonImmutable;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Date::use(CarbonImmutable::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
