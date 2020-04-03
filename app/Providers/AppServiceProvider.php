<?php

namespace App\Providers;

use App\Channel;
use App\Http\View\Composers\ChannelsComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use function foo\func;


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
        Schema::defaultStringLength(191);

        //in case i want to share data with all views
        //Option 1 - Every single view
/*        View::share('channels', Channel::orderBy('name')->get());*/

        //Option 2 - Granular views with wildcards
/*        View::composer( ['post.create', 'channel.index'], function ($view) {
            $view->with('channels', Channel::orderBy('name')->get());
        });*/

        //Option 3 - Dedicated class
        View::composer(['post.create', 'channel.index'], ChannelsComposer::class);
    }
}
