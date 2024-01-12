<?php

namespace App\Filament\Resources\AportesocextResource\Pages;

use App\Filament\Resources\AportesocextResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewAportesocext extends ViewRecord
{
    protected static string $resource = AportesocextResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
