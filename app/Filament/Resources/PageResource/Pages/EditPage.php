<?php

namespace App\Filament\Resources\PageResource\Pages;

use App\Filament\Resources\PageResource;
use App\Models\Page;
use App\Models\SectionBlock;
use App\Models\SectionItem;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Arr;

class EditPage extends EditRecord
{
    protected static string $resource = PageResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        /** @var Page $page */
        $page = $this->record;
        $this->ensureSectionBlocks($page);

        $page->load(['sectionBlocks.items']);
        $sectionContent = [];

        foreach (config("company_profile.section_keys.{$page->slug}", []) as $index => $sectionKey) {
            $block = $page->sectionBlocks->firstWhere('section_key', $sectionKey);

            $sectionContent[$sectionKey] = [
                'section_title' => $block?->section_title ?? $this->defaultSectionTitle($sectionKey),
                'section_description' => $block?->section_description,
                'is_active' => $block?->is_active ?? true,
                'items' => $block
                    ? $block->items->sortBy('order_index')->values()->map(function (SectionItem $item): array {
                        return [
                            'id' => $item->id,
                            'title' => $item->title,
                            'description' => $item->description,
                            'badge' => $item->badge,
                            'order_index' => $item->order_index,
                            'extra' => $item->extra,
                        ];
                    })->all()
                    : [],
            ];
        }

        $data['section_content'] = $sectionContent;

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        unset($data['section_content']);

        return $data;
    }

    protected function afterSave(): void
    {
        /** @var Page $page */
        $page = $this->record;
        $state = $this->form->getState();
        $sectionContent = Arr::get($state, 'section_content', []);

        foreach (config("company_profile.section_keys.{$page->slug}", []) as $index => $sectionKey) {
            $payload = Arr::get($sectionContent, $sectionKey, []);

            $block = SectionBlock::query()->updateOrCreate(
                ['page_id' => $page->id, 'section_key' => $sectionKey],
                [
                    'section_title' => Arr::get($payload, 'section_title', $this->defaultSectionTitle($sectionKey)),
                    'section_description' => Arr::get($payload, 'section_description'),
                    'is_active' => (bool) Arr::get($payload, 'is_active', true),
                    'order_index' => $index,
                ]
            );

            $this->syncSectionItems($block, Arr::get($payload, 'items', []));
        }
    }

    private function ensureSectionBlocks(Page $page): void
    {
        foreach (config("company_profile.section_keys.{$page->slug}", []) as $index => $sectionKey) {
            SectionBlock::query()->updateOrCreate(
                ['page_id' => $page->id, 'section_key' => $sectionKey],
                [
                    'section_title' => $this->defaultSectionTitle($sectionKey),
                    'section_description' => null,
                    'order_index' => $index,
                    'is_active' => true,
                ]
            );
        }
    }

    /**
     * @param  array<int, array<string, mixed>>  $items
     */
    private function syncSectionItems(SectionBlock $block, array $items): void
    {
        $keptIds = [];

        foreach (array_values($items) as $index => $itemData) {
            $title = trim((string) Arr::get($itemData, 'title', ''));

            if ($title === '') {
                continue;
            }

            $itemId = Arr::get($itemData, 'id');
            $item = null;

            if ($itemId) {
                $item = SectionItem::query()
                    ->where('id', $itemId)
                    ->where('section_block_id', $block->id)
                    ->first();
            }

            if (! $item) {
                $item = new SectionItem();
                $item->section_block_id = $block->id;
            }

            $item->fill([
                'title' => $title,
                'description' => Arr::get($itemData, 'description'),
                'badge' => Arr::get($itemData, 'badge'),
                'order_index' => $index,
                'extra' => Arr::get($itemData, 'extra'),
            ]);
            $item->save();

            $keptIds[] = $item->id;
        }

        if (count($keptIds) === 0) {
            $block->items()->delete();

            return;
        }

        $block->items()->whereNotIn('id', $keptIds)->delete();
    }

    private function defaultSectionTitle(string $sectionKey): string
    {
        return match ($sectionKey) {
            'cta' => 'FAQ',
            default => str($sectionKey)->replace('_', ' ')->title()->toString(),
        };
    }
}
