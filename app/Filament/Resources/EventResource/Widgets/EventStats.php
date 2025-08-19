<?php

namespace App\Filament\Resources\EventResource\Widgets;

use App\Models\Event;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class EventStats extends BaseWidget
{

    protected function getStats(): array
    {
        return [
            Stat::make('Total Events', Event::count()),
            Stat::make('Member Events', Event::memberEvent()->count()),
            Stat::make('Approved Events', Event::approved()->count()),
        ];
    }
}
