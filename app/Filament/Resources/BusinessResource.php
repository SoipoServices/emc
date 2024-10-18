<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BusinessResource\Pages;
use App\Models\Business;
use Filament\Forms;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Filament\Tables\Columns\ToggleColumn;

class BusinessResource extends Resource
{
    protected static ?string $model = Business::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    protected static function photoDisk(): string
    {
        return isset($_ENV['VAPOR_ARTIFACT_NAME']) ? 's3' : config('emc.photo_disk', 'public');
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('photo_path')
                    ->disk(self::photoDisk())
                    ->image()
                    ->required(),
                    RichEditor::make('description')
                    ->maxLength(65535),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)->afterStateUpdated(function ($get, $set, ?string $state) {
                        if (!$get('is_slug_changed_manually') && filled($state)) {
                            $set('slug', Str::slug($state));
                        }
                    })
                    ->reactive(),
                TextInput::make('slug')->required()->afterStateUpdated(function ($set) {
                    $set('is_slug_changed_manually', true);
                })
                    ->required(),
                Select::make('user_id')
                    ->relationship(name: 'user', titleAttribute: 'name')->required(),


                Forms\Components\TextInput::make('url')
                    ->url()
                    ->maxLength(255),
                Forms\Components\TextInput::make('linkedin_url')
                    ->url()
                    ->maxLength(255),
                Forms\Components\TextInput::make('telephone')
                    ->tel()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->maxLength(255),
                Forms\Components\TextInput::make('priority')
                    ->integer()
                    ->default(0),
                Forms\Components\Toggle::make('is_approved')
                    ->default(false),
                Forms\Components\Toggle::make('is_public')
                    ->default(false),
                Forms\Components\Toggle::make('is_sponsor')
                    ->default(false),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('photo_path')->disk(self::photoDisk()),
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('priority'),
                ToggleColumn::make('is_sponsor'),
                ToggleColumn::make('is_public'),
                ToggleColumn::make('is_approved'),
                TextColumn::make('user.name'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
            ])
            ->filters([
                Tables\Filters\Filter::make('is_approved')
                    ->query(fn(Builder $query): Builder => $query->where('is_approved', true)),
                Tables\Filters\Filter::make('is_public')
                    ->query(fn(Builder $query): Builder => $query->where('is_public', true)),
                Tables\Filters\Filter::make('is_sponsor')
                    ->query(fn(Builder $query): Builder => $query->where('is_sponsor', true)),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBusinesses::route('/'),
            'create' => Pages\CreateBusiness::route('/create'),
            'edit' => Pages\EditBusiness::route('/{record}/edit'),
        ];
    }
}
