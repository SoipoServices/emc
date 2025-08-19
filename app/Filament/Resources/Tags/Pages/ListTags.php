<?php

namespace App\Filament\Resources\Tags\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Resources\Tags\TagResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use LaraZeus\SpatieTranslatable\Actions\LocaleSwitcher;
use LaraZeus\SpatieTranslatable\Resources\Pages\ListRecords\Concerns\Translatable;
use Locale;

class ListTags extends ListRecords
{
    use Translatable;


    protected static string $resource = TagResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
            CreateAction::make(),
        ];
    }
}
