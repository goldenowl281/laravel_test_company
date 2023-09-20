<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\CompanyRepositoryInterface;
use App\Interfaces\EmployeeRepositoryInterface;
use App\Repositories\CompanyRepository;
use App\Repositories\EmployeeRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            CompanyRepositoryInterface::class,
            CompanyRepository::class
        );
        $this->app->bind(
            EmployeeRepositoryInterface::class,
            EmployeeRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
