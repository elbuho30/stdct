<?php

namespace App\Filament\Resources\AhorrovistaResource\Pages;

use App\Filament\Resources\AhorrovistaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAhorrovistas extends ListRecords
{
    protected static string $resource = AhorrovistaResource::class;

    protected function getHeaderActions(): array
    {
        return [
          //  Actions\CreateAction::make(),
        ];
    }
}
