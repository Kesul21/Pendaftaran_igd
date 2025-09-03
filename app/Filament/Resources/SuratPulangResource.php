<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SuratPulangResource\Pages;
use App\Filament\Resources\SuratPulangResource\RelationManagers;
use App\Models\SuratPulang;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SuratPulangResource extends Resource
{
    protected static ?string $model = SuratPulang::class;
    protected static ?string $navigationLabel = 'Surat Pulang';

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
           Forms\Components\Select::make('penempatan_kamar_id')
    ->label('Nama Pasien')
    ->relationship('penempatanKamar', 'id')
    ->getOptionLabelFromRecordUsing(fn ($record) => 
        $record->permintaanRawatInap?->pendaftaranIgd?->pasien?->nama ?? 'Tidak ditemukan'
    )
    ->searchable()
    ->preload()
    ->required(),
                
                Forms\Components\DatePicker::make('tanggal_pulang')->required(),
                Forms\Components\TextInput::make('diagnosa')->required(),
                Forms\Components\TextInput::make('tindakan')->required(),
                Forms\Components\TextInput::make('nama_petugas')->required(),
                Forms\Components\TextInput::make('nip_petugas')
                    ->label('NIP Petugas')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('No Surat')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('penempatanKamar.permintaanRawatInap.pendaftaranIgd.pasien.nama')
                    ->label('Nama Pasien')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('tanggal_pulang')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('diagnosa')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('tindakan')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_petugas')
                    ->sortable(),
                Tables\Columns\TextColumn::make('nip_petugas')
                    ->label('NIP Petugas')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(fn ($state) => $state ?? '-'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('cetak')
                    ->label('Cetak Surat Pulang')
                    ->url(fn (SuratPulang $record): string => route('surat.pulang.cetak', ['id' => $record->id]))
                    ->icon('heroicon-o-printer')
                    ->openUrlInNewTab(),
                
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->successNotificationTitle('Surat Pulang berhasil dihapus')
                        ->deselectRecordsAfterCompletion(),
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
            'index' => Pages\ListSuratPulangs::route('/'),
            'create' => Pages\CreateSuratPulang::route('/create'),
            'edit' => Pages\EditSuratPulang::route('/{record}/edit'),
        ];
    }
}
