<?php

namespace App\Filament\Resources\Products\Pages;

use App\Filament\Resources\Products\ProductResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Forms\Components\Actions\Action;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;

    protected function getFormActions(): array
    {
        return [
            $this->getCreateFormAction()
            ->label('Save Product'), 
            $this->getCancelFormAction(),
        ];
    }
}
