<?php

namespace App\Filament\Resources\NitResource\Pages;

use App\Filament\Resources\NitResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNits extends ListRecords
{
    protected static string $resource = NitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
