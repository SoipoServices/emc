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
            Stat::make('Total Users', Event::count()),
        ];
    }
}
