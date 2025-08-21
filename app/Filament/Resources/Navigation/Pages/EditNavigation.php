<?php

namespace App\Filament\Resources\Navigation\Pages;

use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\Navigation\NavigationResource;
use LaraZeus\Sky\Filament\Resources\NavigationResource\Pages\Concerns\HandlesNavigationBuilder;

class EditNavigation extends EditRecord
{
    use HandlesNavigationBuilder;

    protected static string $resource = NavigationResource::class;
}
