<?php

namespace App\Filament\Resources\Posts\RelationManagers;

use Filament\Actions\AttachAction;
use Filament\Actions\CreateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DetachAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DetachBulkAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;

class TagsRelationManager extends RelationManager
{
    protected static string $relationship = 'tags'; 
    public static function configure(Schema $schema): Schema
{
    return $schema->components([
        TextInput::make('name')->required(),
    ]);
}

    public function table(Table $table): Table
{
    return $table
        ->columns([
            TextColumn::make('id'),
            TextColumn::make('name'),

        ])
        ->filters([
            //
        ])
        ->headerActions([
            CreateAction::make(),
            AttachAction::make(),
        ])
        ->recordActions([
            EditAction::make(),
            DetachAction::make(),
            DeleteAction::make(),
        ])
        ->toolbarActions([
            // BulkActionGroup::make([
            // DetachBulkAction::make(),
            // DeleteBulkAction::make(),
            // ]),
        ]);
}
    
}