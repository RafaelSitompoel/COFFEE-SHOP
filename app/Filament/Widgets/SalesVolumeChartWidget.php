<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class SalesVolumeChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Grafik Jumlah Pesanan (7 Hari Terakhir)';

    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $days = collect(range(6, 0))->map(function ($daysAgo) {
            return Carbon::today()->subDays($daysAgo);
        });

        $labels = $days->map(fn ($date) => $date->format('d M'))->toArray();

        $data = $days->map(function ($date) {
            return Order::whereDate('order_date', $date)->count();
        })->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Pesanan',
                    'data' => $data,
                    'backgroundColor' => '#78350f',
                    'borderRadius' => 6,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
