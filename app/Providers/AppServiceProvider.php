<?php

namespace App\Providers;

use App\Interfaces\Auth\AuthCheckOtpInterface;
use App\Interfaces\Auth\AuthForgetPasswordInterface;
use App\Interfaces\Auth\AuthInterface;
use App\Interfaces\Auth\AuthLoginInterface;
use App\Interfaces\Auth\AuthResetPasswordInterface;
use App\Interfaces\Post\AddPostToFavoriteInterface;
use App\Interfaces\Post\EditPostInterface;
use App\Interfaces\Post\PostCreateInterface;
use App\Interfaces\Post\RemovePostFavoriteInterface;
use App\Interfaces\Post\showPostsFavoriteInterface;
use App\Interfaces\Relation\SearchUserRelationInterface;

use App\Interfaces\User\updateProfileInterface;
use App\Repositories\Auth\AuthRepository;
use App\Repositories\Post\PostProcessRepository;
use App\Repositories\Relation\SearchUserRelationRepository;
use App\Repositories\User\updateProfileRepository;
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
        $this->app->bind(
            AuthForgetPasswordInterface::class,
            AuthRepository::class,
        );
        $this->app->bind(
            AuthCheckOtpInterface::class,
            AuthRepository::class,
        );
        $this->app->bind(
            AuthResetPasswordInterface::class,
            AuthRepository::class,
        );
        $this->app->bind(
            updateProfileInterface::class,
            updateProfileRepository::class
        );
        $this->app->bind(
            PostCreateInterface::class,
            PostProcessRepository::class,
        );
        $this->app->bind(
            AddPostToFavoriteInterface::class,
            PostProcessRepository::class,
        );

        $this->app->bind(
            showPostsFavoriteInterface::class,
            PostProcessRepository::class,
        );
        $this->app->bind(
            EditPostInterface::class,
            PostProcessRepository::class,
        );
        $this->app->bind(
            RemovePostFavoriteInterface::class,
            PostProcessRepository::class,
        );

        $this->app->bind(
            SearchUserRelationInterface::class,
            SearchUserRelationRepository::class,
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
