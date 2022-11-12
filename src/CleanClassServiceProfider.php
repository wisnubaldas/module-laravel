<?php

namespace Wisnubaldas\CleanClass;
use Illuminate\Support\ServiceProvider;
class CleanClassServiceProfider extends ServiceProvider {
    public function boot()
    {
    }
    public function register()
    {
        // $this->app->singleton(ClientAP::class,function($app){
        //     return new ClientAP();
        //  });
    }
}