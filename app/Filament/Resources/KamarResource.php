<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KamarResource\Pages;
use App\Filament\Resources\KamarResource\RelationManagers;
use App\Models\Kamar;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Model;
class KamarResource extends Resource
{
    protected static ?string $model = Kamar::class;
    protected static ?string $navigationLabel = 'Kamar';
    protected static ?string $pluralModelLabel = 'Kamar';
    protected static ?string $label = 'Kamar';
    protected static ?string $navigationGroup = 'Admin Rawat Inap';

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

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
                Forms\Components\TextInput::make('nama')->required(),
                Forms\Components\TextInput::make('kode_kamar')->required(),
                Forms\Components\Select::make('kelas')
                    ->options([
                        'VIP'      => 'VIP',
                        'Kelas 1'  => 'Kelas 1',
                        'Kelas 2'  => 'Kelas 2',
                        'Kelas 3'  => 'Kelas 3',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('kapasitas')
                    ->numeric()
                    ->required(),
                    Forms\Components\TextInput::make('kapasitas_tersedia')
    ->numeric()
    ->label('Kapasitas Tersedia')
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
                Tables\Columns\TextColumn::make('nama'),
                Tables\Columns\TextColumn::make('kode_kamar'),
                Tables\Columns\TextColumn::make('kelas'),
                Tables\Columns\TextColumn::make('kapasitas'),
                Tables\Columns\TextColumn::make('kapasitas_tersedia')
                    ->label('Kapasitas Tersedia'),
            
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListKamars::route('/'),
            'create' => Pages\CreateKamar::route('/create'),
            'edit'   => Pages\EditKamar::route('/{record}/edit'),
        ];
    }



}