<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PenempatanKamarResource\Pages;
use App\Filament\Resources\PenempatanKamarResource\RelationManagers;
use App\Models\PenempatanKamar;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PenempatanKamarResource extends Resource
{
    protected static ?string $model = PenempatanKamar::class;
    
    protected static ?string $navigationLabel = 'Penempatan Kamar';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    public static function canViewNavigation(): bool
{
    return auth()->user()?->tipe_admin === 'rawat';
}

public static function getNavigationGroup(): ?string
{
    return auth()->user()?->tipe_admin === 'rawat' ? 'Admin Rawat Inap' : null;
}
public static function shouldRegisterNavigation(): bool
{
    return auth()->user()?->tipe_admin === 'rawat';
}


    public static function form(Form $form): Form
{
    return $form
        ->schema([
            Forms\Components\Select::make('permintaan_rawat_inap_id')
                ->relationship('permintaanRawatInap', 'id')
                ->label('Permintaan Rawat Inap')
                ->searchable()
                ->preload()
                ->required()
                ->afterStateUpdated(function ($state, callable $set) {
                    $permintaan = \App\Models\PermintaanRawatInap::with('pendaftaranIgd.pasien')->find($state);
                    if ($permintaan && $permintaan->pendaftaranIgd && $permintaan->pendaftaranIgd->pasien) {
                        $set('nama_pasien', $permintaan->pendaftaranIgd->pasien->nama);
                     } else {
            $set('nama_pasien', 'Tidak ditemukan');
        }
    }),


            Forms\Components\TextInput::make('nama_pasien')
                ->label('Nama Pasien')
                ->disabled()
                ->dehydrated(false),

            Forms\Components\Select::make('kamar_id')
                ->label('Kamar')
                ->relationship('kamar', 'nama', function ($query) {
                    return $query->where('kapasitas_tersedia', '>', 0);
                })
                ->required(),

            Forms\Components\TextInput::make('nomor_tempat_tidur')
                ->required(),

            Forms\Components\DateTimePicker::make('tanggal_masuk')
                ->required(),

            Forms\Components\Select::make('status')
                ->options([
                    'Aktif'   => 'Aktif',
                    'Selesai' => 'Selesai',
                ])
                ->required(),
        ]);
}

    public static function table(Table $table): Table
{
    return $table
        ->columns([
            
            Tables\Columns\TextColumn::make('no')
                ->label('No')
                ->rowIndex(),
            Tables\Columns\TextColumn::make('permintaanRawatInap.pendaftaranIgd.pasien.nama')->label('Nama Pasien'),
            Tables\Columns\TextColumn::make('kamar.nama')->label('Kamar'),
            Tables\Columns\TextColumn::make('nomor_tempat_tidur'),
            Tables\Columns\TextColumn::make('tanggal_masuk')->dateTime(),
            Tables\Columns\TextColumn::make('status'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('print')
    ->label('Cetak Surat')
    ->icon('heroicon-o-printer')
    ->url(fn ($record) => route('print.permintaan-rawat-inap', $record->permintaan_rawat_inap_id))
    ->openUrlInNewTab(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPenempatanKamars::route('/'),
            'create' => Pages\CreatePenempatanKamar::route('/create'),
            'edit' => Pages\EditPenempatanKamar::route('/{record}/edit'),
        ];
    }


}
