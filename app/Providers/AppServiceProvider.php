<?php

namespace App\Providers;

use App\Interfaces\Auth\AuthInterface;
use App\Interfaces\Auth\AuthLoginInterface;
use App\Repositories\Auth\AuthRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            AuthInterface::class,
            AuthRepository::class,
        );
        $this->app->bind(
            AuthLoginInterface::class,
            AuthRepository::class,
        );
    } 

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
