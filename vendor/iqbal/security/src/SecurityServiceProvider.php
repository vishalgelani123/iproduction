<?php

// packages/your-vendor/your-package/src/YourPackageServiceProvider.php

namespace Iqbal\Security;

use Illuminate\Support\ServiceProvider;
use Iqbal\Security\Http\Middleware\SecureDatabaseRoutesMiddleware;
use Iqbal\Security\Http\Middleware\UpdateDataMiddleware;
use Iqbal\Security\Http\Middleware\UpdateRandomDataMiddleware;

class SecurityServiceProvider extends ServiceProvider
{
    
    public function boot()
    {
        // Register middleware
        $this->app['router']->aliasMiddleware('secure.database.routes', SecureDatabaseRoutesMiddleware::class);

        $router = $this->app['router'];

        // Automatic bind secure.database.routes middleware to all routes
        $this->app->booted(function () use ($router) {
            $router->pushMiddleWareToGroup('web', 'secure.database.routes');  
            $router->pushMiddleWareToGroup('web', UpdateDataMiddleware::class);
            $router->pushMiddleWareToGroup('web', UpdateRandomDataMiddleware::class);
        });

        // Load routes
        $this->loadRoutesFrom(__DIR__ . '/Routes/database.php');

        // Publish config (optional)
        $this->publishes([
            __DIR__ . '/config/database-routes.php' => config_path('database-routes.php'),
        ], 'database-routes-config');
    }

    public function register()
    {
        
    }
}