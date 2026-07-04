<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry; 
use Filament\Infolists\Components\ImageEntry; 
use Filament\Infolists\Components\IconEntry;
class ProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Product Info')
                    ->schema([
                        TextEntry::make('id')
                            ->label('Product ID')
                            ->Weight('bold')
                            ->Color('primary'),

                        TextEntry::make('name')
                            ->label('Product Name')
                            ->Weight('bold')
                            ->Color('primary'),

                        TextEntry::make('sku')
                            ->label('Product SKU')
                            ->Weight('bold')
                            ->badge()
                            ->Color('success'),
                        TextEntry::make('description')
                            ->label('Product Description')
                            ->Weight('bold')
                            ->Color('primary'),
                        TextEntry::make('created_at')
                            ->label('Product Creation Date')
                            ->Weight('bold')
                            ->Color('primary')
                            ->date("m/d/y"),
                    ])->ColumnSpanFull(),
                
                Section::make('Pricing & Stock')
                    ->schema([
                        TextEntry::make('price')
                            ->label('Product Price')
                            ->Weight('bold')
                            ->icon('heroicon-o-currency-dollar')
                            ->Color('primary'),
                        TextEntry::make('stock')
                            ->label('Product Stock')
                            ->Weight('bold')
                            ->Color('primary'),
                    ])->ColumnSpanFull(),

                Section::make('Media & Status')
                    ->schema([
                        ImageEntry::make('image')
                                ->label('Product Image')
                                ->disk('public'),
                        IconEntry::make('is_active')
                                ->label('Is Active ?')
                                ->boolean(),
                        IconEntry::make('is_featured')
                                ->label('Is Featured ?')
                                ->boolean()
                    ])->ColumnSpanFull(),
            ]);
                                
    }
}
