<?php

namespace App\Filament\Resources\Navigation;

use App\Filament\Resources\Navigation\Pages\CreateNavigation;
use App\Filament\Resources\Navigation\Pages\EditNavigation;
use App\Filament\Resources\Navigation\Pages\ListNavigations;
use BackedEnum;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Components\View;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Str;
use LaraZeus\Sky\Models\Navigation;

class NavigationResource extends Resource
{
    protected static ?string $model = Navigation::class;

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-queue-list';

    protected static string|\UnitEnum|null $navigationGroup = 'CMS';
    
    protected static ?int $navigationSort = 99;

    protected static bool $showTimestamps = true;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('name')
                            ->label(__('zeus-sky::filament-navigation.attributes.name'))
                            ->reactive()
                            ->debounce()
                            ->afterStateUpdated(function (?string $state, Set $set) {
                                if (! $state) {
                                    return;
                                }

                                $set('handle', Str::slug($state));
                            })
                            ->required(),
                        Repeater::make('items')
                            ->label(__('zeus-sky::filament-navigation.attributes.items'))
                            ->default([])
                            ->schema([
                                TextInput::make('label')
                                    ->label('Label')
                                    ->required(),
                                Select::make('type')
                                    ->label('Type')
                                    ->options([
                                        'external-link' => 'External Link',
                                        'route' => 'Route',
                                    ])
                                    ->default('external-link')
                                    ->required(),
                                TextInput::make('url')
                                    ->label('URL')
                                    ->url()
                                    ->visible(fn ($get) => $get('type') === 'external-link'),
                                TextInput::make('route')
                                    ->label('Route')
                                    ->visible(fn ($get) => $get('type') === 'route'),
                            ])
                            ->collapsible()
                            ->reorderable()
                            ->addActionLabel('Add Navigation Item'),
                    ])
                    ->columnSpan([
                        12,
                        'lg' => 8,
                    ]),
                Section::make()
                    ->hiddenLabel()
                    ->schema([
                        TextInput::make('handle')
                            ->label(__('zeus-sky::filament-navigation.attributes.handle'))
                            ->required()
                            ->unique(ignoreRecord: true),
                        // Only show timestamps on edit page, not create
                        View::make('zeus::filament.card-divider')
                            ->visible(fn (?Navigation $record) => $record && static::$showTimestamps),
                        TextEntry::make('created_at')
                            ->label(__('zeus-sky::filament-navigation.attributes.created_at'))
                            ->visible(fn (?Navigation $record) => $record && static::$showTimestamps),
                        TextEntry::make('updated_at')
                            ->label(__('zeus-sky::filament-navigation.attributes.updated_at'))
                            ->visible(fn (?Navigation $record) => $record && static::$showTimestamps),
                    ])
                    ->columnSpan([
                        12,
                        'lg' => 4,
                    ]),
            ])
            ->columns(12);
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
            ])
            ->headerActions([
                CreateAction::make()
            ])
            ->bulkActions([
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
            'index' => ListNavigations::route('/'),
            'create' => CreateNavigation::route('/create'),
            'edit' => EditNavigation::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}