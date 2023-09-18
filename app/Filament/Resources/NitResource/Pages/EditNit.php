<?php

namespace App\Filament\Resources\NitResource\Pages;

use App\Filament\Resources\NitResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNit extends EditRecord
{
    protected static string $resource = NitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
