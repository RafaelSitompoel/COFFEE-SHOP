<?php

namespace App\Filament\Resources\PaymentResource\Pages;

use App\Filament\Resources\PaymentResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditPayment extends EditRecord
{
    protected static string $resource = PaymentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('mark_as_paid')
                ->label('Konfirmasi Lunas')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->visible(fn (): bool => $this->record->payment_status !== 'Paid')
                ->requiresConfirmation()
                ->modalHeading('Konfirmasi Pembayaran Lunas')
                ->modalDescription(fn (): string => "Konfirmasi bahwa pesanan " . ($this->record->order->invoice_number ?? '') . " sudah lunas?")
                ->action(function () {
                    $this->record->update([
                        'payment_status' => 'Paid',
                        'payment_date' => $this->record->payment_date ?? now(),
                    ]);

                    if ($this->record->order) {
                        $this->record->order->update([
                            'payment_status' => 'Paid',
                            'status' => $this->record->order->status === 'Pending' ? 'Processing' : $this->record->order->status,
                        ]);
                    }

                    Notification::make()
                        ->title('Pembayaran Berhasil Dikonfirmasi!')
                        ->body("Status pembayaran berhasil diubah ke Lunas.")
                        ->success()
                        ->send();

                    $this->fillForm();
                }),

            Actions\Action::make('print_struk')
                ->label('Lihat Struk PNG')
                ->icon('heroicon-o-receipt-percent')
                ->color('warning')
                ->visible(fn (): bool => !empty($this->record->order))
                ->url(fn (): string => route('order.struk', $this->record->order->invoice_number))
                ->openUrlInNewTab(),

            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
