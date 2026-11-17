<?php

namespace App\Filament\Resources\PageHomeResource\Pages;

use App\Filament\Resources\PageHomeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPageHome extends EditRecord
{
    protected static string $resource = PageHomeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
