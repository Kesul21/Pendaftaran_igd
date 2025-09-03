<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PasienResource\Pages;
use App\Filament\Resources\PasienResource\RelationManagers;
use App\Models\Pasien;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Actions\Action;

use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;

class PasienResource extends Resource
{
    protected static ?string $model = Pasien::class;
    protected static ?string $navigationLabel = 'Pasien';
    protected static ?string $pluralModelLabel = 'Pasien';
    protected static ?string $label = 'Pasien';
    protected static ?string $navigationGroup = 'Admin IGD';
    protected static ?string $navigationIcon = 'heroicon-o-users';

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
        return $form->schema([
            Forms\Components\TextInput::make('nama')->required(),
            Forms\Components\TextInput::make('nik')
                ->required()
                ->unique(ignoreRecord: true),
            Forms\Components\Select::make('jenis_kelamin')
                ->options([
                    'L' => 'Laki-laki',
                    'P' => 'Perempuan',
                ])->required(),
            Forms\Components\DatePicker::make('tanggal_lahir')->required(),
            Forms\Components\TextInput::make('no_hp'),
            Forms\Components\Textarea::make('alamat'),
            Forms\Components\Select::make('jenis_pembayaran')
                ->options([
                    'Bpjs' => 'BPJS',
                    'Umum' => 'Umum',
                ])->default('Umum'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('No')
                    ->rowIndex(),
                Tables\Columns\TextColumn::make('no_rekam_medis')
                    ->label('No Rekam Medis')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama'),
                Tables\Columns\TextColumn::make('nik'),
                Tables\Columns\TextColumn::make('jenis_kelamin'),
                Tables\Columns\TextColumn::make('tanggal_lahir')->date(),
                Tables\Columns\TextColumn::make('no_hp'),
                Tables\Columns\TextColumn::make('alamat')->limit(50),
                Tables\Columns\TextColumn::make('jenis_pembayaran'),
            ])
            ->headerActions([
                Action::make('Export PDF')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->url(route('pasien.export.pdf'))
                    ->openUrlInNewTab(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPasiens::route('/'),
            'create' => Pages\CreatePasien::route('/create'),
            'edit' => Pages\EditPasien::route('/{record}/edit'),
        ];
    }

   
}