<?php

namespace App\Filament\Resources\ExternalServices\Pages;

use App\Filament\Resources\ExternalServices\ExternalServiceResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListExternalServices extends ListRecords
{
    protected static string $resource = ExternalServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
