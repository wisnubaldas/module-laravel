<?php

namespace Wisnubaldas\CleanClass;

use Illuminate\Support\ServiceProvider;
use Wisnubaldas\CleanClass\Console\Command\RouteCommand;
use Wisnubaldas\CleanClass\Console\Command\CleanClassCommand;

class CleanClassServiceProfider extends ServiceProvider {
    public function boot()
    {
        $this->loadRoutesFrom(base_path('routes/web.php'));
        $this->loadRoutesFrom(base_path('routes/api.php'));

        if ($this->app->runningInConsole()) {

            $this->commands([
                    CleanClassCommand::class,
                    RouteCommand::class,
                ]);
        }
        // $this->mergeConfigFrom(
        //     base_path('config/connection.php'),'database.connections'
        // );
    }
    public function register()
    {
        
        
    }
}