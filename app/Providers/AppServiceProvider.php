<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

use Illuminate\Pagination\Paginator;

use App\Services\CurrencyService;
use App\Interfaces\CurrencyServiceInterface;
use App\Repositories\CurrencyRepository;
use App\Interfaces\CurrencyRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CurrencyServiceInterface::class, CurrencyService::class);
        $this->app->bind(CurrencyRepositoryInterface::class, CurrencyRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(199);

        Paginator::useBootstrapFive();
        Paginator::useBootstrapFour();
    }
}
