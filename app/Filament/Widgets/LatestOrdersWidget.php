<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\OrderResource;
use App\Models\Order;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestOrdersWidget extends BaseWidget
{
    protected static ?string $heading = '📦 Pesanan Terbaru Masuk';

    protected static ?int $sort = 5;

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Order::query()->latest('created_at')->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('invoice_number')
                    ->label('Invoice')
                    ->weight('bold')
                    ->url(fn (Order $record): string => OrderResource::getUrl('edit', ['record' => $record])),

                Tables\Columns\TextColumn::make('customer_name')
                    ->label('Pelanggan')
                    ->description(fn (Order $record): string => $record->customer_phone ?? ''),

                Tables\Columns\TextColumn::make('order_date')
                    ->label('Waktu')
                    ->dateTime('d M Y, H:i'),

                Tables\Columns\TextColumn::make('total_amount')
                    ->label('Total')
                    ->money('IDR', locale: 'id')
                    ->weight('bold'),

                Tables\Columns\BadgeColumn::make('payment_status')
                    ->label('Status Bayar')
                    ->colors([
                        'warning' => 'Unpaid',
                        'success' => 'Paid',
                        'danger' => 'Failed',
                        'info' => 'Refunded',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'Unpaid' => 'Belum Bayar',
                        'Paid' => 'Lunas',
                        'Failed' => 'Gagal',
                        'Refunded' => 'Dikembalikan',
                        default => $state,
                    }),

                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status Pesanan')
                    ->colors([
                        'warning' => 'Pending',
                        'info' => 'Processing',
                        'primary' => 'Shipped',
                        'success' => 'Completed',
                        'danger' => 'Cancelled',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'Pending' => 'Pending',
                        'Processing' => 'Diproses',
                        'Shipped' => 'Dikirim',
                        'Completed' => 'Selesai',
                        'Cancelled' => 'Dibatalkan',
                        default => $state,
                    }),
            ])
            ->paginated(false);
    }

    public function getTableRecordKey($record): string
    {
        return (string) ($record->id ?? $record->invoice_number ?? uniqid());
    }
}
