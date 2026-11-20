<?php

namespace App\Filament\Widgets;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $totalRevenue = Order::where('payment_status', 'Paid')->sum('total_amount');
        $totalOrders = Order::count();
        $totalProducts = Product::where('status', 'active')->count();
        $totalCustomers = Customer::count();

        // Calculate pending orders
        $pendingOrders = Order::where('status', 'Pending')->count();

        return [
            Stat::make('Total Pendapatan', 'Rp ' . number_format($totalRevenue, 0, ',', '.'))
                ->description('Dari seluruh pesanan lunas')
                ->descriptionIcon('heroicon-m-banknotes')
                ->chart([15, 25, 20, 35, 45, 60, 75])
                ->color('success'),

            Stat::make('Total Pesanan', number_format($totalOrders, 0, ',', '.'))
                ->description($pendingOrders . ' pesanan menunggu')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->chart([5, 8, 12, 10, 15, 18, 22])
                ->color('amber'),

            Stat::make('Produk Aktif', number_format($totalProducts, 0, ',', '.'))
                ->description('Menu siap dipesan')
                ->descriptionIcon('heroicon-m-beaker')
                ->color('primary'),

            Stat::make('Total Pelanggan', number_format($totalCustomers, 0, ',', '.'))
                ->description('Pelanggan terdaftar')
                ->descriptionIcon('heroicon-m-user-group')
                ->chart([2, 4, 6, 8, 10, 14, 18])
                ->color('info'),
        ];
    }
}
