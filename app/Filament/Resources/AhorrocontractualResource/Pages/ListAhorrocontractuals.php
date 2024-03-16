<?php

namespace App\Filament\Resources\AhorrocontractualResource\Pages;

use App\Filament\Resources\AhorrocontractualResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAhorrocontractuals extends ListRecords
{
    protected static string $resource = AhorrocontractualResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
