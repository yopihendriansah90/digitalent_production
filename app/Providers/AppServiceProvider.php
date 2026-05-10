<?php

namespace App\Providers;

use App\Services\Content\PageContentService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Throwable;

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
    public function boot(PageContentService $contentService): void
    {
        if ($this->app->runningInConsole()) {
            View::share('siteSetting', null);

            return;
        }

        try {
            View::share('siteSetting', $contentService->getSiteSetting());
        } catch (Throwable) {
            View::share('siteSetting', null);
        }
    }
}
