<?php

namespace App\Filament\Resources\Navigation\Pages;

use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\Navigation\NavigationResource;
use LaraZeus\Sky\Filament\Resources\NavigationResource\Pages\Concerns\HandlesNavigationBuilder;

class CreateNavigation extends CreateRecord
{
    use HandlesNavigationBuilder;

    protected static string $resource = NavigationResource::class;
}
