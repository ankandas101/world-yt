<?php

namespace App\Filament\Resources\SiteGlobalSettingResource\Pages;

use App\Filament\Resources\SiteGlobalSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSiteGlobalSetting extends EditRecord
{
    protected static string $resource = SiteGlobalSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
