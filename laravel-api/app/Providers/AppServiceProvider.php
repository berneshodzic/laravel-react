<?php

namespace App\Providers;

use App\Core\SearchObject\BaseSearchObject;
use App\Order\SearchObjects\OrderSearchObject;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(BaseSearchObject::class, function ($app, $parameters) {
            return new BaseSearchObject($parameters);
        });

        $this->app->bind(OrderSearchObject::class, function ($app, $parameters) {
            return new OrderSearchObject($parameters);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
