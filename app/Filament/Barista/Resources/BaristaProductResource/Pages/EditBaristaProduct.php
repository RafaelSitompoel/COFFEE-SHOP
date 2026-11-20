<?php

namespace App\Filament\Barista\Resources\BaristaProductResource\Pages;

use App\Filament\Barista\Resources\BaristaProductResource;
use Filament\Resources\Pages\EditRecord;

class EditBaristaProduct extends EditRecord
{
    protected static string $resource = BaristaProductResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
