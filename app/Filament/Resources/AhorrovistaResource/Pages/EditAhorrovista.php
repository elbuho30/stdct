<?php

namespace App\Filament\Resources\AhorrovistaResource\Pages;

use App\Filament\Resources\AhorrovistaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAhorrovista extends EditRecord
{
    protected static string $resource = AhorrovistaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
