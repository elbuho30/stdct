<?php

namespace App\Filament\Resources\NovedavncResource\Pages;

use App\Filament\Resources\NovedavncResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNovedavnc extends EditRecord
{
    protected static string $resource = NovedavncResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
