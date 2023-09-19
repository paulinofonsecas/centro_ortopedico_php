<?php

namespace App\Providers;

use Filament\Notifications\Livewire\DatabaseNotifications;
use Filament\Support\Facades\FilamentView;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Blade;
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
            'panels::auth.login.form.after',
            fn (): string => Blade::render("@livewire('components.back-to-home-page')"),
        );

        FilamentView::registerRenderHook(
            'panels::global-search.before',
            fn (): string => Blade::render("@livewire('database-notifications')"),
        );
    }
}
