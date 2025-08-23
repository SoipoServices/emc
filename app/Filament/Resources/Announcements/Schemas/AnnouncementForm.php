<?php

namespace App\Filament\Resources\Announcements\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AnnouncementForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                TextInput::make('title')
                    ->required()
                    ->columnSpanFull(),
                RichEditor::make('content')
                    ->maxLength(65535)
                    ->columnSpanFull(),
                DateTimePicker::make('scheduled_at')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
