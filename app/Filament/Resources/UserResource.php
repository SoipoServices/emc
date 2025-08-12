<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Resources\Components\Tab;
use Filament\Resources\Resource;
use Filament\SpatieLaravelTagsPlugin\Types\AllTagTypes;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?int $navigationSort = 1;
    protected static function profilePhotoDisk():string
    {
        return isset($_ENV['VAPOR_ARTIFACT_NAME']) ? 's3' : config('jetstream.profile_photo_disk', 'public');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Tabs')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Account')
                            ->schema([
                                FileUpload::make('profile_photo_path')->image()->imageEditor()->disk(self::profilePhotoDisk())->directory('profile-photos'),
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
                                Forms\Components\Toggle::make('is_disabled'),
                                Forms\Components\SpatieTagsInput::make('tags'),
                                Forms\Components\DatePicker::make('feedback_submitted_at'),
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
                ImageColumn::make('profile_photo_path')->disk(self::profilePhotoDisk()),
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('email')->searchable(),
                Tables\Columns\TextColumn::make('telephone')->searchable(),
                Tables\Columns\ToggleColumn::make('is_admin'),
                Tables\Columns\ToggleColumn::make('is_disabled'),
                Tables\Columns\SpatieTagsColumn::make('tags'),
                Tables\Columns\IconColumn::make('is_verified')
                    ->icon(fn (string $state): string => match ($state) {
                        default => 'heroicon-o-exclamation-triangle',
                        "1" => 'heroicon-o-check',
                    })
                    ->color(fn (string $state): string => match ($state) {
                        "1" => 'success',
                        default => 'warning',
                    }),
                Tables\Columns\IconColumn::make('has_bio')
                    ->icon(fn (string $state): string => match ($state) {
                        default => 'heroicon-o-exclamation-triangle',
                        "1" => 'heroicon-o-check',
                    })
                    ->color(fn (string $state): string => match ($state) {
                        "1" => 'success',
                        default => 'warning',
                    }),

                Tables\Columns\TextColumn::make('feedback_submitted_at')->since(),


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
            ])
            ->defaultSort('created_at','desc');
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
