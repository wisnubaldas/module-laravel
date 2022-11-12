<?php

namespace Wisnubaldas\CleanClass;

use Illuminate\Support\ServiceProvider;
use Wisnubaldas\CleanClass\Local\DomainCommand;
use Wisnubaldas\CleanClass\Local\DriverCommand;
use Wisnubaldas\CleanClass\Local\MakeRepositoriesCommand;
use Wisnubaldas\CleanClass\Local\UsecaseCommand;

class CleanClassServiceProfider extends ServiceProvider {
    public function boot()
    {
        if ($this->app->runningInConsole()) {
        $this->commands([
            DomainCommand::class,
            DriverCommand::class,
            MakeRepositoriesCommand::class,
            UsecaseCommand::class,
            ]);
        }
    }
    public function register()
    {
        // $this->app->singleton(ClientAP::class,function($app){
        //     return new ClientAP();
        //  });
    }
}