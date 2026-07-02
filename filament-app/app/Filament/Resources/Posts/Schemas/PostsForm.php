<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Group;
use App\Models\Category;
use Filament\Forms\Components\Select;
use Filament\Support\Icons\Heroicon;

class PostsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            
            ->components([
                Section::make('Fields')
                   ->description("Fill all fields in the form")
                    ->icon(Heroicon::RocketLaunch)
                    ->schema([    
                        Group::make()
                            ->schema([
                                TextInput::make('title'),
                                TextInput::make('slug'),
                                Select::make('category_id')
                                    ->label('Category')
                                    ->options(Category::all()->pluck('name', 'id')),
                                ColorPicker::make('color'),
                                MarkdownEditor::make('body'),
                            ])
                    ])->columnSpan(2),   
                    Group::make()
                        ->schema([
                            Section::make('Image Uploade')
                                ->schema([
                                    FileUpload::make('image')->disk('public')->directory('posts')
                                ]),
                            Section::make('Meta')
                                ->schema([
                                    TagsInput::make('tags'),
                                    Checkbox::make('published'),
                                    DatePicker::make('published_at')
                                ])
                    ])->columnSpan(1),
                ])->columns(3);
    }
}
