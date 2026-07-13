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
use Illuminate\Support\Str;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Group;
use App\Models\Category;
use App\Models\Post;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Support\Icons\Heroicon;
use Hamcrest\Core\Set;

use function Livewire\after;

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
                                TextInput::make('title')->rules(['required'])
                                    ->live(onBlur:true)
                                    ->afterStateUpdated(function (string $operation,string $state,Set $set, Get $get, Post $post) {
                                        $set('slug', Str::slug($state));
                                        // dd($get("category_id"));
                                        dd($post);
                                    }),
                                TextInput::make('slug')->unique()
                                    ->validationMessage([
                                        "Unique" => "Slug should be unique"
                                    ]),
                                Select::make('category_id')
                                    ->label('Category')
                                    ->relationship("category" , "name")
                                    ->serchable(),
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
                                    Select::make('tags')
                                        ->relationship("tags", "name")
                                        ->multiple(),
                                    Checkbox::make('published'),
                                    DatePicker::make('published_at')
                                ])
                    ])->columnSpan(1),
                ])->columns(3);
    }
}
