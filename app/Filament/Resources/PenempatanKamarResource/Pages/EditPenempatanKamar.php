<?php

namespace App\Filament\Resources\PenempatanKamarResource\Pages;

use App\Filament\Resources\PenempatanKamarResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;

use App\Models\SuratPulang;

class EditPenempatanKamar extends EditRecord
{
    protected static string $resource = PenempatanKamarResource::class;
    protected static ?string $title = 'Edit Penempatan Kamar';

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('buatSuratPulang')
                ->label('Buat Surat Pulang')
                ->action(function () {
                    $penempatanKamar = $this->getRecord();

                    SuratPulang::create([
                        'penempatan_kamar_id' => $penempatanKamar->id,
                        'tanggal_pulang' => now(),
                        'diagnosa' => '',
                        'tindakan' => '',
                        'nama_petugas' => auth()->user()->name,
                        'nip_petugas' =>'',
                    ]);

                    Notification::make()
                        ->title('Berhasil')
                        ->body('Surat Pulang berhasil dibuat.')
                        ->success()
                        ->send();
                })
                ->requiresConfirmation(),
        ];
    }
}
