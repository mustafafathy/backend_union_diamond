<?php

namespace App\Filament\Resources\ProjectResource\Widgets;

use App\Models\Project;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $project = Project::get();

        $projects = Project::select(DB::raw('COUNT(id) as projects_no, SUM(units_no) as units'))
            ->groupBy(DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('YEAR(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->get();

        $groupedUnits = $projects->pluck('units')->toArray() ? $projects->pluck('units')->toArray() : ['0'];
        $groupedProjects = $projects->pluck('projects_no')->toArray() ? $projects->pluck('projects_no')->toArray() : ['0'];

        return [
            Stat::make('Projects', $project->count())
                ->icon('O-globe-alt')
                ->description($groupedProjects[count($groupedProjects) - 1] . ' This Month')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart($groupedProjects)
                ->color('success'),

            Stat::make('Units', $project->sum('units_no'))
                ->icon('O-home-modern')
                ->description($groupedUnits[count($groupedUnits) - 1] . ' This Month')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart($groupedUnits)
                ->color('success'),
        ];
    }
}
