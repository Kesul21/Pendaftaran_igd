<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('admin')
            ->path('admin')
            ->login()

            // ✅ BRAND NAME DINAMIS SESUAI TIPE ADMIN
            ->brandName(function () {
                if (auth()->check()) {
                    return match (auth()->user()->tipe_admin) {
                        'igd' => 'Dashboard IGD',
                        'rawat' => 'Dashboard Rawat Inap',
                        default => 'Admin Panel',
                    };
                }

                return 'Admin Panel';
            })

            // ✅ LOGO KUSTOM (jika ada)
            ->brandLogo(fn () => view('filament.components.logo'))

            // ✅ FAVICON (opsional, pastikan logo.png tersedia)
            ->favicon(asset('logo.png'))

            // ✅ WARNA DINAMIS SESUAI TIPE ADMIN
            ->colors(function () {
                if (auth()->check()) {
                    return match (auth()->user()->tipe_admin) {
                        'igd' => ['primary' => Color::Rose],
                        'rawat' => ['primary' => Color::Blue],
                        default => ['primary' => Color::Gray],
                    };
                }

                return ['primary' => Color::Gray];
            })

            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')

            ->pages([
                Pages\Dashboard::class,
            ])

            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                // Tambahkan widget di sini jika ada
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
            ]);
    }
}
