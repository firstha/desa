<?php

namespace App\Filament\Resources\WargaResource\Pages;

use Filament\Actions;
use App\Filament\Resources\WargaResource;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\WargaResource\Widgets\WargaChart;

class ListWargas extends ListRecords
{
    protected static string $resource = WargaResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            WargaChart::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
