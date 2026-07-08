<?php

namespace App\Filament\Resources\Posts;

use App\Filament\Resources\Posts\Pages\CreatePosts;
use App\Filament\Resources\Posts\Pages\EditPosts;
use App\Filament\Resources\Posts\Pages\ListPosts;
use App\Filament\Resources\Posts\Schemas\PostsForm;
use App\Filament\Resources\Posts\Tables\PostsTable;
use App\Models\Post;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use App\Filament\Resources\Posts\RelationManagers\TagsRelationManager;
use Dom\ParentNode;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Override;

class PostsResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'title';

    protected static string|\UnitEnum|null $navigationGroup = "Blog";

    #[Override]
    public static function getGloballySearchableAttributes(): array
    {
        return ["title", "slug", "category.name"];
    }
    #[Override]
    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            "Slug" => $record->slug,
            "Category" => $record->category->name
        ];
    }

    #[Override]
    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return Parent::getGlobalSearchEloquentQuery()->with(["category"]);
    }
    public static function form(Schema $schema): Schema
    {
        return PostsForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PostsTable::configure($table);
    }
    public static function getPages(): array
    {
        return [
            'index' => ListPosts::route('/'),
            'create' => CreatePosts::route('/create'),
            'edit' => EditPosts::route('/{record}/edit'),
        ];
        
    }
    public static function getRelations(): array
    {
        return [
            TagsRelationManager::class,
        ];
    }
}
