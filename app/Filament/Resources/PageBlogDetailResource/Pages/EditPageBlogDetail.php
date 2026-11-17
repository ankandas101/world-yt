<?php

namespace App\Filament\Resources\PageBlogDetailResource\Pages;

use App\Filament\Resources\PageBlogDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPageBlogDetail extends EditRecord
{
    protected static string $resource = PageBlogDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
