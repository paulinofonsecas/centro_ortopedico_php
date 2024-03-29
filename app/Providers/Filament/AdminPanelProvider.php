<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Dashboards\Admin\AdminDashboard;
use App\Filament\Pages\Dashboards\Admin\Widgets\ConsultasChart;
use App\Filament\Pages\Dashboards\Admin\Widgets\ControlUsuariosStatsOverview;
use App\Filament\Pages\Dashboards\Admin\Widgets\StatsOverview;
use App\Filament\Resources\AdministradorResource;
use App\Filament\Resources\ConsultaResource;
use App\Filament\Resources\ConsultorioResource;
use App\Filament\Resources\DoacaoResource;
use App\Filament\Resources\EspecialidadeResource;
use App\Filament\Resources\EstadoConsultaResource;
use App\Filament\Resources\ItemResource;
use App\Filament\Resources\MedicoResource;
use App\Filament\Resources\PacienteResource;
use App\Filament\Resources\RecepcionistaResource;
use App\Filament\Resources\RoleResource;
use App\Filament\Resources\TecnicoResource;
use App\Filament\Resources\TipoTratamentoResource;
use App\Filament\Resources\TratamentoResource;
use App\Filament\Resources\UtenteResource;
use App\Http\Middleware\CheckAdminPanel;
use Filament\Http\Middleware\Authenticate;
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
use Leandrocfe\FilamentApexCharts\Facades\FilamentApexCharts;
use Leandrocfe\FilamentApexCharts\FilamentApexChartsPlugin;
use Rmsramos\Activitylog\ActivitylogPlugin;
use Rmsramos\Activitylog\Resources\ActivitylogResource;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->login()
            ->id('admin')
            ->authMiddleware([CheckAdminPanel::class])
            ->path('/admin')
            ->profile(EditProfile::class)
            // ->viteTheme('resources/css/filament/admin/theme.css')
            ->colors([
                'primary' => Color::Red,
            ])
            ->navigation(function (NavigationBuilder $builder): NavigationBuilder {
                return $builder
                    ->items([
                        NavigationItem::make('Dashboard')
                            ->icon('heroicon-o-home')
                            ->url('/admin'),
                    ])
                    ->groups([
                        NavigationGroup::make('Administração')
                            ->items([
                                ...ConsultaResource::getNavigationItems(),
                                ...PacienteResource::getNavigationItems(),
                                ...TratamentoResource::getNavigationItems(),
                            ]),
                        NavigationGroup::make('Usuarios')
                            ->items([
                                ...RecepcionistaResource::getNavigationItems(),
                                ...MedicoResource::getNavigationItems(),
                                ...TecnicoResource::getNavigationItems(),
                                ...AdministradorResource::getNavigationItems(),
                                ...ActivitylogResource::getNavigationItems(),
                            ]),

                        NavigationGroup::make('Doações')
                            ->items([
                                ...UtenteResource::getNavigationItems(),
                                ...ItemResource::getNavigationItems(),
                                ...DoacaoResource::getNavigationItems(),
                            ]),
                        NavigationGroup::make('Permissões')
                            ->items([
                                ...RoleResource::getNavigationItems(),
                            ]),
                        NavigationGroup::make('Outros')
                            ->items([
                                ...ConsultorioResource::getNavigationItems(),
                                ...EspecialidadeResource::getNavigationItems(),
                                // ...EstadoConsultaResource::getNavigationItems(),
                                ...TipoTratamentoResource::getNavigationItems(),
                            ]),
                    ]);
            })
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages\\Dashboards\\Admin')
            ->pages([
                AdminDashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/App/Widgets'), for: 'App\\Filament\\Pages\\Dashboards\\Admin\\Widgets')
            ->widgets([
                StatsOverview::class,
                ConsultasChart::class,
                ControlUsuariosStatsOverview::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->sidebarCollapsibleOnDesktop()
            ->plugins([
                ActivitylogPlugin::make(),
                FilamentApexChartsPlugin::make(),
            ]);;
    }
}
