<?php

namespace App\Filament\Resources\Products\Schemas;


use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Schemas\Components\Group;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Actions\Action;
class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([
                    Step::make('Product Info')
                        // ->icon('heroicon-o-information-circle')
                        ->description("Fill all the fields")
                        ->schema([
                            Group::make()
                                ->schema([
                                    TextInput::make('name')->required(),
                                    TextInput::make('sku'),
                                ])->ColumnSpan(2),
                            
                            MarkdownEditor::make('description'),
                    ]),

                    Step::make('Pricing & stock')
                        ->description("Fill Price & Stock")
                        ->schema([
                            Group::make()
                                ->schema([
                                    TextInput::make('price'),
                                    TextInput::make('stock'),
                                ])->ColumnSpan(2)
                    ]),

                    Step::make('Media & Status')
                        ->description("Fill Media & Status")
                        ->schema([
                                FileUpload::make('image')->disk('public')->directory('products'),
                                Checkbox::make('is_active'),
                                Checkbox::make('is_featured')
                            ])
                    

                ])
                ->ColumnSpanFull()
                ->skippable()        
                
            ]);
    }
}
