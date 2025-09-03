<?php

namespace App\Filament\Resources\PendaftaranIGDResource\Pages;

use App\Filament\Resources\PendaftaranIGDResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePendaftaranIGD extends CreateRecord
{
    protected static string $resource = PendaftaranIGDResource::class;
    protected static ?string $title = 'Buat Pendaftaran IGD';
    
}
