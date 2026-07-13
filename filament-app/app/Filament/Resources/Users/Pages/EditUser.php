<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Actions\DeleteAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Filament\Support\Icons\Heroicon;
use Override;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                // ->successNotificationTitle("User deleted")
                ->successNotification(
                    Notification::make()
                        ->title("User updated ")
                        ->body("User updted successfully")
                        ->icon(Heroicon::AcademicCap)
                        ->success()
                    ),
        ];
    }
    #[Override]
    protected function getSavedNotificationMessage(): ?string
    {
        return "User edited.";
    }
    #[Override]
    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
        ->title("User updated ")
        ->body("User updted successfully")
        ->icon(Heroicon::AcademicCap)
        ->success()
        ->send();
    }
}
