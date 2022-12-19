<?php

namespace App\Providers;

use App\Repositories\Task\TaskRepository;
use App\Repositories\Task\TaskRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(TaskRepositoryInterface::class, TaskRepository::class);
//        $this->app->bind(TaskRepositoryInterface::class, TaskRepository::class);
    }
}
