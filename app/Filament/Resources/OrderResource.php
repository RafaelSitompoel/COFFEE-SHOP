<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $navigationGroup = 'Transaksi & Penjualan';

    protected static ?int $navigationSort = 1;

    protected static ?string $modelLabel = 'Pesanan';

    protected static ?string $pluralModelLabel = 'Daftar Pesanan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Informasi Transaksi')
                            ->schema([
                                Forms\Components\TextInput::make('invoice_number')
                                    ->label('Nomor Invoice')
                                    ->disabled()
                                    ->dehydrated(false),

                                Forms\Components\DateTimePicker::make('order_date')
                                    ->label('Waktu Pemesanan')
                                    ->disabled()
                                    ->dehydrated(false),

                                Forms\Components\Select::make('status')
                                    ->label('Status Pesanan')
                                    ->options([
                                        'Pending' => 'Pending (Menunggu)',
                                        'Processing' => 'Processing (Diproses Barista)',
                                        'Shipped' => 'Shipped (Dikirim)',
                                        'Completed' => 'Completed (Selesai)',
                                        'Cancelled' => 'Cancelled (Dibatalkan)',
                                    ])
                                    ->required()
                                    ->native(false),

                                Forms\Components\Select::make('payment_status')
                                    ->label('Status Pembayaran')
                                    ->options([
                                        'Unpaid' => 'Unpaid (Belum Bayar)',
                                        'Paid' => 'Paid (Sudah Bayar)',
                                        'Failed' => 'Failed (Gagal)',
                                        'Refunded' => 'Refunded (Dikembalikan)',
                                    ])
                                    ->required()
                                    ->native(false),

                                Forms\Components\TextInput::make('payment_method')
                                    ->label('Metode Pembayaran')
                                    ->disabled()
                                    ->dehydrated(false),

                                Forms\Components\TextInput::make('total_amount')
                                    ->label('Total Transaksi')
                                    ->prefix('Rp')
                                    ->numeric()
                                    ->disabled()
                                    ->dehydrated(false),
                            ])->columns(2),

                        Forms\Components\Section::make('Daftar Produk yang Dipesan')
                            ->schema([
                                Forms\Components\Repeater::make('items')
                                    ->relationship('items')
                                    ->schema([
                                        Forms\Components\TextInput::make('product_name')
                                            ->label('Nama Produk')
                                            ->disabled()
                                            ->columnSpan(2),

                                        Forms\Components\TextInput::make('unit_price')
                                            ->label('Harga Satuan')
                                            ->prefix('Rp')
                                            ->disabled()
                                            ->columnSpan(1),

                                        Forms\Components\TextInput::make('quantity')
                                            ->label('Jumlah')
                                            ->disabled()
                                            ->columnSpan(1),

                                        Forms\Components\TextInput::make('subtotal')
                                            ->label('Subtotal')
                                            ->prefix('Rp')
                                            ->disabled()
                                            ->columnSpan(1),
                                    ])
                                    ->columns(5)
                                    ->addable(false)
                                    ->deletable(false)
                                    ->reorderable(false),
                            ]),
                    ])->columnSpan(['lg' => 2]),

                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Data Pelanggan & Pengiriman')
                            ->schema([
                                Forms\Components\TextInput::make('customer_name')
                                    ->label('Nama Pemesan')
                                    ->disabled()
                                    ->dehydrated(false),

                                Forms\Components\TextInput::make('customer_phone')
                                    ->label('Nomor WhatsApp / HP')
                                    ->disabled()
                                    ->dehydrated(false),

                                Forms\Components\Textarea::make('shipping_address')
                                    ->label('Alamat Pengiriman')
                                    ->disabled()
                                    ->dehydrated(false)
                                    ->rows(3),

                                Forms\Components\Textarea::make('notes')
                                    ->label('Catatan Pesanan')
                                    ->disabled()
                                    ->dehydrated(false)
                                    ->rows(3),
                            ]),

                        Forms\Components\Section::make('🛵 Ekspedisi & Driver Gojek')
                            ->schema([
                                Forms\Components\Select::make('courier_name')
                                    ->label('Layanan Pengiriman')
                                    ->options([
                                        'Gojek (GoSend Instant)' => '🛵 Gojek (GoSend Instant)',
                                        'Gojek (GoSend SameDay)' => '📦 Gojek (GoSend SameDay)',
                                        'Ambil di Toko' => '🏪 Pickup di Toko',
                                    ])
                                    ->default('Gojek (GoSend Instant)'),

                                Forms\Components\Select::make('driver_status')
                                    ->label('Status Driver Gojek')
                                    ->options([
                                        'Mencari Driver' => '🔍 Mencari Driver',
                                        'Driver Menuju Toko' => '🏪 Driver Menuju Toko (Jemput Kopi)',
                                        'Driver Mengantar Kopi' => '🛵 Driver Sedang Mengantar Kopi',
                                        'Tiba di Lokasi' => '📍 Tiba di Lokasi Pelanggan',
                                    ]),

                                Forms\Components\TextInput::make('driver_name')
                                    ->label('Nama Driver Gojek')
                                    ->placeholder('Contoh: Surya Pratama (Gojek Siantar)'),

                                Forms\Components\TextInput::make('driver_phone')
                                    ->label('Nomor WhatsApp Driver')
                                    ->placeholder('Contoh: 082168923344'),

                                Forms\Components\TextInput::make('driver_plate')
                                    ->label('Plat Nomor & Kendaraan')
                                    ->placeholder('Contoh: BK 4218 WAB (Vario Hitam)'),
                            ]),
                    ])->columnSpan(['lg' => 1]),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('invoice_number')
                    ->label('Invoice')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->copyable()
                    ->copyMessage('Nomor invoice disalin!'),

                Tables\Columns\TextColumn::make('customer_name')
                    ->label('Pelanggan')
                    ->searchable()
                    ->sortable()
                    ->description(fn (Order $record): string => $record->customer_phone ?? ''),

                Tables\Columns\TextColumn::make('order_date')
                    ->label('Tanggal')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),

                Tables\Columns\TextColumn::make('total_amount')
                    ->label('Total')
                    ->money('IDR', locale: 'id')
                    ->weight('bold')
                    ->sortable(),

                Tables\Columns\TextColumn::make('payment_method')
                    ->label('Metode Bayar')
                    ->badge()
                    ->color('gray'),

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
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status Pesanan')
                    ->options([
                        'Pending' => 'Pending',
                        'Processing' => 'Diproses',
                        'Shipped' => 'Dikirim',
                        'Completed' => 'Selesai',
                        'Cancelled' => 'Dibatalkan',
                    ]),

                Tables\Filters\SelectFilter::make('payment_status')
                    ->label('Status Pembayaran')
                    ->options([
                        'Unpaid' => 'Belum Bayar',
                        'Paid' => 'Lunas',
                        'Failed' => 'Gagal',
                        'Refunded' => 'Dikembalikan',
                    ]),
            ])
            ->actions([
                Tables\Actions\Action::make('mark_as_success')
                    ->label('Transaksi Berhasil')
                    ->icon('heroicon-o-check-badge')
                    ->color('success')
                    ->visible(fn (Order $record): bool => $record->status !== 'Completed' || $record->payment_status !== 'Paid')
                    ->requiresConfirmation()
                    ->modalHeading('Konfirmasi Transaksi Berhasil')
                    ->modalDescription(fn (Order $record): string => "Tandai pesanan {$record->invoice_number} sebagai BERHASIL (Selesai & Lunas)?")
                    ->modalSubmitActionLabel('Ya, Transaksi Berhasil')
                    ->action(function (Order $record) {
                        $record->update([
                            'status' => 'Completed',
                            'payment_status' => 'Paid',
                        ]);

                        if ($record->payment) {
                            $record->payment->update([
                                'payment_status' => 'Paid',
                                'payment_date' => $record->payment->payment_date ?? now(),
                            ]);
                        }

                        Notification::make()
                            ->title('Transaksi Berhasil!')
                            ->body("Pesanan {$record->invoice_number} berhasil diselesaikan & lunas.")
                            ->success()
                            ->send();
                    }),

                Tables\Actions\Action::make('process_order')
                    ->label('Mulai Racik')
                    ->icon('heroicon-o-beaker')
                    ->color('warning')
                    ->visible(fn (Order $record): bool => $record->status === 'Pending')
                    ->requiresConfirmation()
                    ->action(function (Order $record) {
                        $record->update(['status' => 'Processing']);
                        Notification::make()
                            ->title('Status Diperbarui')
                            ->body("Pesanan {$record->invoice_number} sedang diracik barista.")
                            ->info()
                            ->send();
                    }),

                Tables\Actions\Action::make('ship_order')
                    ->label('Kirim Kopi')
                    ->icon('heroicon-o-truck')
                    ->color('primary')
                    ->visible(fn (Order $record): bool => $record->status === 'Processing')
                    ->requiresConfirmation()
                    ->action(function (Order $record) {
                        $record->update(['status' => 'Shipped']);
                        Notification::make()
                            ->title('Status Diperbarui')
                            ->body("Pesanan {$record->invoice_number} sedang dikirim oleh kurir.")
                            ->info()
                            ->send();
                    }),

                Tables\Actions\Action::make('dispatch_gojek')
                    ->label('Panggil Gojek')
                    ->icon('heroicon-o-truck')
                    ->color('success')
                    ->visible(fn (Order $record): bool => in_array($record->status, ['Pending', 'Processing', 'Shipped']))
                    ->form([
                        Forms\Components\Select::make('courier_name')
                            ->label('Layanan Pengiriman')
                            ->options([
                                'Gojek (GoSend Instant)' => '🛵 Gojek (GoSend Instant)',
                                'Gojek (GoSend SameDay)' => '📦 Gojek (GoSend SameDay)',
                            ])
                            ->default('Gojek (GoSend Instant)')
                            ->required(),

                        Forms\Components\TextInput::make('driver_name')
                            ->label('Nama Driver Gojek')
                            ->default(fn () => collect([
                                'Surya Pratama (Gojek Siantar)',
                                'Budi Santoso (Gojek Siantar)',
                                'Rian Siregar (Gojek Siantar)',
                                'Dedi Kurniawan (Gojek Siantar)',
                            ])->random())
                            ->required(),

                        Forms\Components\TextInput::make('driver_phone')
                            ->label('Nomor WhatsApp Driver')
                            ->default(fn () => '0821' . rand(10000000, 99999999))
                            ->required(),

                        Forms\Components\TextInput::make('driver_plate')
                            ->label('Plat Nomor Kendaraan')
                            ->default(fn () => 'BK ' . rand(1000, 9999) . ' ' . chr(rand(65, 90)) . chr(rand(65, 90)) . ' (Honda Vario)')
                            ->required(),

                        Forms\Components\Select::make('driver_status')
                            ->label('Status Driver')
                            ->options([
                                'Driver Menuju Toko' => '🏪 Driver Menuju Toko (Jemput Kopi)',
                                'Driver Mengantar Kopi' => '🛵 Driver Sedang Mengantar ke Pelanggan',
                                'Tiba di Lokasi' => '📍 Driver Tiba di Lokasi Pelanggan',
                            ])
                            ->default('Driver Mengantar Kopi')
                            ->required(),
                    ])
                    ->action(function (Order $record, array $data) {
                        $record->update([
                            'status' => 'Shipped',
                            'courier_name' => $data['courier_name'],
                            'driver_name' => $data['driver_name'],
                            'driver_phone' => $data['driver_phone'],
                            'driver_plate' => $data['driver_plate'],
                            'driver_status' => $data['driver_status'],
                        ]);

                        Notification::make()
                            ->title('🛵 Driver Gojek Siap Berangkat!')
                            ->body("Driver {$data['driver_name']} ({$data['driver_plate']}) telah ditugaskan mengantar pesanan {$record->invoice_number}.")
                            ->success()
                            ->send();
                    }),

                Tables\Actions\Action::make('print_struk')
                    ->label('Struk PNG')
                    ->icon('heroicon-o-receipt-percent')
                    ->color('warning')
                    ->url(fn (Order $record): string => route('order.struk', $record->invoice_number))
                    ->openUrlInNewTab(),

                Tables\Actions\Action::make('print_invoice')
                    ->label('Invoice')
                    ->icon('heroicon-o-printer')
                    ->color('gray')
                    ->url(fn (Order $record): string => route('order.invoice', $record->invoice_number))
                    ->openUrlInNewTab(),

                Tables\Actions\EditAction::make()
                    ->label('Edit / Detail'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
