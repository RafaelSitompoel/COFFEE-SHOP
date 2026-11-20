<?php

namespace App\Filament\Barista\Widgets;

use App\Filament\Barista\Resources\BaristaOrderResource;
use App\Models\Order;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class BaristaActiveOrdersWidget extends BaseWidget
{
    protected static ?string $heading = '☕ Tiket Antrean Bar Kopi (Harus Diseduh)';

    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Order::query()
                    ->whereIn('status', ['Pending', 'Processing'])
                    ->latest('created_at')
            )
            ->columns([
                Tables\Columns\TextColumn::make('invoice_number')
                    ->label('Invoice')
                    ->weight('bold')
                    ->url(fn (Order $record): string => BaristaOrderResource::getUrl('edit', ['record' => $record])),

                Tables\Columns\TextColumn::make('customer_name')
                    ->label('Pelanggan'),

                Tables\Columns\TextColumn::make('items_summary')
                    ->label('Menu Kopi yang Harus Dibuat')
                    ->getStateUsing(function (Order $record): string {
                        return $record->items->map(fn ($i) => "{$i->quantity}x {$i->product_name}")->join(', ');
                    })
                    ->wrap(),

                Tables\Columns\TextColumn::make('notes')
                    ->label('Catatan Racikan')
                    ->placeholder('Normal')
                    ->color('warning'),

                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'warning' => 'Pending',
                        'info' => 'Processing',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'Pending' => '⏳ Menunggu',
                        'Processing' => '☕ Sedang Diseduh',
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
