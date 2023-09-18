<?php

namespace App\Filament\Resources\TipodocumentoResource\Pages;

use App\Filament\Resources\TipodocumentoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTipodocumento extends EditRecord
{
    protected static string $resource = TipodocumentoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
