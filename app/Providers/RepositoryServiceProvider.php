<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \App\Repositories\Category\CategoryRepository::class,
            \App\Repositories\Category\CategoryRepositoryEloquent::class
        );

        $this->app->bind(
            \App\Repositories\Post\PostRepository::class,
            \App\Repositories\Post\PostRepositoryEloquent::class
        );

        $this->app->bind(
            \App\Repositories\Rate\RateRepository::class,
            \App\Repositories\Rate\RateRepositoryEloquent::class
        );

        $this->app->bind(
            \App\Repositories\Favourite\FavouriteRepository::class,
            \App\Repositories\Favourite\FavouriteRepositoryEloquent::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
