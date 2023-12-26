<?php

namespace App\Providers\Filament;

use App\Filament\Login\CustomLoginPage;
use App\Filament\Medico\Resources\ConsultaResource;
use App\Filament\Medico\Resources\ConsultorioResource;
use App\Filament\Medico\Resources\FichaAvaliacaoResource;
use App\Filament\Medico\Resources\PacienteResource;
use App\Filament\Medico\Resources\TratamentoResource;
use App\Filament\Pages\dashboards\medico\MedicoDashboard;
use App\Filament\Pages\dashboards\medico\widgets\StatsOverview;
use App\Http\Middleware\CheckMedicoPanel;
use Filament\Http\Middleware\Authenticate;
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

class MedicoPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->login(CustomLoginPage::class)
            ->id('medico')
            ->databaseNotifications()
            ->databaseNotificationsPolling(30000)
            ->authMiddleware([CheckMedicoPanel::class])
            ->profile(EditProfile::class)
            ->path('medico')
            ->colors([
                'primary' => Color::Purple,
            ])
            ->navigation(function (NavigationBuilder $builder): NavigationBuilder {
                return $builder
                    ->items([
                            NavigationItem::make('Dashboard')
                                ->icon('heroicon-o-home')
                                ->url('/medico')
                                ->isActiveWhen(fn (): bool => request()->fullUrlIs(MedicoDashboard::getUrl())),
                    ])
                    ->groups([
                        NavigationGroup::make('Produção')
                            ->items([
                                ...ConsultaResource::getNavigationItems(),
                                ...TratamentoResource::getNavigationItems(),
                                ...FichaAvaliacaoResource::getNavigationItems(),
                            ]),
                        NavigationGroup::make('Administração')
                            ->items([
                                ...PacienteResource::getNavigationItems(),
                                ...ConsultorioResource::getNavigationItems(),
                            ]),
                    ]);
            })
            ->discoverResources(in: app_path('Filament/medico/Resources'), for: 'App\\Filament\\Medico\\Resources')
            ->discoverPages(in: app_path('Filament/medico/Pages'), for: 'App\\Filament\\Medico\\Pages')
            ->pages([
                MedicoDashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/medico/Widgets'), for: 'App\\Filament\\Medico\\Widgets')
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
            ->authMiddleware([
                Authenticate::class,
            ])
            ->sidebarCollapsibleOnDesktop();
    }
}
