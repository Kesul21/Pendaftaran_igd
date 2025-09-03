<?php

namespace App\Filament\Resources\PendaftaranIGDResource\Pages;

use App\Filament\Resources\PendaftaranIGDResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPendaftaranIGD extends EditRecord
{
    protected static string $resource = PendaftaranIGDResource::class;
    protected static ?string $title = 'Edit Pendaftaran IGD';
    

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
