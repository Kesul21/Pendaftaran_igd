<?php

namespace App\Filament\Resources\PermintaanRawatInapResource\Pages;

use App\Filament\Resources\PermintaanRawatInapResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePermintaanRawatInap extends CreateRecord
{
    protected static string $resource = PermintaanRawatInapResource::class;
    protected static ?string $title = 'Buat Permintaan Rawat Inap';
}
