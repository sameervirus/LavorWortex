<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // $this->app->bind('path.public', function() {
        //     return base_path('../public_html/lavor');
        // });

        view()->composer('layouts.app', function($view)
        {
            $locale = \App::getLocale();
            $site_content = \App\Admin\SiteContent\Sitecontent::where('lang',$locale)->pluck('content', 'code');
            $view->with('site_content', $site_content);
        });

        view()->composer('wortex.layouts.app', function($view)
        {
            $locale = \App::getLocale();
            $site_content = \App\Admin\SiteContent\Sitecontent::where('lang',$locale)->pluck('content', 'code');
            $view->with('site_content', $site_content);
        });

        view()->composer('admin.side', function($view)
        {
            $locale = \App::getLocale();
            $pages = \App\Admin\Pages\Page::all();
            $view->with('pages', $pages);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
