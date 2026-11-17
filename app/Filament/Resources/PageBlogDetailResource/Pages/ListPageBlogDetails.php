<?php

namespace App\Filament\Resources\PageBlogDetailResource\Pages;

use App\Filament\Resources\PageBlogDetailResource;
use App\Models\PageBlogDetail;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPageBlogDetails extends ListRecords
{
    protected static string $resource = PageBlogDetailResource::class;

    public function mount():void
    {
        $record = PageBlogDetail::firstOrCreate([]);
        $this->redirect(PageBlogDetailResource::getUrl('edit', ['record' => $record]));
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
