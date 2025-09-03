<?php

namespace App\Filament\Resources\PendaftaranIGDResource\Pages;

use App\Filament\Resources\PendaftaranIGDResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPendaftaranIGDS extends ListRecords
{
    protected static string $resource = PendaftaranIGDResource::class;
    protected static ?string $title = 'Daftar Pendaftaran IGD';   

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
