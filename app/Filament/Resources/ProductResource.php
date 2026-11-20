<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Category;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-beaker';

    protected static ?string $navigationGroup = 'Katalog Kopi';

    protected static ?int $navigationSort = 2;

    protected static ?string $modelLabel = 'Produk Kopi';

    protected static ?string $pluralModelLabel = 'Daftar Produk';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Informasi Utama')
                            ->schema([
                                Forms\Components\Select::make('category_id')
                                    ->label('Kategori')
                                    ->relationship('category', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->required(),

                                Forms\Components\TextInput::make('name')
                                    ->label('Nama Produk')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function (Set $set, ?string $state) {
                                        $set('slug', Str::slug($state));
                                    }),

                                Forms\Components\TextInput::make('slug')
                                    ->label('Slug URL')
                                    ->required()
                                    ->unique(Product::class, 'slug', ignoreRecord: true)
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('sku')
                                    ->label('SKU')
                                    ->required()
                                    ->unique(Product::class, 'sku', ignoreRecord: true)
                                    ->default(fn () => 'CF-' . strtoupper(Str::random(6)))
                                    ->maxLength(50),

                                Forms\Components\Textarea::make('description')
                                    ->label('Deskripsi Lengkap')
                                    ->rows(4)
                                    ->columnSpanFull(),
                            ])->columns(2),

                        Forms\Components\Section::make('Foto Produk')
                            ->schema([
                                Forms\Components\FileUpload::make('image')
                                    ->label('Upload Gambar')
                                    ->image()
                                    ->directory('products')
                                    ->imageEditor()
                                    ->columnSpanFull(),
                            ]),
                    ])->columnSpan(['lg' => 2]),

                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Harga & Stok')
                            ->schema([
                                Forms\Components\TextInput::make('price')
                                    ->label('Harga Normal (Rp)')
                                    ->numeric()
                                    ->prefix('Rp')
                                    ->required()
                                    ->minValue(0),

                                Forms\Components\TextInput::make('discount_price')
                                    ->label('Harga Diskon (Rp)')
                                    ->numeric()
                                    ->prefix('Rp')
                                    ->nullable()
                                    ->helperText('Kosongkan jika tidak ada diskon'),

                                Forms\Components\TextInput::make('stock')
                                    ->label('Stok Tersedia')
                                    ->numeric()
                                    ->default(10)
                                    ->required()
                                    ->minValue(0),

                                Forms\Components\Select::make('status')
                                    ->label('Status Produk')
                                    ->options([
                                        'active' => 'Aktif / Dijual',
                                        'inactive' => 'Nonaktif / Draft',
                                        'out_of_stock' => 'Stok Habis',
                                    ])
                                    ->default('active')
                                    ->required(),

                                Forms\Components\Toggle::make('is_featured')
                                    ->label('Produk Unggulan (Featured)')
                                    ->default(false)
                                    ->helperText('Akan ditampilkan di highlight homepage'),
                            ]),
                    ])->columnSpan(['lg' => 1]),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Foto')
                    ->rounded()
                    ->defaultImageUrl('https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?auto=format&fit=crop&w=100&q=80'),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Produk')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->description(fn (Product $record): string => 'SKU: ' . $record->sku),

                Tables\Columns\TextColumn::make('category.name')
                    ->label('Kategori')
                    ->badge()
                    ->color('info')
                    ->sortable(),

                Tables\Columns\TextColumn::make('price')
                    ->label('Harga')
                    ->money('IDR', locale: 'id')
                    ->sortable(),

                Tables\Columns\TextColumn::make('discount_price')
                    ->label('Diskon')
                    ->money('IDR', locale: 'id')
                    ->placeholder('-')
                    ->color('danger'),

                Tables\Columns\TextColumn::make('stock')
                    ->label('Stok')
                    ->badge()
                    ->color(fn (int $state): string => match (true) {
                        $state <= 0 => 'danger',
                        $state <= 10 => 'warning',
                        default => 'success',
                    })
                    ->sortable(),

                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'success' => 'active',
                        'warning' => 'out_of_stock',
                        'danger' => 'inactive',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'active' => 'Aktif',
                        'out_of_stock' => 'Habis',
                        'inactive' => 'Draft',
                        default => $state,
                    }),

                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Unggulan')
                    ->boolean()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category_id')
                    ->label('Filter Kategori')
                    ->relationship('category', 'name'),

                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'active' => 'Aktif',
                        'out_of_stock' => 'Habis',
                        'inactive' => 'Draft',
                    ]),

                Tables\Filters\TernaryFilter::make('is_featured')
                    ->label('Produk Unggulan'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
