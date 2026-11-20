<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingResource\Pages;
use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationGroup = 'Pengaturan';

    protected static ?int $navigationSort = 1;

    protected static ?string $modelLabel = 'Pengaturan Toko';

    protected static ?string $pluralModelLabel = 'Pengaturan Toko';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Identitas Toko Kopi')
                    ->schema([
                        Forms\Components\TextInput::make('shop_name')
                            ->label('Nama Toko')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('whatsapp_number')
                            ->label('Nomor WhatsApp')
                            ->required()
                            ->maxLength(50),

                        Forms\Components\TextInput::make('email')
                            ->label('Email Kontak')
                            ->email()
                            ->required()
                            ->maxLength(255),

                        Forms\Components\Textarea::make('address')
                            ->label('Alamat Lengkap Toko')
                            ->rows(3)
                            ->columnSpanFull(),

                        Forms\Components\Textarea::make('description')
                            ->label('Deskripsi Toko (Footer & About)')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])->columns(3),

                Forms\Components\Section::make('Informasi Rekening Pembayaran')
                    ->schema([
                        Forms\Components\Textarea::make('bank_info')
                            ->label('Rincian Bank untuk Transfer')
                            ->helperText('Tuliskan nama bank, nomor rekening, dan atas nama rekening yang tampil di checkout pelanggan.')
                            ->rows(4)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('shop_name')
                    ->label('Nama Toko')
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('whatsapp_number')
                    ->label('WhatsApp'),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email'),

                Tables\Columns\TextColumn::make('address')
                    ->label('Alamat')
                    ->limit(50),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSettings::route('/'),
            'edit' => Pages\EditSetting::route('/{record}/edit'),
        ];
    }
}
