<?php

namespace App\Filament\Widgets;

use App\Models\OrderItem;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\DB;

class TopProductsWidget extends BaseWidget
{
    protected static ?string $heading = '☕ Produk Terlaris';

    protected static ?int $sort = 4;

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                OrderItem::query()
                    ->select(
                        DB::raw('MIN(id) as id'),
                        'product_name',
                        DB::raw('SUM(quantity) as total_sold'),
                        DB::raw('SUM(subtotal) as total_revenue')
                    )
                    ->groupBy('product_name')
                    ->orderByDesc('total_sold')
                    ->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('product_name')
                    ->label('Nama Menu Kopi')
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('total_sold')
                    ->label('Terjual')
                    ->badge()
                    ->color('success')
                    ->formatStateUsing(fn ($state) => $state . ' Porsi'),

                Tables\Columns\TextColumn::make('total_revenue')
                    ->label('Total Omset')
                    ->money('IDR', locale: 'id')
                    ->weight('bold'),
            ])
            ->paginated(false);
    }

    public function getTableRecordKey($record): string
    {
        return (string) ($record->id ?? $record->product_name ?? uniqid());
    }
}
