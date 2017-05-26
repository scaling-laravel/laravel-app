<?php

namespace App\Providers;

use App\Analytics\Pageview;
use App\Analytics\Pageviews;
use App\Analytics\PageviewCache;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Pageview::class, function($app)
        {
            return new PageviewCache(
                new Pageviews(auth()->user())
            );
        });
    }
}
