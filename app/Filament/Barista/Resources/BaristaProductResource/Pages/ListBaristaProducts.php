<?php

namespace App\Filament\Barista\Resources\BaristaProductResource\Pages;

use App\Filament\Barista\Resources\BaristaProductResource;
use Filament\Resources\Pages\ListRecords;

class ListBaristaProducts extends ListRecords
{
    protected static string $resource = BaristaProductResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
