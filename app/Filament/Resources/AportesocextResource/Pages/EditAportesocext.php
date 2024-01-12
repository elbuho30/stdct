<?php

namespace App\Filament\Resources\AportesocextResource\Pages;

use App\Filament\Resources\AportesocextResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAportesocext extends EditRecord
{
    protected static string $resource = AportesocextResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
