<?php

namespace App\Filament\Barista\Resources\BaristaOrderResource\Pages;

use App\Filament\Barista\Resources\BaristaOrderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBaristaOrder extends EditRecord
{
    protected static string $resource = BaristaOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('print_struk')
                ->label('Cetak Struk')
                ->icon('heroicon-o-receipt-percent')
                ->color('warning')
                ->url(fn (): string => route('order.struk', $this->record->invoice_number))
                ->openUrlInNewTab(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
