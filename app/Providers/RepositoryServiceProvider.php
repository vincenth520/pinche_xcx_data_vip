<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Repositories\Contracts\SettingRepository::class, \App\Repositories\Eloquent\SettingRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\InfoRepository::class, \App\Repositories\Eloquent\InfoRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\CollectRepository::class, \App\Repositories\Eloquent\CollectRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\CommentRepository::class, \App\Repositories\Eloquent\CommentRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\ZanRepository::class, \App\Repositories\Eloquent\ZanRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\MomentRepository::class, \App\Repositories\Eloquent\MomentRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\DriverRepository::class, \App\Repositories\Eloquent\DriverRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\BannerRepository::class, \App\Repositories\Eloquent\BannerRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\ArticleRepository::class, \App\Repositories\Eloquent\ArticleRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\MessageRepository::class, \App\Repositories\Eloquent\MessageRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\AppointmentRepository::class, \App\Repositories\Eloquent\AppointmentRepositoryEloquent::class);
        //:end-bindings:
    }
}
