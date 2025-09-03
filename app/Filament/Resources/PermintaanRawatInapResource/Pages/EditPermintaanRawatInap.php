<?php

namespace App\Filament\Resources\PermintaanRawatInapResource\Pages;

use App\Filament\Resources\PermintaanRawatInapResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPermintaanRawatInap extends EditRecord
{
    protected static string $resource = PermintaanRawatInapResource::class;
    protected static ?string $title = 'Edit Permintaan Rawat Inap';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
