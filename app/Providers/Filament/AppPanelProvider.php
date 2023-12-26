<?php

namespace App\Providers\Filament;

use App\Filament\App\Resources\ConsultaResource;
use App\Filament\App\Resources\ConsultorioResource;
use App\Filament\App\Resources\DoacaoResource;
use App\Filament\App\Resources\PacienteResource;
use App\Filament\App\Resources\UtenteResource;
use App\Filament\Login\CustomLoginPage;
use App\Http\Middleware\CheckRecepcionistaPanel;
use App\Http\Middleware\CheckResetPassword;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationBuilder;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentView;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use JibayMcs\FilamentTour\FilamentTourPlugin;

class AppPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {

        return $panel
            ->login(CustomLoginPage::class)
            ->authMiddleware([CheckRecepcionistaPanel::class])
            ->profile(\App\Filament\Pages\EditProfiles::class)
            ->databaseNotifications()
            ->databaseNotificationsPolling(30000)
            ->id('app')
            ->path('/recepcionista')
            ->colors([
                'primary' => Color::Amber,
            ])
            ->navigation(function (NavigationBuilder $builder): NavigationBuilder {
                return $builder
                    ->items([
                        NavigationItem::make('Dashboard')
                            ->icon('heroicon-o-home')
                            ->url('/recepcionista')
                            ->isActiveWhen(fn (): bool => request()->fullUrlIs(Pages\Dashboard::getUrl())),
                    ])
                    ->groups([
                        NavigationGroup::make('Produção')
                            ->items([
                                ...ConsultaResource::getNavigationItems(),
                                ...PacienteResource::getNavigationItems(),
                            ]),
                        NavigationGroup::make('Doação')
                            ->items([
                                ...DoacaoResource::getNavigationItems(),
                                ...UtenteResource::getNavigationItems(),
                            ]),
                        NavigationGroup::make('Administração')
                            ->items([
                                ...ConsultorioResource::getNavigationItems(),
                            ]),
                    ]);
            })
            ->discoverResources(in: app_path('Filament/App/Resources'), for: 'App\\Filament\\App\\Resources')
            ->discoverPages(in: app_path('Filament/App/Pages'), for: 'App\\Filament\\App\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/App/Widgets'), for: 'App\\Filament\\App\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
                // CheckResetPassword::class ,
            ])
            ->sidebarCollapsibleOnDesktop()
            ->plugins([
            ]);
    }
}
