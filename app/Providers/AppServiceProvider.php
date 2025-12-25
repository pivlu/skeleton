<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use App;

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
        // Check if app is installed (if not in console)
        if (!App::runningInConsole()) {
            if (!Schema::hasTable('pivlu_config')) {
                echo ('Pivlu is not installed!');
                exit;
            }
        }

        Paginator::useBootstrapFive();
    }
}
