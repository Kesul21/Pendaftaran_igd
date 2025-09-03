<?php

namespace App\Filament\Resources\PenempatanKamarResource\Pages;

use App\Filament\Resources\PenempatanKamarResource;

use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreatePenempatanKamar extends CreateRecord
{
    protected static string $resource = PenempatanKamarResource::class;
    protected static ?string $title = 'Buat Penempatan Kamar';

    public function mount(): void
    {
        parent::mount();

        // Ambil parameter dari URL jika ada
        $permintaanId = request()->get('permintaan_rawat_inap_id');

        if ($permintaanId) {
            $this->form->fill([
                'permintaan_rawat_inap_id' => $permintaanId,
            ]);
        }
    }
}

