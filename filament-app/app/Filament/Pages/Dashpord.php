<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\DatePicker;
use Filament\Pages\Dashboard as BaseDashbaord;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class Dashboard extends BaseDashbaord {
    use HasFiltersForm;
    public function filterForm(schema $schema): schema {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        DatePicker::make("startDate"),
                        DatePicker::make("endDate"),
                    ])
                    ->columns(3)
                    ->columnSpanFull(),
            ]);
    }
}
