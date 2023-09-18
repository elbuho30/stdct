<?php

namespace App\Filament\Resources\AgenciaResource\Pages;

use App\Filament\Resources\AgenciaResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewAgencia extends ViewRecord
{
    protected static string $resource = AgenciaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
