<?php

namespace App\Filament\Resources\AhorrocontractualResource\Pages;

use App\Filament\Resources\AhorrocontractualResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewAhorrocontractual extends ViewRecord
{
    protected static string $resource = AhorrocontractualResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
