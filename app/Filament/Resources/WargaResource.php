<?php

namespace App\Filament\Resources;

use Carbon\Carbon;
use Filament\Forms;
use Filament\Tables;
use App\Models\Agama;
use App\Models\Warga;
use Filament\Forms\Form;
use App\Models\Pekerjaan;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Filament\Resources\WargaResource\Pages;
use App\Filament\Resources\WargaResource\Widgets\WargaChart;

class WargaResource extends Resource
{
    protected static ?string $model = Warga::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getWidgets(): array
{
    return [
        \App\Filament\Resources\WargaResource\Widgets\WargaChart::class,
    ];
}


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\TextInput::make('nama_depan')
                            ->label('Nama Depan')
                            ->required(),

                        Forms\Components\TextInput::make('nama_belakang')
                            ->label('Nama Belakang')
                            ->required(),

                        Forms\Components\TextInput::make('tempat_lahir')
                            ->label('Tempat Lahir')
                            ->required(),

                        Forms\Components\DateTimePicker::make('tanggal_lahir')
                            ->label('Tanggal Lahir')
                            ->required(),

                        Forms\Components\Radio::make('jenis_kelamin')
                            ->label('Jenis Kelamin')
                            ->options([
                                0 => 'Laki-laki',
                                1 => 'Perempuan',
                            ])
                            ->required()
                            ->default(0),

                        Forms\Components\Select::make('agama_id')
                            ->label('Agama')
                            ->relationship('agama', 'nama_agama')
                            ->required(),

                        Forms\Components\Select::make('pekerjaan_id')
                            ->label('Pekerjaan')
                            ->relationship('pekerjaan', 'nama_pekerjaan')
                            ->required(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_depan')->label('Nama Depan'),
                Tables\Columns\TextColumn::make('nama_belakang')->label('Nama Belakang'),
                Tables\Columns\TextColumn::make('tempat_lahir')->label('Tempat Lahir'),
                Tables\Columns\TextColumn::make('tanggal_lahir')
                ->label('Tanggal Lahir')
                ->formatStateUsing(fn ($state) => Carbon::parse($state)->format('d-m-Y'))
                ->sortable(),
                Tables\Columns\TextColumn::make('jenis_kelamin')
                ->label('Jenis Kelamin')
                ->formatStateUsing(fn ($state) => $state == 0 ? 'Laki-laki' : 'Perempuan'),
                Tables\Columns\TextColumn::make('agama.nama_agama')->label('Agama'),
                Tables\Columns\TextColumn::make('pekerjaan.nama_pekerjaan')->label('Pekerjaan'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWargas::route('/'),
            'create' => Pages\CreateWarga::route('/create'),
            'edit' => Pages\EditWarga::route('/{record}/edit'),
        ];
    }
}
