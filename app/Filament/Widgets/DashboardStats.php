<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Pasien;
use App\Models\PenempatanKamar;
use App\Models\PermintaanRawatInap;

class DashboardStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('🧑 Pasien IGD', Pasien::count())
                ->description('Total pasien terdaftar')
                ->color('info')
                ->icon('heroicon-o-user'),

            Stat::make('🏥 Dirawat Inap', PenempatanKamar::where('status', 'Aktif')->count())
    ->description('Pasien sedang dirawat')
    ->color('success')
    ->icon('heroicon-o-building-office'), // ✅ ikon valid

            Stat::make('📋 Permintaan Rawat Inap', PermintaanRawatInap::count())
                ->description('Permintaan aktif')
                ->color('warning')
                ->icon('heroicon-o-clipboard-document'),
        ];
    }
}
