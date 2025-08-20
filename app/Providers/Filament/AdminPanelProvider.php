<?php

namespace App\Providers\Filament;

use Filament\Pages\Dashboard;
use Filament\Widgets\AccountWidget;
use A21ns1g4ts\FilamentShortUrl\FilamentShortUrlPlugin;
use A21ns1g4ts\FilamentShortUrl\Filament\Resources\ShortUrlResource\Widgets\ShortUrlStats;
use App\Filament\Resources\Events\Widgets\EventStats;
use App\Filament\Resources\Users\Widgets\UserStats;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use LaraZeus\Sky\SkyPlugin;
use LaraZeus\SpatieTranslatable\SpatieTranslatablePlugin;
use SolutionForest\FilamentTranslateField\FilamentTranslateFieldPlugin;

// use Outerweb\FilamentTranslatableFields\Filament\Plugins\FilamentTranslatableFieldsPlugin;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->databaseNotifications()
            ->widgets([
                AccountWidget::class,
                // ShortUrlStats::class,
                UserStats::class,
                EventStats::class,
                // Widgets\FilamentInfoWidget::class,
            ])
            ->plugins(
                [
                    // FilamentShortUrlPlugin::make()
                    SpatieTranslatablePlugin::make()
                     ->defaultLocales(['en' ,'it']),
                     SkyPlugin::make()->navigationGroupLabel('CMS')
                ]
            )
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
            ]);
    }
}
