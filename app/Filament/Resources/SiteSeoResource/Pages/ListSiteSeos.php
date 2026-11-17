<?php

namespace App\Filament\Resources\SiteSeoResource\Pages;

use App\Filament\Resources\SiteSeoResource;
use App\Models\SiteSeo;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSiteSeos extends ListRecords
{
    protected static string $resource = SiteSeoResource::class;

    public function mount():void
    {
        $record = SiteSeo::firstOrCreate([]);
        $this->redirect(SiteSeoResource::getUrl('edit', ['record' => $record]));
    }
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
