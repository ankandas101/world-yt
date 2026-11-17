<?php

namespace App\Filament\Resources\RobustSeoResource\Pages;

use App\Filament\Resources\RobustSeoResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewRobustSeo extends ViewRecord
{
    protected static string $resource = RobustSeoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
