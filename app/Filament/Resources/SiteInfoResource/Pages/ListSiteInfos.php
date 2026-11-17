<?php

namespace App\Filament\Resources\SiteInfoResource\Pages;

use App\Filament\Resources\SiteInfoResource;
use App\Models\SiteInfo;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSiteInfos extends ListRecords
{
    protected static string $resource = SiteInfoResource::class;

    public function mount():void
    {
        $record = SiteInfo::firstOrCreate([]);
        $this->redirect(SiteInfoResource::getUrl('edit', ['record' => $record]));
    }
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
