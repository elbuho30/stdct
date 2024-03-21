<?php

namespace App\Filament\Resources\NovedavncResource\Pages;

use App\Filament\Resources\NovedavncResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNovedavncs extends ListRecords
{
    protected static string $resource = NovedavncResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
