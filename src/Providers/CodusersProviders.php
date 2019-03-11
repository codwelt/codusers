<?php

namespace Codwelt\codusers\Providers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\ServiceProvider;

class CodusersProviders extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */

    public function boot()
    {


    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../Config/codviews.php', 'courier'
        );
    }

    /**
     * Register the application services.
     *
     * @return void
     */

    private function cargavistas()
    {
        self::publicar([__DIR__ . '/../Views' => resource_path('views/codusers/'),], 'views-codusers');
    }

    private function cargaseeders()
    {
        self::publicar([__DIR__ . '/../Seeders/' => database_path('/codusers'),], 'seeder-codusers');
    }

    private function cargamiddleware()
    {
        self::publicar([__DIR__ . '/../Middleware/' => app_path('/Http/Middleware/codusers/'),], 'Middleware-codusers');
    }

    private function cargaconfiguraciones()
    {
        self::publicar([__DIR__ . '/../Config/codviews.php' => config_path('codviews.php')], 'public-config');
    }

    private function cargaassets()
    {
        self::publicar([__DIR__ . '/../public' => public_path('codviews'),], 'public-codviews');
    }

    private function publicar($pu)
    {
        $this->publishes($pu);
    }

    private function cargasini()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Migrations/');
        $this->loadRoutesFrom(realpath(__DIR__ . '/../routes.php'));
    }
}

}
