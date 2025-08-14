<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Filament\Resources\EventResource\RelationManagers;
use App\Filament\Resources\EventResource\RelationManagers\UserRelationManager;
use App\Models\Event;
use Closure;
use Illuminate\Support\Str;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static ?int $navigationSort = 2;

    protected static function photoDisk(): string
    {
        return isset($_ENV['VAPOR_ARTIFACT_NAME']) ? 's3' : config('emc.photo_disk', 'public');
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->required()
                    ->afterStateUpdated(function ($get, $set, ?string $state) {
                        if (!$get('is_slug_changed_manually') && filled($state)) {
                            $set('slug', Str::slug($state));
                        }
                    })
                    ->reactive(),

                TextInput::make('slug')
                    ->required()
                    ->afterStateUpdated(function ($get, $set, ?string $state) {
                        // Only set manually if the slug is changed and not empty
                        if (filled($state)) {
                            $set('is_slug_changed_manually', true);
                        } else {
                            $set('is_slug_changed_manually', false);
                        }
                    })
                    ->reactive(),
                Hidden::make('is_slug_changed_manually')
                    ->default(false)
                    ->dehydrated(false),
                FileUpload::make('photo_path')->disk(self::photoDisk()),

                RichEditor::make('description')->required(),
                DateTimePicker::make('start_date')->required(),
                DateTimePicker::make('end_date')->required(),
                TextInput::make('address')->required(),
                TextInput::make('link')->required()->rule('url'),
                Select::make('user_id')
                    ->relationship(name: 'user', titleAttribute: 'name')->required(),
                SpatieTagsInput::make('tags'),
                Toggle::make('is_approved'),
                Toggle::make('is_member_event'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('photo_path')->disk(self::photoDisk()),
                TextColumn::make('title')->searchable(),
                TextColumn::make('slug')->searchable(),
                TextColumn::make('address')->searchable(),
                TextColumn::make('start_date')->since(),
                TextColumn::make('end_date')->since(),
                TextColumn::make('user.name'),
                ToggleColumn::make('is_approved'),
                ToggleColumn::make('is_member_event'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('is_approved')
                    ->options([
                        true => 'Yes',
                        false => 'No',
                    ]),
                Tables\Filters\SelectFilter::make('is_member_event')
                    ->options([
                        true => 'Yes',
                        false => 'No',
                    ])
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            // UserRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
