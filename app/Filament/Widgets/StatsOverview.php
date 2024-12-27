<?php

namespace App\Filament\Widgets;

use App\Models\Asset;
use App\Models\Employee;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {

        $asset = Asset::where('brand_name', '<>', null)->count();
        $employee = Employee::count();
        return [
            //
            Stat::make('Assets Count', $asset),
            Stat::make('Employee Registered', $employee),
            Stat::make('Maintenance Request', 'None'),
        ];
    }
}
