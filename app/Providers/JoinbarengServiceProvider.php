<?php

namespace App\Providers;

use App\Services\JoinbarengService;
use Illuminate\Support\ServiceProvider;

class JoinbarengServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(JoinbarengService::class, function () {
            return new JoinbarengService(
                apiUrl: (string) config('services.joinbareng.url'),
                apiKey: (string) config('services.joinbareng.key'),
                model: (string) config('services.joinbareng.model'),
            );
        });
    }

    public function boot(): void
    {
        //
    }
}