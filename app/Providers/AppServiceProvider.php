<?php

namespace App\Providers;

use Filament\Support\Facades\FilamentView;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();
        FilamentView::registerRenderHook(
            'panels::page.start',
            function () {
                ds('page rendered');
            },
            scopes: [
                \App\Filament\Resources\MedicoResource::class,
                \App\Filament\Resources\RecepcionistaResource::class,
            ],
        );
    }
}
