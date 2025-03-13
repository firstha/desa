<?php

namespace App\Filament\Resources\WargaResource\Widgets;

use Filament\Widgets\BarChartWidget;
use App\Models\Warga;

class WargaChart extends BarChartWidget
{
    protected static ?string $heading = 'Data Warga';

    protected function getData(): array
    {
        $jumlahLaki = Warga::where('jenis_kelamin', 0)->count();
        $jumlahPerempuan = Warga::where('jenis_kelamin', 1)->count();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Warga',
                    'data' => [$jumlahLaki, $jumlahPerempuan],
                    'backgroundColor' => ['#4CAF50', '#2196F3'], 
                ],
            ],
            'labels' => ['Laki-laki', 'Perempuan'],
        ];
    }
}
