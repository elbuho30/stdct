<?php

namespace App\Filament\Resources\AportesocextResource\Pages;

use App\Filament\Resources\AportesocextResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAportesocexts extends ListRecords
{
    protected static string $resource = AportesocextResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
