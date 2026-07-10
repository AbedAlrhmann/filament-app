<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\Post;
use App\Models\Product;
use Filament\Support\Enums\IconPosition;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Illuminate\Database\Eloquent\Builder;

class TestStatsWidget extends StatsOverviewWidget
{
    use InteractsWithPageFilters;
    protected static ?int $sort = 2;

    protected function getStats(): array
    {
        $startDate = $this->pageFilters['startDate'] ?? null;
        $endDate = $this->pageFilters['endDate'] ?? null;
        $totalUsers = User::query()->count('*');
        return [
        Stat::make("Total Users", User::query()
            ->when($startDate, fn (Builder $query) => $query->whereDate('created_at', '>=', $startDate))
            ->when($endDate, fn (Builder $query) => $query->whereDate('created_at', '<=', $endDate))
            ->count())
            ->description("Total number of users of this year")
            ->descriptionIcon(HeroIcon::ArrowUpLeft, IconPosition::Before)
            ->chart(
            User::selectRaw("MONTH(created_at) as month, COUNT(*) as count")
                ->whereYear("created_at", now()->year)
                ->groupBy("month")
                ->orderBy("month")
                ->pluck("count")
                ->toArray()
        )
                ->descriptionColor("success")
                ->color("success"),
            Stat::make("Total Post", Post::count('*'))
                ->description("Total number of Post of this years")
                ->descriptionIcon(HeroIcon::ArrowUpLeft, IconPosition::Before)
            //     ->chart(
            //         User::selectRaw("MONTH(created_at) as month, COUNT(*) as count", [])
            //             ->whereYear("created_at", now()->year)
            //             ->groupBy("month")
            //             ->orderBy("month")
            //             ->pluck("count")
            //             ->toArray()
            //     )
                ->descriptionColor("warning")
                ->color("warning"),
             Stat::make("Total Products", Product::count('*'))
                ->description("Total number of Products of this years")
                ->descriptionIcon(HeroIcon::ArrowUpLeft, IconPosition::Before)
            //     ->chart(
            //         User::selectRaw("MONTH(created_at) as month, COUNT(*) as count", [])
            //             ->whereYear("created_at", now()->year)
            //             ->groupBy("month")
            //             ->orderBy("month")
            //             ->pluck("count")
            //             ->toArray()
            //     )
                ->descriptionColor("info")
                ->color("info"),
        ];
    }
}
