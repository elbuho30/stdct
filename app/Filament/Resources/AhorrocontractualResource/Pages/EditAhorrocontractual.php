<?php

namespace App\Filament\Resources\AhorrocontractualResource\Pages;

use App\Filament\Resources\AhorrocontractualResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAhorrocontractual extends EditRecord
{
    protected static string $resource = AhorrocontractualResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
