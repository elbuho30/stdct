<?php

namespace App\Filament\Resources\TipodocumentoResource\Pages;

use App\Filament\Resources\TipodocumentoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTipodocumentos extends ListRecords
{
    protected static string $resource = TipodocumentoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
