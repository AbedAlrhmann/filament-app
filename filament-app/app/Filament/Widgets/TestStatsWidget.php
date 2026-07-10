<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\Post;
use App\Models\Product;
use Filament\Support\Enums\IconPosition;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TestStatsWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $totalUsers = User::query()->count('*');
        return [
            // Stat::make("Total Users", $totalUsers)
            //     ->description("Total number of users of this years")
            //     ->descriptionIcon(HeroIcon::ArrowUpLeft, IconPosition::Before)
            //     ->chart(
            //         User::selectRaw("MONTH(created_at) as month, COUNT(*) as count", [])
            //             ->whereYear("created_at", now()->year)
            //             ->groupBy("month")
            //             ->orderBy("month")
            //             ->pluck("count")
            //             ->toArray()
            //     )
            //     ->descriptionColor("success")
            //     ->color("success"),
            // Stat::make("Total Post", Post::count('*'))
            //     ->description("Total number of Post of this years")
            //     ->descriptionIcon(HeroIcon::ArrowUpLeft, IconPosition::Before)
            //     ->chart(
            //         User::selectRaw("MONTH(created_at) as month, COUNT(*) as count", [])
            //             ->whereYear("created_at", now()->year)
            //             ->groupBy("month")
            //             ->orderBy("month")
            //             ->pluck("count")
            //             ->toArray()
            //     )
            //     ->descriptionColor("warning")
            //     ->color("warning"),
            //  Stat::make("Total Products", Product::count('*'))
            //     ->description("Total number of Products of this years")
            //     ->descriptionIcon(HeroIcon::ArrowUpLeft, IconPosition::Before)
            //     ->chart(
            //         User::selectRaw("MONTH(created_at) as month, COUNT(*) as count", [])
            //             ->whereYear("created_at", now()->year)
            //             ->groupBy("month")
            //             ->orderBy("month")
            //             ->pluck("count")
            //             ->toArray()
            //     )
            //     ->descriptionColor("info")
            //     ->color("info"),
        ];
    }
}
