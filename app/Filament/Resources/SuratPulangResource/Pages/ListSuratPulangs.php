<?php

namespace App\Filament\Resources\SuratPulangResource\Pages;

use App\Filament\Resources\SuratPulangResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSuratPulangs extends ListRecords
{
    protected static string $resource = SuratPulangResource::class;
    protected static ?string $title = 'Daftar Surat Pulang';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
