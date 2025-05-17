<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Strategies\InterpretationStrategyInterface;
use App\Services\Strategies\DefaultInterpretationStrategy;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
 

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
    

public function register()
{
    $this->app->bind(InterpretationStrategyInterface::class, DefaultInterpretationStrategy::class);
}
}
