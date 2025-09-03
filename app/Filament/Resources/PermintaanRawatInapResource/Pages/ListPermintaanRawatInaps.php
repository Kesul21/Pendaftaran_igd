<?php

namespace App\Filament\Resources\PermintaanRawatInapResource\Pages;

use App\Filament\Resources\PermintaanRawatInapResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPermintaanRawatInaps extends ListRecords
{
    protected static string $resource = PermintaanRawatInapResource::class;
    protected static ?string $title = 'Daftar Permintaan Rawat Inap';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
