<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentResource\Pages;
use App\Models\Order;
use App\Models\Payment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PaymentResource extends Resource
{
    protected static ?string $model = Payment::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    protected static ?string $navigationGroup = 'Transaksi & Penjualan';

    protected static ?int $navigationSort = 3;

    protected static ?string $modelLabel = 'Pembayaran';

    protected static ?string $pluralModelLabel = 'Daftar Pembayaran';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Pembayaran')
                    ->schema([
                        Forms\Components\Select::make('order_id')
                            ->label('Nomor Invoice Pesanan')
                            ->relationship('order', 'invoice_number')
                            ->disabled()
                            ->dehydrated(false)
                            ->required(),

                        Forms\Components\Select::make('payment_method')
                            ->label('Metode Pembayaran')
                            ->options([
                                'Transfer Bank' => 'Transfer Bank',
                                'Cash on Delivery' => 'Cash on Delivery (COD)',
                            ])
                            ->required(),

                        Forms\Components\TextInput::make('amount')
                            ->label('Jumlah Bayar')
                            ->prefix('Rp')
                            ->numeric()
                            ->required(),

                        Forms\Components\Select::make('payment_status')
                            ->label('Status Pembayaran')
                            ->options([
                                'Unpaid' => 'Unpaid (Belum Bayar)',
                                'Paid' => 'Paid (Lunas)',
                                'Failed' => 'Failed (Gagal)',
                                'Refunded' => 'Refunded (Dikembalikan)',
                            ])
                            ->required(),

                        Forms\Components\DateTimePicker::make('payment_date')
                            ->label('Tanggal Pembayaran')
                            ->default(now()),

                        Forms\Components\Textarea::make('notes')
                            ->label('Catatan Pembayaran')
                            ->rows(3)
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('payment_proof')
                            ->label('Bukti Transfer Pembayaran')
                            ->image()
                            ->directory('payment_proofs')
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order.invoice_number')
                    ->label('Invoice')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->url(fn (Payment $record): string => OrderResource::getUrl('edit', ['record' => $record->order_id])),

                Tables\Columns\TextColumn::make('order.customer_name')
                    ->label('Pelanggan')
                    ->searchable(),

                Tables\Columns\TextColumn::make('payment_method')
                    ->label('Metode')
                    ->badge()
                    ->color('gray'),

                Tables\Columns\TextColumn::make('amount')
                    ->label('Nominal')
                    ->money('IDR', locale: 'id')
                    ->weight('bold')
                    ->sortable(),

                Tables\Columns\BadgeColumn::make('payment_status')
                    ->label('Status')
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

                Tables\Columns\ImageColumn::make('payment_proof')
                    ->label('Bukti')
                    ->circular()
                    ->placeholder('Tidak ada'),

                Tables\Columns\TextColumn::make('payment_date')
                    ->label('Waktu Bayar')
                    ->dateTime('d M Y, H:i')
                    ->placeholder('-')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('payment_status')
                    ->options([
                        'Unpaid' => 'Belum Bayar',
                        'Paid' => 'Lunas',
                        'Failed' => 'Gagal',
                        'Refunded' => 'Dikembalikan',
                    ]),

                Tables\Filters\SelectFilter::make('payment_method')
                    ->options([
                        'Transfer Bank' => 'Transfer Bank',
                        'Cash on Delivery' => 'Cash on Delivery',
                    ]),
            ])
            ->actions([
                Tables\Actions\Action::make('mark_as_paid')
                    ->label('Konfirmasi Lunas')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn (Payment $record): bool => $record->payment_status !== 'Paid')
                    ->requiresConfirmation()
                    ->modalHeading('Konfirmasi Pembayaran Lunas')
                    ->modalDescription(fn (Payment $record): string => "Konfirmasi bahwa pesanan " . ($record->order->invoice_number ?? '') . " sebesar Rp " . number_format($record->amount, 0, ',', '.') . " sudah lunas?")
                    ->modalSubmitActionLabel('Ya, Konfirmasi Lunas')
                    ->action(function (Payment $record) {
                        $record->update([
                            'payment_status' => 'Paid',
                            'payment_date' => $record->payment_date ?? now(),
                        ]);

                        if ($record->order) {
                            $record->order->update([
                                'payment_status' => 'Paid',
                                'status' => $record->order->status === 'Pending' ? 'Processing' : $record->order->status,
                            ]);
                        }

                        Notification::make()
                            ->title('Pembayaran Dikonfirmasi Lunas!')
                            ->body("Pembayaran sebesar Rp " . number_format($record->amount, 0, ',', '.') . " berhasil diverifikasi.")
                            ->success()
                            ->send();
                    }),

                Tables\Actions\Action::make('print_struk')
                    ->label('Struk PNG')
                    ->icon('heroicon-o-receipt-percent')
                    ->color('warning')
                    ->url(fn (Payment $record): ?string => $record->order ? route('order.struk', $record->order->invoice_number) : null)
                    ->openUrlInNewTab(),

                Tables\Actions\EditAction::make()
                    ->label('Edit'),
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
            'index' => Pages\ListPayments::route('/'),
            'edit' => Pages\EditPayment::route('/{record}/edit'),
        ];
    }
}
