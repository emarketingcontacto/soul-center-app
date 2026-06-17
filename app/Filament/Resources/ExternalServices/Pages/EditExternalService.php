<?php

namespace App\Filament\Resources\ExternalServices\Pages;

use App\Filament\Resources\ExternalServices\ExternalServiceResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditExternalService extends EditRecord
{
    protected static string $resource = ExternalServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
