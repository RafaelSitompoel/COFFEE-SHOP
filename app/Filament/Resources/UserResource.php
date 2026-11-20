<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'Manajemen Pengguna';

    protected static ?int $navigationSort = 1;

    protected static ?string $modelLabel = 'Pengguna & Barista';

    protected static ?string $pluralModelLabel = 'Super Admin & Lead Barista';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Akun & Akses Panel')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Lengkap')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('email')
                            ->label('Alamat Email')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),

                        Forms\Components\Select::make('role')
                            ->label('Hak Akses / Peran')
                            ->options([
                                'admin' => '👑 Super Admin (Akses Penuh / Owner)',
                                'lead_barista' => '☕ Lead Barista (Panel Barista & Racikan)',
                                'staff' => '🍵 Staff Barista (Panel Barista)',
                            ])
                            ->required()
                            ->native(false),

                        Forms\Components\Toggle::make('is_admin')
                            ->label('Izin Akses Super Admin Panel (/admin)')
                            ->default(false)
                            ->helperText('Aktifkan hanya untuk Owner / Super Admin yang berhak melihat omset keuangan.'),

                        Forms\Components\TextInput::make('password')
                            ->label('Password')
                            ->password()
                            ->dehydrateStateUsing(fn ($state) => !empty($state) ? Hash::make($state) : null)
                            ->dehydrated(fn ($state) => filled($state))
                            ->required(fn (string $context): bool => $context === 'create'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->weight('bold')
                    ->searchable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),

                Tables\Columns\BadgeColumn::make('role')
                    ->label('Peran Akun')
                    ->colors([
                        'primary' => 'admin',
                        'success' => 'lead_barista',
                        'info' => 'staff',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'admin' => '👑 Super Admin',
                        'lead_barista' => '☕ Lead Barista',
                        'staff' => '🍵 Staff Barista',
                        default => $state,
                    }),

                Tables\Columns\IconColumn::make('is_admin')
                    ->label('Akses Super Admin')
                    ->boolean(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Terdaftar')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('role')
                    ->options([
                        'admin' => 'Super Admin',
                        'lead_barista' => 'Lead Barista',
                        'staff' => 'Staff Barista',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
