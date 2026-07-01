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
use Filament\Schemas\Schema;
use App\Models\Category;
use Filament\Forms\Components\Select;

class PostsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title'),
                TextInput::make('slug'),
                Select::make('category_id')
                    ->label('Category')
                    ->options(Category::all()->pluck('name', 'id')),
                    ColorPicker::make('color'),
                    RichEditor::make('body'),
                    FileUpload::make('image')->disk('public')->directory('posts'),
                    TagsInput::make('tags'),
                    Checkbox::make('Published'),
                    DatePicker::make('published_at')
            ]);
    }
}
