<?php

namespace App\Filament\Resources\SuratPulangResource\Pages;

use App\Filament\Resources\SuratPulangResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSuratPulang extends CreateRecord
{
    protected static string $resource = SuratPulangResource::class;
    protected static ?string $title = 'Buat Surat Pulang';
    
}
