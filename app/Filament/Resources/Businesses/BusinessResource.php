<?php

namespace App\Filament\Resources\Businesses;

use Filament\Schemas\Schema;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Filters\Filter;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Resources\Businesses\Pages\ListBusinesses;
use App\Filament\Resources\Businesses\Pages\CreateBusiness;
use App\Filament\Resources\Businesses\Pages\EditBusiness;
use App\Filament\Resources\BusinessResource\Pages;
use App\Models\Business;
use Filament\Forms;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
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

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-building-office';

    protected static function photoDisk(): string
    {
        return isset($_ENV['VAPOR_ARTIFACT_NAME']) ? 's3' : config('emc.photo_disk', 'public');
    }


    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('photo_path')
                    ->disk(self::photoDisk())
                    ->image()
                    ->required(),
                    RichEditor::make('description')
                    ->maxLength(65535),
                TextInput::make('name')
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


                TextInput::make('url')
                    ->url()
                    ->maxLength(255),
                TextInput::make('linkedin_url')
                    ->url()
                    ->maxLength(255),
                TextInput::make('telephone')
                    ->tel()
                    ->maxLength(255),
                TextInput::make('email')
                    ->email()
                    ->maxLength(255),
                TextInput::make('priority')
                    ->integer()
                    ->default(0),
                Toggle::make('is_approved')
                    ->default(false),
                Toggle::make('is_public')
                    ->default(false),
                Toggle::make('is_sponsor')
                    ->default(false),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('photo_path')->disk(self::photoDisk()),
                TextColumn::make('name')->searchable(),
                ImageColumn::make('image'),
                TextColumn::make('priority'),
                ToggleColumn::make('is_sponsor'),
                ToggleColumn::make('is_public'),
                ToggleColumn::make('is_approved'),
                TextColumn::make('user.name'),
                TextColumn::make('created_at')
                    ->dateTime(),
            ])
            ->filters([
                Filter::make('is_approved')
                    ->query(fn(Builder $query): Builder => $query->where('is_approved', true)),
                Filter::make('is_public')
                    ->query(fn(Builder $query): Builder => $query->where('is_public', true)),
                Filter::make('is_sponsor')
                    ->query(fn(Builder $query): Builder => $query->where('is_sponsor', true)),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                DeleteBulkAction::make(),
            ])
            ->defaultSort('created_at', 'desc');
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
            'index' => ListBusinesses::route('/'),
            'create' => CreateBusiness::route('/create'),
            'edit' => EditBusiness::route('/{record}/edit'),
        ];
    }
}
