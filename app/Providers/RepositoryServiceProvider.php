<?php

namespace App\Providers;

use App\Interfaces\RepositoryInterfaces\Developers\DeveloperRepositoryInterface;
use App\Interfaces\RepositoryInterfaces\Tasks\TaskRepositoryInterface;
use App\Repositories\BaseRepository;
use App\Interfaces\RepositoryInterfaces\BaseRepositoryInterface;
use App\Repositories\Developers\DeveloperRepository;
use App\Repositories\Tasks\TaskRepository;
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
        $this->app->bind(BaseRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(TaskRepositoryInterface::class, TaskRepository::class);
        $this->app->bind(DeveloperRepositoryInterface::class, DeveloperRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
