<?php

namespace App\Filament\Resources\SuratPulangResource\Pages;

use App\Filament\Resources\SuratPulangResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSuratPulang extends EditRecord
{
    protected static string $resource = SuratPulangResource::class;
    protected static ?string $title = 'Edit Surat Pulang';

    protected function getHeaderActions(): array
{
    return [
        Actions\Action::make('hapus')
            ->label('Hapus')
            ->requiresConfirmation()
            ->action(function () {
                $record = $this->getRecord();
                if ($record) {
                    $record->delete();
                    $this->redirect(static::getResource()::getUrl('index'));
                }
            }),
    ];
}
}
