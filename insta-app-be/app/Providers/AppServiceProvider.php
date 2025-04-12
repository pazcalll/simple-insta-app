<?php

namespace App\Providers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Route::bind('like', function ($value) {
            return Like::where('id', $value)->firstOrFail();
        });

        Route::bind('post', function ($value) {
            return Post::where('id', $value)->firstOrFail();
        });
    }
}
