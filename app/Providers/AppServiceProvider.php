<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

use App\Repositories\User\UserEloquent;
use App\Repositories\User\UserRepository;

use App\Repositories\FileCategory\FileCategoryEloquent;
use App\Repositories\FileCategory\FileCategoryRepository;


use App\Repositories\File\FileEloquent;
use App\Repositories\File\FileRepository;


use App\Repositories\Record\RecordEloquent;
use App\Repositories\Record\RecordRepository;

use App\Repositories\Incident\IncidentEloquent;
use App\Repositories\Incident\IncidentRepository;

use App\Repositories\Province\ProvinceEloquent;
use App\Repositories\Province\ProvinceRepository;


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
          $this->app->singleton(FileRepository::class,FileEloquent::class);   
          $this->app->singleton(IncidentRepository::class,IncidentEloquent::class);
          $this->app->singleton(RecordRepository::class,RecordEloquent::class);
          $this->app->singleton(ProvinceRepository::class,ProvinceEloquent::class);
        //
    }
}
