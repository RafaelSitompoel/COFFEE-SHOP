<?php

namespace App\Filament\Barista\Resources\BaristaOrderResource\Pages;

use App\Filament\Barista\Resources\BaristaOrderResource;
use Filament\Resources\Pages\ListRecords;

class ListBaristaOrders extends ListRecords
{
    protected static string $resource = BaristaOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
