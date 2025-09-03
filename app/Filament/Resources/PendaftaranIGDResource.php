<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PendaftaranIGDResource\Pages;
use App\Filament\Resources\PendaftaranIGDResource\RelationManagers;
use App\Models\PendaftaranIGD;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Actions\Action;
use App\Models\PermintaanRawatInap;


class PendaftaranIgdResource extends Resource
{
    protected static ?string $model = PendaftaranIgd::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Pendaftaran IGD';
    protected static ?string $pluralModelLabel = 'Pendaftaran IGD';
    protected static ?string $label = 'Pendaftaran IGD';

    public static function canViewNavigation(): bool
{
    return auth()->user()?->tipe_admin === 'igd';
}

public static function getNavigationGroup(): ?string
{
    return auth()->user()?->tipe_admin === 'igd' ? 'Admin IGD' : null;
}
   
 public static function shouldRegisterNavigation(): bool
{
    return auth()->user()?->tipe_admin === 'igd';
}   

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('pasiens_id')
                    ->relationship('pasien', 'nama')
                    ->required(),
                Forms\Components\DateTimePicker::make('waktu_daftar')->required(),
                Forms\Components\Textarea::make('keluhan'),
                Forms\Components\Textarea::make('diagnosa'),
                Forms\Components\Select::make('status')
                    ->options([
                        'Menunggu'    => 'Menunggu',
                        'Dirawat'     => 'Dirawat',
                        'Dipindahkan' => 'Dipindahkan',
                        'Pulang'      => 'Pulang',
                    ])
                    ->required(),
            ]);
    }

   public static function table(Table $table): Table
{
    return $table
        ->columns([
             Tables\Columns\TextColumn::make('id')
                ->label('No')
                ->rowIndex(),
            Tables\Columns\TextColumn::make('pasien.nama')->label('Nama Pasien'),
            Tables\Columns\TextColumn::make('waktu_daftar')->dateTime(),
            Tables\Columns\TextColumn::make('keluhan')->label('Keluhan'),
            Tables\Columns\TextColumn::make('diagnosa')->label('Diagnosa'),
            Tables\Columns\TextColumn::make('status'),
        ])
        ->actions([
            Action::make('kirimRawatInap')
                ->label('Kirim ke Rawat Inap')
                ->icon('heroicon-o-arrow-right')
                ->action(function (PendaftaranIgd $record) {
                    // Cek apakah sudah ada permintaan rawat inap untuk pendaftaran ini
                    $existing = PermintaanRawatInap::where('pendaftaran_igd_id', $record->id)->first();
                    if ($existing) {
                        session()->flash('error', 'Sudah ada permintaan rawat inap untuk pendaftaran ini.');
                        return;
                    }

                    // Buat data permintaan rawat inap baru
                    PermintaanRawatInap::create([
                    'pendaftaran_igd_id' => $record->id,
                    'waktu_permintaan' => now(),
                    'status' => 'Menunggu',
                    'catatan' => 'Dibuat otomatis dari Pendaftaran IGD',
                ]);

                    session()->flash('success', 'Permintaan rawat inap berhasil dibuat.');
                })
                ->requiresConfirmation()
                ->color('success'),
        ])
        ->filters([
            //
        ]);
}

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListPendaftaranIgds::route('/'),
            'create' => Pages\CreatePendaftaranIgd::route('/create'),
            'edit'   => Pages\EditPendaftaranIgd::route('/{record}/edit'),
        ];
    }

}