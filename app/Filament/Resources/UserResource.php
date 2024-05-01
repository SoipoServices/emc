<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Components\Tab;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Tabs')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Account')
                            ->schema([
                                Forms\Components\TextInput::make('name')->required(),
                                Forms\Components\TextInput::make('email')->email()->required(),
                                Forms\Components\TextInput::make('telephone'),
                                Forms\Components\TextInput::make('password')
                                    ->password()
                                    ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                                    ->dehydrated(fn ($state) => filled($state))
                                    ->required(fn (string $context): bool => $context === 'create'),
                                Forms\Components\DateTimePicker::make('email_verified_at'),
                                Forms\Components\Toggle::make('is_admin'),
                                Forms\Components\SpatieTagsInput::make('tags')->type('categories')
                            ]),
                        Forms\Components\Tabs\Tab::make('Bio')
                            ->schema([
                                Forms\Components\Textarea::make('position'),
                                Forms\Components\Textarea::make('bio'),
                                Forms\Components\Textarea::make('site_url')->rules(['url']),
                                Forms\Components\Textarea::make('linkedin_profile_url')->rules(['url']),
                                Forms\Components\Textarea::make('facebook_url')->rules(['url']),
                                Forms\Components\Textarea::make('twitter_url')->rules(['url']),
                                Forms\Components\Textarea::make('youtube_url')->rules(['url']),

                            ]),
                    ])

            ]);
    }



    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('email')->searchable(),
                Tables\Columns\ToggleColumn::make('is_admin'),
                Tables\Columns\SpatieTagsColumn::make('tags')
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('is_admin')
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
