<?php

namespace App\Providers;

use Illuminate\Support\{ServiceProvider,Collection};

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Collection::macro('trim', function() {
            return $this->map(fn($eachValue) => trim($eachValue));
        });
    }
}
