<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('head', function($view){
            $programs = \App\Program::all();
            $committeeMembers = \App\CommitteeMember::activeMembers();
            $month = date('m');

            $view->with(compact('programs', 'committeeMembers', 'month'));
        });

        view()->composer('layouts.layout', function($view){
            $quarters = [1, 4, 7, 10];
            $view->with(compact('quarters'));
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
