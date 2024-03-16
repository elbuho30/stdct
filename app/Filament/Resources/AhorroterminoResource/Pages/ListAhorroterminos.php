<?php

namespace App\Filament\Resources\AhorroterminoResource\Pages;

use App\Filament\Resources\AhorroterminoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAhorroterminos extends ListRecords
{
    protected static string $resource = AhorroterminoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
