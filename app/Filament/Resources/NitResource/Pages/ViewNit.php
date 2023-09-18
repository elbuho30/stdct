<?php

namespace App\Filament\Resources\NitResource\Pages;

use App\Filament\Resources\NitResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewNit extends ViewRecord
{
    protected static string $resource = NitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
