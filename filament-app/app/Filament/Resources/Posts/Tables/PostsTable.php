<?php

namespace App\Filament\Resources\Posts\Tables;

use App\Models\Post;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ReplicateAction;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor\TextColor;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;


class PostsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->weight('bold')
                    ->color('primary'),
                ImageColumn::make('image')->disk("public")->toggleable(),
                TextColumn::make('title')->sortable()->searchable()->toggleable(),
                TextColumn::make('slug')->sortable()->searchable()->toggleable(),
                TextColumn::make('category.name')->sortable()->searchable()->toggleable(),
                ColorColumn::make('color')->toggleable(),
                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('tags')
                    ->label('Tags')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->weight('bold')
                    ->color('primary'),
                IconColumn::make('published')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])->defaultSort('title', 'asc')
            ->filters([
                Filter::make('created_at')
                    ->label('Creation date')
                    ->schema([
                        DatePicker::make('created_from')
                            ->label('Select date'),
                    ])->query(function ($query, array $data) {
                        return $query
                            ->when($data['created_from'], function ($q, $date) {
                                $q->whereDate('created_at', $date);
                            });
                    }),
                    SelectFilter::make('category_id')
                        ->label('Select Category')
                        ->relationship('category', 'name')
                        ->preload(),
            ])
            ->recordActions([
                EditAction::make(),
                ReplicateAction::make(),
                DeleteAction::make(),
                Action::make('Status')
                    ->label('Status Change')
                    ->icon('heroicon-o-academic-cap')
                    ->schema([
                        Checkbox::make('published'),
                    ])
                    ->action(function (array $data, Post $record): void {
                        $record->published = $data['published'];
                        $record->save();
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}