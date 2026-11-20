<?php

namespace App\Filament\Pages\Auth;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Pages\Auth\Register as BaseRegister;
use Illuminate\Database\Eloquent\Model;

class Register extends BaseRegister
{
    /**
     * Extend the registration form to include role selection.
     */
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Nama Lengkap')
                    ->required()
                    ->maxLength(255)
                    ->autofocus(),

                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->unique('users', 'email'),

                Select::make('role')
                    ->label('Jabatan / Role')
                    ->options([
                        'admin'   => '👑 Admin',
                        'staff'   => '☕ Staff / Barista',
                        'manager' => '📊 Manager',
                    ])
                    ->default('staff')
                    ->required()
                    ->native(false),

                TextInput::make('password')
                    ->label('Password')
                    ->password()
                    ->required()
                    ->minLength(8)
                    ->same('passwordConfirmation'),

                TextInput::make('passwordConfirmation')
                    ->label('Konfirmasi Password')
                    ->password()
                    ->required()
                    ->dehydrated(false),
            ]);
    }

    /**
     * Handle registration — set is_admin = true so the user can access Filament panel.
     */
    protected function handleRegistration(array $data): Model
    {
        // Remove confirmation field before creating
        unset($data['passwordConfirmation']);

        $data['is_admin'] = true;

        return $this->getUserModel()::create($data);
    }

    /**
     * Override page title.
     */
    public function getTitle(): string|\Illuminate\Contracts\Support\Htmlable
    {
        return 'Daftar Akun Admin';
    }

    /**
     * Override heading.
     */
    public function getHeading(): string|\Illuminate\Contracts\Support\Htmlable
    {
        return 'Buat Akun Baru';
    }
}
