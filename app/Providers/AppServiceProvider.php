<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

use App\Repositories\User\UserEloquent;
use App\Repositories\User\UserRepository;

use App\Repositories\FileCategory\FileCategoryEloquent;
use App\Repositories\FileCategory\FileCategoryRepository;




class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
       Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
          $this->app->singleton(UserRepository::class,UserEloquent::class);
          $this->app->singleton(FileCategoryRepository::class,FileCategoryEloquent::class);
        //
    }
}
