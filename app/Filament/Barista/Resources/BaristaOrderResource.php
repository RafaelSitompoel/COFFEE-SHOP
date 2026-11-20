<?php

namespace App\Filament\Barista\Resources;

use App\Filament\Barista\Resources\BaristaOrderResource\Pages;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BaristaOrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-beaker';

    protected static ?string $navigationLabel = 'Antrean Barista';

    protected static ?string $modelLabel = 'Pesanan Kopi';

    protected static ?string $pluralModelLabel = 'Antrean Pesanan Kopi';

    protected static ?string $slug = 'orders';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Antrean Racikan')
                    ->schema([
                        Forms\Components\TextInput::make('invoice_number')
                            ->label('Nomor Invoice')
                            ->disabled(),

                        Forms\Components\Select::make('status')
                            ->label('Status Pengerjaan Kopi')
                            ->options([
                                'Pending' => 'Pending (Menunggu Racikan)',
                                'Processing' => 'Processing (Sedang Diseduh Barista)',
                                'Shipped' => 'Shipped (Siap Diantar / Gojek)',
                                'Completed' => 'Completed (Selesai Diterima)',
                            ])
                            ->required(),

                        Forms\Components\Textarea::make('notes')
                            ->label('Catatan Khusus Pelanggan')
                            ->helperText('Perhatikan permintaan khusus seperti less sugar, no ice, dll.')
                            ->disabled()
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('Menu Kopi yang Harus Diseduh')
                    ->schema([
                        Forms\Components\Repeater::make('items')
                            ->relationship('items')
                            ->schema([
                                Forms\Components\TextInput::make('product_name')
                                    ->label('Menu Kopi')
                                    ->disabled()
                                    ->columnSpan(3),

                                Forms\Components\TextInput::make('quantity')
                                    ->label('Porsi / Cup')
                                    ->disabled()
                                    ->columnSpan(1),
                            ])
                            ->columns(4)
                            ->addable(false)
                            ->deletable(false)
                            ->reorderable(false),
                    ]),

                Forms\Components\Section::make('Kurir & Pengantaran Gojek')
                    ->schema([
                        Forms\Components\TextInput::make('courier_name')
                            ->label('Layanan')
                            ->disabled(),

                        Forms\Components\TextInput::make('driver_name')
                            ->label('Nama Driver Gojek')
                            ->disabled(),

                        Forms\Components\TextInput::make('driver_plate')
                            ->label('Plat Nomor Kendaraan')
                            ->disabled(),

                        Forms\Components\Select::make('driver_status')
                            ->label('Status Driver')
                            ->options([
                                'Driver Menuju Toko' => '🏪 Driver Menuju Toko (Jemput Kopi)',
                                'Driver Mengantar Kopi' => '🛵 Driver Sedang Mengantar Kopi',
                                'Tiba di Lokasi' => '📍 Tiba di Lokasi Pelanggan',
                            ]),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('invoice_number')
                    ->label('Invoice')
                    ->weight('bold')
                    ->searchable(),

                Tables\Columns\TextColumn::make('customer_name')
                    ->label('Pemesan')
                    ->description(fn (Order $record): string => $record->notes ? ('📝 ' . $record->notes) : ''),

                Tables\Columns\TextColumn::make('items_summary')
                    ->label('Menu Kopi (Cup)')
                    ->getStateUsing(function (Order $record): string {
                        return $record->items->map(fn ($i) => "{$i->quantity}x {$i->product_name}")->join(', ');
                    })
                    ->wrap(),

                Tables\Columns\TextColumn::make('order_date')
                    ->label('Waktu Masuk')
                    ->dateTime('H:i, d M')
                    ->sortable(),

                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status Seduhan')
                    ->colors([
                        'warning' => 'Pending',
                        'info' => 'Processing',
                        'primary' => 'Shipped',
                        'success' => 'Completed',
                        'danger' => 'Cancelled',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'Pending' => '⏳ Menunggu',
                        'Processing' => '☕ Sedang Diseduh',
                        'Shipped' => '🛵 Siap / Diantar',
                        'Completed' => '✅ Selesai',
                        'Cancelled' => '❌ Batal',
                        default => $state,
                    }),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Filter Status')
                    ->options([
                        'Pending' => 'Menunggu',
                        'Processing' => 'Sedang Diseduh',
                        'Shipped' => 'Siap / Diantar',
                        'Completed' => 'Selesai',
                    ]),
            ])
            ->actions([
                Tables\Actions\Action::make('start_brewing')
                    ->label('Mulai Racik')
                    ->icon('heroicon-o-beaker')
                    ->color('warning')
                    ->visible(fn (Order $record): bool => $record->status === 'Pending')
                    ->action(function (Order $record) {
                        $record->update(['status' => 'Processing']);
                        Notification::make()
                            ->title('Mulai Seduh')
                            ->body("Pesanan {$record->invoice_number} mulai diracik.")
                            ->warning()
                            ->send();
                    }),

                Tables\Actions\Action::make('ready_for_pickup')
                    ->label('Siap / Panggil Gojek')
                    ->icon('heroicon-o-truck')
                    ->color('primary')
                    ->visible(fn (Order $record): bool => $record->status === 'Processing')
                    ->action(function (Order $record) {
                        $record->update([
                            'status' => 'Shipped',
                            'driver_name' => $record->driver_name ?? 'Surya Pratama (Gojek Siantar)',
                            'driver_phone' => $record->driver_phone ?? '082168923344',
                            'driver_plate' => $record->driver_plate ?? 'BK 4218 WAB (Honda Vario)',
                            'driver_status' => 'Driver Mengantar Kopi',
                        ]);
                        Notification::make()
                            ->title('Kopi Siap!')
                            ->body("Kopi telah selesai diseduh dan diserahkan ke kurir Gojek.")
                            ->info()
                            ->send();
                    }),

                Tables\Actions\Action::make('mark_completed')
                    ->label('Selesai')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn (Order $record): bool => $record->status === 'Shipped')
                    ->action(function (Order $record) {
                        $record->update([
                            'status' => 'Completed',
                            'payment_status' => 'Paid',
                        ]);
                        Notification::make()
                            ->title('Pesanan Selesai')
                            ->body("Pesanan {$record->invoice_number} selesai sepenuhnya.")
                            ->success()
                            ->send();
                    }),

                Tables\Actions\Action::make('print_struk')
                    ->label('Struk')
                    ->icon('heroicon-o-receipt-percent')
                    ->color('gray')
                    ->url(fn (Order $record): string => route('order.struk', $record->invoice_number))
                    ->openUrlInNewTab(),

                Tables\Actions\EditAction::make()
                    ->label('Detail'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBaristaOrders::route('/'),
            'edit' => Pages\EditBaristaOrder::route('/{record}/edit'),
        ];
    }
}
