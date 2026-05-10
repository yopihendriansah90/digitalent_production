<?php

namespace App\Filament\Resources\SectionBlockResource\Pages;

use App\Filament\Resources\SectionBlockResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSectionBlocks extends ListRecords
{
    protected static string $resource = SectionBlockResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
