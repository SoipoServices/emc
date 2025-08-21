<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NavigationResource\Pages\CreateNavigation;
use App\Filament\Resources\NavigationResource\Pages\EditNavigation;
use App\Filament\Resources\NavigationResource\Pages\ListNavigations;
use BackedEnum;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use LaraZeus\Sky\Models\Navigation;

class NavigationResource extends Resource
{
    protected static ?string $model = Navigation::class;

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-queue-list';

    protected static ?int $navigationSort = 99;

    protected static bool $showTimestamps = true;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Navigation Details')
                    ->schema([
                        TextInput::make('name')
                            ->label('Navigation Name')
                            ->reactive()
                            ->debounce()
                            ->afterStateUpdated(function (?string $state, Set $set) {
                                if (! $state) {
                                    return;
                                }
                                $set('handle', Str::slug($state));
                            })
                            ->required(),
                        TextInput::make('handle')
                            ->label('Handle (URL-friendly)')
                            ->required()
                            ->unique(ignoreRecord: true),
                        Textarea::make('items')
                            ->label('Navigation Items (JSON)')
                            ->default('[]')
                            ->helperText('Enter navigation items as JSON array. Example: [{"label": "Home", "url": "/"}]')
                            ->rows(5)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('zeus-sky::filament-navigation.attributes.name'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('handle')
                    ->label(__('zeus-sky::filament-navigation.attributes.handle'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label(__('zeus-sky::filament-navigation.attributes.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->visible(static::$showTimestamps),
                TextColumn::make('updated_at')
                    ->label(__('zeus-sky::filament-navigation.attributes.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->visible(static::$showTimestamps),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                // Add bulk actions here if needed
            ]);
    }

    public static function getLabel(): string
    {
        return __('Navigation');
    }

    public static function getPluralLabel(): string
    {
        return __('Navigations');
    }

    public static function getNavigationLabel(): string
    {
        return __('Navigations');
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Resources\Navigation\Pages\ListNavigations::route('/'),
            'create' => \App\Filament\Resources\Navigation\Pages\CreateNavigation::route('/create'),
            'edit' => \App\Filament\Resources\Navigation\Pages\EditNavigation::route('/{record}/edit'),
        ];
    }
}
