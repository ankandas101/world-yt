<?php

namespace App\Filament\Resources\RobustSeoResource\Pages;

use App\Filament\Resources\RobustSeoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRobustSeo extends EditRecord
{
    protected static string $resource = RobustSeoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
