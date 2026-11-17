<?php

namespace App\Filament\Resources\ConfigMailResource\Pages;

use App\Filament\Resources\ConfigMailResource;
use App\Models\ConfigMail;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListConfigMails extends ListRecords
{
    protected static string $resource = ConfigMailResource::class;

    public function mount() : void{
        $record = ConfigMail::firstOrCreate([]);
        $this->redirect(ConfigMailResource::getUrl('edit', ['record' => $record]));
    }

    // protected function getHeaderActions(): array
    // {
    //     return [
    //         Actions\CreateAction::make(),
    //     ];
    // }
}
