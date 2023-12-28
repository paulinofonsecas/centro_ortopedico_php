<?php

namespace App\Providers\Filament;

use App\Filament\Login\CustomLoginPage;
use App\Filament\Pages\dashboards\tecnico\TecnicoDashboard;
use App\Filament\Pages\dashboards\tecnico\widgets\StatsOverview;
use App\Filament\Tecnico\Resources\DoacaoResource;
use App\Filament\Tecnico\Resources\PacienteResource;
use App\Filament\Tecnico\Resources\UtenteResource;
use App\Filament\Tecnico\Resources\ItemResource;
use App\Http\Middleware\CheckTecnicoPanel;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationBuilder;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Filament\Pages\Auth\EditProfile;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class TecnicoPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('tecnico')
            ->path('tecnico')
            ->login(CustomLoginPage::class)
            ->databaseNotifications()
            ->databaseNotificationsPolling(30000)
            ->authMiddleware([CheckTecnicoPanel::class])
            ->profile(EditProfile::class)
            ->colors([
                'primary' => Color::Green,
            ])
            ->navigation(function (NavigationBuilder $builder): NavigationBuilder {
                return $builder
                    ->items([
                        NavigationItem::make('Dashboard')
                            ->icon('heroicon-o-home')
                            ->url('/tecnico')
                            ->isActiveWhen(fn (): bool => request()->fullUrlIs(TecnicoDashboard::getUrl())),
                            ...PacienteResource::getNavigationItems(),
                            ])
                            ->groups([
                                NavigationGroup::make('Distribução')
                                ->items([
                                ...DoacaoResource::getNavigationItems(),
                                ...ItemResource::getNavigationItems(),
                                ...UtenteResource::getNavigationItems(),
                            ]),
                    ]);
            })
            ->discoverResources(in: app_path('Filament/Tecnico/Resources'), for: 'App\\Filament\\Tecnico\\Resources')
            ->discoverPages(in: app_path('Filament/Tecnico/Pages'), for: 'App\\Filament\\Tecnico\\Pages')
            ->pages([
                TecnicoDashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Tecnico/Widgets'), for: 'App\\Filament\\Tecnico\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,

                StatsOverview::class,
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
            ->sidebarCollapsibleOnDesktop();
    }
}
