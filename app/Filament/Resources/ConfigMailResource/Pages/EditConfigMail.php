<?php

namespace App\Filament\Resources\ConfigMailResource\Pages;

use App\Filament\Resources\ConfigMailResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditConfigMail extends EditRecord
{
    protected static string $resource = ConfigMailResource::class;

    // protected function getHeaderActions(): array
    // {
    //     return [
    //         Actions\DeleteAction::make(),
    //     ];
    // }
}
