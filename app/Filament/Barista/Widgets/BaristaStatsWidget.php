<?php

namespace App\Filament\Barista\Widgets;

use App\Models\Order;
use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class BaristaStatsWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $pendingCount = Order::where('status', 'Pending')->count();
        $processingCount = Order::where('status', 'Processing')->count();
        $shippedCount = Order::where('status', 'Shipped')->count();
        $completedToday = Order::where('status', 'Completed')->whereDate('updated_at', today())->count();
        $outOfStockCount = Product::where('status', 'out_of_stock')->orWhere('stock', '<=', 0)->count();

        return [
            Stat::make('Antrean Masuk', $pendingCount)
                ->description('Menunggu diracik barista')
                ->descriptionIcon('heroicon-m-clock')
                ->color($pendingCount > 0 ? 'warning' : 'gray'),

            Stat::make('Sedang Diseduh', $processingCount)
                ->description('Dalam proses peracikan')
                ->descriptionIcon('heroicon-m-beaker')
                ->color($processingCount > 0 ? 'info' : 'gray'),

            Stat::make('Siap / Diantar Gojek', $shippedCount)
                ->description('Menuju pelanggan')
                ->descriptionIcon('heroicon-m-truck')
                ->color('primary'),

            Stat::make('Selesai Hari Ini', $completedToday)
                ->description('Kopi sukses disajikan')
                ->descriptionIcon('heroicon-m-check-badge')
                ->color('success'),
        ];
    }
}
