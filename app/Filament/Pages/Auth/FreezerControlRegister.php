<?php

namespace App\Filament\Pages\Auth;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Auth\Register;

class FreezerControlRegister extends Register
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Nome Completo')
                    ->required()
                    ->maxLength(255),

                TextInput::make('document')
                    ->label('CPF')
                    ->required()
                    ->maxLength(15),

                TextInput::make('email')
                    ->label('Email')
                    ->required()
                    ->email()
                    ->maxLength(255),

                TextInput::make('password')
                    ->label('Senha')
                    ->password()
                    ->required()
                    ->minLength(16),

                TextInput::make('phone')
                    ->label('Whatsapp')
                    ->mask('(99) 99999-9999')
                    ->required()
                    ->maxLength(15),

                DateTimePicker::make('birthdate')
                    ->label('Data de Nascimento')
                    ->required()
            ]);

    }
}
