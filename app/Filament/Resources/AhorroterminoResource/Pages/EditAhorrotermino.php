<?php

namespace App\Filament\Resources\AhorroterminoResource\Pages;

use App\Filament\Resources\AhorroterminoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAhorrotermino extends EditRecord
{
    protected static string $resource = AhorroterminoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
