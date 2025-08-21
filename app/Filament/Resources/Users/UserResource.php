<?php

namespace App\Filament\Resources\Users;

use App\Filament\Exports\UserExporter;
use App\Filament\Resources\Users\Pages\CreateUser;
use App\Filament\Resources\Users\Pages\EditUser;
use App\Filament\Resources\Users\Pages\ListUsers;
use App\Models\User;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ExportAction;
use Filament\Actions\ExportBulkAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\SpatieTagsColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-users';

    protected static ?int $navigationSort = 1;

    protected static function profilePhotoDisk(): string
    {
        return isset($_ENV['VAPOR_ARTIFACT_NAME']) ? 's3' : config('jetstream.profile_photo_disk', 'public');
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Tabs')
                    ->tabs([
                        \Filament\Schemas\Components\Tabs\Tab::make('Account')
                            ->schema([
                                FileUpload::make('profile_photo_path')->image()->imageEditor()->disk(self::profilePhotoDisk())->directory('profile-photos'),
                                TextInput::make('name')->required(),
                                TextInput::make('email')->email()->required(),
                                TextInput::make('telephone'),
                                TextInput::make('password')
                                    ->password()
                                    ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                                    ->dehydrated(fn ($state) => filled($state))
                                    ->required(fn (string $context): bool => $context === 'create'),
                                DateTimePicker::make('email_verified_at'),
                                Toggle::make('is_admin'),
                                Toggle::make('is_disabled'),
                                Toggle::make('is_visible'),
                                SpatieTagsInput::make('tags'),
                                DatePicker::make('feedback_submitted_at'),
                            ]),
                        \Filament\Schemas\Components\Tabs\Tab::make('Bio')
                            ->schema([
                                Textarea::make('position'),
                                Textarea::make('bio'),
                                Textarea::make('site_url')->rules(['url']),
                                Textarea::make('linkedin_profile_url')->rules(['url']),
                                Textarea::make('facebook_url')->rules(['url']),
                                Textarea::make('twitter_url')->rules(['url']),
                                Textarea::make('youtube_url')->rules(['url']),

                            ]),
                    ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->headerActions([
                ExportAction::make()
                    ->exporter(UserExporter::class),
            ])
            ->columns([
                ImageColumn::make('profile_photo_path')->disk(self::profilePhotoDisk()),
                TextColumn::make('name')->searchable(),
                TextColumn::make('email')->searchable(),
                TextColumn::make('telephone')->searchable(),
                ToggleColumn::make('is_admin'),
                ToggleColumn::make('is_disabled'),
                ToggleColumn::make('is_visible'),
                SpatieTagsColumn::make('tags'),
                IconColumn::make('is_verified')
                    ->icon(fn (string $state): string => match ($state) {
                        default => 'heroicon-o-exclamation-triangle',
                        '1' => 'heroicon-o-check',
                    })
                    ->color(fn (string $state): string => match ($state) {
                        '1' => 'success',
                        default => 'warning',
                    }),
                IconColumn::make('has_bio')
                    ->icon(fn (string $state): string => match ($state) {
                        default => 'heroicon-o-exclamation-triangle',
                        '1' => 'heroicon-o-check',
                    })
                    ->color(fn (string $state): string => match ($state) {
                        '1' => 'success',
                        default => 'warning',
                    }),

                TextColumn::make('feedback_submitted_at')->since(),

            ])
            ->filters([
                SelectFilter::make('is_admin')
                    ->options([
                        true => 'Yes',
                        false => 'No',
                    ]),
                TernaryFilter::make('has_bio')
                    ->label('Has Bio')
                    ->placeholder('All users')
                    ->trueLabel('Users with Bio')
                    ->falseLabel('Users without Bio')
                    ->queries(
                        true: fn (Builder $query) => $query->whereNotNull('bio')->where('bio', '!=', ''),
                        false: fn (Builder $query) => $query->whereNull('bio')->orWhere('bio', ''),
                        blank: fn (Builder $query) => $query
                    ),

            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    ExportBulkAction::make()->exporter(UserExporter::class),
                    DeleteBulkAction::make(),
                ]),
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
            'index' => ListUsers::route('/'),
            'create' => CreateUser::route('/create'),
            'edit' => EditUser::route('/{record}/edit'),
        ];
    }
}
