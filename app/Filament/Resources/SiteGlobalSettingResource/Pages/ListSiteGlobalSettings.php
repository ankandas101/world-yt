<?php

namespace App\Filament\Resources\SiteGlobalSettingResource\Pages;

use App\Filament\Resources\SiteGlobalSettingResource;
use App\Models\SiteGlobalSetting;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSiteGlobalSettings extends ListRecords
{
    protected static string $resource = SiteGlobalSettingResource::class;

    public function mount():void
    {
        $record = SiteGlobalSetting::firstOrCreate([]);
        $this->redirect(SiteGlobalSettingResource::getUrl('edit', ['record' => $record]));
    }

    // protected function getHeaderActions(): array
    // {
    //     return [
    //         Actions\CreateAction::make(),
    //     ];
    // }
}
