<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PermintaanRawatInapResource\Pages;
use App\Filament\Resources\PermintaanRawatInapResource\RelationManagers;
use App\Models\PermintaanRawatInap;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Model;
class PermintaanRawatInapResource extends Resource
{
    protected static ?string $model = PermintaanRawatInap::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox';

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
                Forms\Components\Select::make('pendaftaran_igd_id')
                    ->relationship('pendaftaranIgd', 'id')
                    ->required(),
                Forms\Components\DateTimePicker::make('waktu_permintaan')->required(),
                Forms\Components\Select::make('status')
                    ->options([
                        'Menunggu'   => 'Menunggu',
                        'Disetujui'  => 'Disetujui',
                        'Ditolak'    => 'Ditolak',
                    ])
                    ->required(),
                Forms\Components\Textarea::make('catatan'),
            ]);
    }

    public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\TextColumn::make('id')
                ->label('No')
                ->rowIndex(),
            Tables\Columns\TextColumn::make('pendaftaranIgd.pasien.nama')->label('Nama Pasien'),
            Tables\Columns\TextColumn::make('waktu_permintaan')->dateTime(),
            Tables\Columns\TextColumn::make('status'),
        ])
        ->actions([
            Tables\Actions\Action::make('kirimKamar')
                ->label('Tempatkan Kamar')
                ->icon('heroicon-o-home')
                ->url(fn (PermintaanRawatInap $record) =>
                    \App\Filament\Resources\PenempatanKamarResource::getUrl('create') . '?prefill[permintaan_rawat_inap_id]=' . $record->id
                )
                ->color('success'),
        ])
        ->filters([
            //
        ]);
}


    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListPermintaanRawatInaps::route('/'),
            'create' => Pages\CreatePermintaanRawatInap::route('/create'),
            'edit'   => Pages\EditPermintaanRawatInap::route('/{record}/edit'),
        ];
    }


}