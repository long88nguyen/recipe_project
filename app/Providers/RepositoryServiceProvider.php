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

        $this->app->bind(
            \App\Repositories\Ingredient\IngredientRepository::class,
            \App\Repositories\Ingredient\IngredientRepositoryEloquent::class
        );

        $this->app->bind(
            \App\Repositories\Direction\DirectionRepository::class,
            \App\Repositories\Direction\DirectionRepositoryEloquent::class
        );

        $this->app->bind(
            \App\Repositories\PostImage\PostImageRepository::class,
            \App\Repositories\PostImage\PostImageRepositoryEloquent::class
        );

        $this->app->bind(
            \App\Repositories\Comment\CommentRepository::class,
            \App\Repositories\Comment\CommentRepositoryEloquent::class
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
