<?php

namespace App\Filament\Resources\ConfigRecaptchaResource\Pages;

use App\Filament\Resources\ConfigRecaptchaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditConfigRecaptcha extends EditRecord
{
    protected static string $resource = ConfigRecaptchaResource::class;

    // protected function getHeaderActions(): array
    // {
    //     return [
    //         Actions\DeleteAction::make(),
    //     ];
    // }
}
