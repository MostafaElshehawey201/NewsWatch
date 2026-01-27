<?php

namespace App\Providers;

use App\Models\Comment;
use App\Policies\commentPolicy;
use App\Interfaces\Auth\AuthInterface;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\Post\CommentInterface;
use App\Repositories\Auth\AuthRepository;
use App\Interfaces\Post\EditPostInterface;
use App\Interfaces\Auth\AuthLoginInterface;
use App\Interfaces\Post\DeletePostInterface;
use App\Interfaces\Post\PostCreateInterface;
use App\Interfaces\Post\UpdatePostInterface;
use App\Interfaces\Auth\AuthCheckOtpInterface;
use App\Interfaces\Post\ShowAllPostsInterface;
use App\Interfaces\User\updateProfileInterface;
use App\Repositories\Post\PostProcessRepository;

use App\Repositories\User\updateProfileRepository;
use App\Interfaces\Auth\AuthResetPasswordInterface;
use App\Interfaces\Post\AddPostToFavoriteInterface;
use App\Interfaces\Post\showPostsFavoriteInterface;
use App\Interfaces\Auth\AuthForgetPasswordInterface;
use App\Interfaces\Post\RemovePostFavoriteInterface;
use App\Interfaces\Relation\SearchUserRelationInterface;
use App\Repositories\Relation\SearchUserRelationRepository;

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
            ShowAllPostsInterface::class,
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
            DeletePostInterface::class,
            PostProcessRepository::class,
        );
        $this->app->bind(
            CommentInterface::class,
            PostProcessRepository::class,
        );
        $this->app->bind(
            SearchUserRelationInterface::class,
            SearchUserRelationRepository::class,
        );
        $this->app->bind(
            UpdatePostInterface::class,
            PostProcessRepository::class,
        );

    } 

    protected $policies =[
        Comment::class => commentPolicy::class,
    ];

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
