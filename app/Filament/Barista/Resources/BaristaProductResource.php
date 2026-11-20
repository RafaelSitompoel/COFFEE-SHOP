<?php

namespace App\Filament\Barista\Resources;

use App\Filament\Barista\Resources\BaristaProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BaristaProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';

    protected static ?string $navigationLabel = 'Ketersediaan Stok Kopi';

    protected static ?string $modelLabel = 'Menu Kopi';

    protected static ?string $pluralModelLabel = 'Ketersediaan Menu & Stok';

    protected static ?string $slug = 'products';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Ketersediaan Bahan & Stok Barista')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Menu Kopi')
                            ->disabled(),

                        Forms\Components\TextInput::make('sku')
                            ->label('SKU')
                            ->disabled(),

                        Forms\Components\TextInput::make('stock')
                            ->label('Sisa Stok Porsi / Cup')
                            ->numeric()
                            ->required()
                            ->helperText('Perbarui stok jika biji kopi atau bahan baru di-restock.'),

                        Forms\Components\Select::make('status')
                            ->label('Status Ketersediaan Menu')
                            ->options([
                                'active' => '🟢 Siap Diseduh (Tersedia)',
                                'out_of_stock' => '🔴 Habis (Bahan Kosong)',
                                'inactive' => '⚪ Tidak Tersedia Sementara',
                            ])
                            ->required(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Foto')
                    ->circular(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Menu Kopi')
                    ->weight('bold')
                    ->searchable(),

                Tables\Columns\TextColumn::make('category.name')
                    ->label('Kategori')
                    ->badge()
                    ->color('gray'),

                Tables\Columns\TextColumn::make('stock')
                    ->label('Sisa Stok (Cup)')
                    ->weight('bold')
                    ->sortable()
                    ->color(fn (Product $record): string => $record->stock <= 5 ? 'danger' : 'success'),

                Tables\Columns\BadgeColumn::make('status')
                    ->label('Ketersediaan')
                    ->colors([
                        'success' => 'active',
                        'danger' => 'out_of_stock',
                        'gray' => 'inactive',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'active' => 'Siap Diseduh',
                        'out_of_stock' => 'Habis',
                        'inactive' => 'Nonaktif',
                        default => $state,
                    }),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'active' => 'Siap Diseduh',
                        'out_of_stock' => 'Habis',
                    ]),
            ])
            ->actions([
                Tables\Actions\Action::make('toggle_status')
                    ->label(fn (Product $record): string => $record->status === 'active' ? 'Set Habis' : 'Set Tersedia')
                    ->icon(fn (Product $record): string => $record->status === 'active' ? 'heroicon-o-x-circle' : 'heroicon-o-check-circle')
                    ->color(fn (Product $record): string => $record->status === 'active' ? 'danger' : 'success')
                    ->action(function (Product $record) {
                        $newStatus = $record->status === 'active' ? 'out_of_stock' : 'active';
                        $record->update(['status' => $newStatus]);
                        Notification::make()
                            ->title('Status Stok Diperbarui')
                            ->body("Menu {$record->name} sekarang {$newStatus}.")
                            ->success()
                            ->send();
                    }),

                Tables\Actions\EditAction::make()
                    ->label('Update Stok'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBaristaProducts::route('/'),
            'edit' => Pages\EditBaristaProduct::route('/{record}/edit'),
        ];
    }
}
