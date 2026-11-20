<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditOrder extends EditRecord
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('mark_as_success')
                ->label('Transaksi Berhasil')
                ->icon('heroicon-o-check-badge')
                ->color('success')
                ->visible(fn (): bool => $this->record->status !== 'Completed' || $this->record->payment_status !== 'Paid')
                ->requiresConfirmation()
                ->modalHeading('Konfirmasi Transaksi Berhasil')
                ->modalDescription(fn (): string => "Tandai pesanan {$this->record->invoice_number} sebagai BERHASIL (Selesai & Lunas)?")
                ->modalSubmitActionLabel('Ya, Transaksi Berhasil')
                ->action(function () {
                    $this->record->update([
                        'status' => 'Completed',
                        'payment_status' => 'Paid',
                    ]);

                    if ($this->record->payment) {
                        $this->record->payment->update([
                            'payment_status' => 'Paid',
                            'payment_date' => $this->record->payment->payment_date ?? now(),
                        ]);
                    }

                    Notification::make()
                        ->title('Transaksi Berhasil!')
                        ->body("Pesanan {$this->record->invoice_number} berhasil diselesaikan & lunas.")
                        ->success()
                        ->send();

                    $this->fillForm();
                }),

            Actions\Action::make('dispatch_gojek')
                ->label('Panggil Gojek')
                ->icon('heroicon-o-truck')
                ->color('success')
                ->visible(fn (): bool => in_array($this->record->status, ['Pending', 'Processing', 'Shipped']))
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
                ->action(function (array $data) {
                    $this->record->update([
                        'status' => 'Shipped',
                        'courier_name' => $data['courier_name'],
                        'driver_name' => $data['driver_name'],
                        'driver_phone' => $data['driver_phone'],
                        'driver_plate' => $data['driver_plate'],
                        'driver_status' => $data['driver_status'],
                    ]);

                    Notification::make()
                        ->title('🛵 Driver Gojek Siap Berangkat!')
                        ->body("Driver {$data['driver_name']} ({$data['driver_plate']}) telah ditugaskan.")
                        ->success()
                        ->send();

                    $this->fillForm();
                }),

            Actions\Action::make('print_struk')
                ->label('Cetak Struk PNG')
                ->icon('heroicon-o-receipt-percent')
                ->color('warning')
                ->url(fn (): string => route('order.struk', $this->record->invoice_number))
                ->openUrlInNewTab(),

            Actions\Action::make('print')
                ->label('Cetak Invoice')
                ->icon('heroicon-o-printer')
                ->color('gray')
                ->url(fn (): string => route('order.invoice', $this->record->invoice_number))
                ->openUrlInNewTab(),

            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
