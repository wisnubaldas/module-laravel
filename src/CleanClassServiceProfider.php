<?php

namespace Wisnubaldas\ConsoleInLaravel;

use Illuminate\Support\ServiceProvider;
use Wisnubaldas\ConsoleInLaravel\Console\Command\RouteCommand;
use Wisnubaldas\ConsoleInLaravel\Console\Command\ConsoleInLaravelCommand;

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