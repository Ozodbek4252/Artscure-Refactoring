<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

use Illuminate\Pagination\Paginator;

use App\Services\CurrencyService;
use App\Interfaces\CurrencyServiceInterface;
use App\Repositories\CurrencyRepository;
use App\Interfaces\CurrencyRepositoryInterface;

use App\Services\ContactService;
use App\Interfaces\ContactServiceInterface;
use App\Repositories\ContactRepository;
use App\Interfaces\ContactRepositoryInterface;

use App\Services\HelpService;
use App\Interfaces\HelpServiceInterface;
use App\Repositories\HelpRepository;
use App\Interfaces\HelpRepositoryInterface;

use App\Services\RequestService;
use App\Interfaces\RequestServiceInterface;
use App\Repositories\RequestRepository;
use App\Interfaces\RequestRepositoryInterface;

use App\Services\PaymentTypeService;
use App\Interfaces\PaymentTypeServiceInterface;
use App\Repositories\PaymentTypeRepository;
use App\Interfaces\PaymentTypeRepositoryInterface;

use App\Services\TypeService;
use App\Interfaces\TypeServiceInterface;
use App\Repositories\TypeRepository;
use App\Interfaces\TypeRepositoryInterface;

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

        $this->app->bind(ContactServiceInterface::class, ContactService::class);
        $this->app->bind(ContactRepositoryInterface::class, ContactRepository::class);

        $this->app->bind(HelpServiceInterface::class, HelpService::class);
        $this->app->bind(HelpRepositoryInterface::class, HelpRepository::class);

        $this->app->bind(RequestServiceInterface::class, RequestService::class);
        $this->app->bind(RequestRepositoryInterface::class, RequestRepository::class);

        $this->app->bind(PaymentTypeServiceInterface::class, PaymentTypeService::class);
        $this->app->bind(PaymentTypeRepositoryInterface::class, PaymentTypeRepository::class);

        $this->app->bind(TypeServiceInterface::class, TypeService::class);
        $this->app->bind(TypeRepositoryInterface::class, TypeRepository::class);
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
