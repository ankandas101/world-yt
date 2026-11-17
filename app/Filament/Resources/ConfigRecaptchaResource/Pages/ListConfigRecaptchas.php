<?php

namespace App\Filament\Resources\ConfigRecaptchaResource\Pages;

use App\Filament\Resources\ConfigRecaptchaResource;
use App\Models\ConfigRecaptcha;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListConfigRecaptchas extends ListRecords
{
    protected static string $resource = ConfigRecaptchaResource::class;

    public function mount():void
    {
        $record = ConfigRecaptcha::firstOrCreate([]);
        $this->redirect(ConfigRecaptchaResource::getUrl('edit', ['record' => $record]));
    }
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
