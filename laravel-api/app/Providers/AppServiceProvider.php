<?php

namespace App\Providers;

use App\Core\SearchObject\BaseSearchObject;
use App\Product\SearchObjects\ProductSearchObject;
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

        $this->app->bind(ProductSearchObject::class, function ($app, $parameters) {
            return new ProductSearchObject($parameters);
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
