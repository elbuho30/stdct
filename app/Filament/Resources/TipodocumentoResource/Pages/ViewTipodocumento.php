<?php

namespace App\Filament\Resources\TipodocumentoResource\Pages;

use App\Filament\Resources\TipodocumentoResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTipodocumento extends ViewRecord
{
    protected static string $resource = TipodocumentoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
