<?php

namespace App\Filament\Resources\PenempatanKamarResource\Pages;

use App\Filament\Resources\PenempatanKamarResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPenempatanKamars extends ListRecords
{
    protected static string $resource = PenempatanKamarResource::class;
    protected static ?string $title = 'Daftar Penempatan Kamar';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
