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
            $items = $block
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
                : [];

            if ($sectionKey === 'snapshot' && count($items) === 0) {
                $items = $this->defaultSnapshotItems();
            }

            $sectionContent[$sectionKey] = [
                'section_title' => $block?->section_title ?? $this->defaultSectionTitle($sectionKey),
                'section_description' => $block?->section_description ?? $this->defaultSectionDescription($sectionKey),
                'is_active' => $block?->is_active ?? true,
                'items' => $items,
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
                    'section_description' => $this->defaultSectionDescription($sectionKey),
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
        $snapshotBadges = ['founded', 'group', 'focus_1', 'focus_2'];

        foreach (array_values($items) as $index => $itemData) {
            $title = trim((string) Arr::get($itemData, 'title', ''));
            $description = trim(strip_tags((string) Arr::get($itemData, 'description', '')));

            if ($title === '' && $description === '') {
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
                'title' => $title !== '' ? $title : 'Item '.($index + 1),
                'description' => Arr::get($itemData, 'description'),
                'badge' => $block->section_key === 'snapshot'
                    ? (Arr::get($itemData, 'badge') ?: ($snapshotBadges[$index] ?? null))
                    : Arr::get($itemData, 'badge'),
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
            'training_blocks' => 'IT Training',
            'outsourcing_blocks' => 'IT Outsourcing',
            default => str($sectionKey)->replace('_', ' ')->title()->toString(),
        };
    }

    private function defaultSectionDescription(string $sectionKey): ?string
    {
        return match ($sectionKey) {
            'who_we_are' => 'PT. Systech Talenta Digital (DigiTalent) is a technology company and strategic partner for digital transformation. We focus on two core services: IT Training and IT Outsourcing. We believe digital progress depends on skilled people who can adapt and perform in real environments.',
            'where_we_come_from' => 'DigiTalent is part of SGI Asia Group, an IT group established in 2013. We originated from the training division of PT. Systech Global Informasi and later became an independent company. With strong industry experience and networks, we address two key needs: developing competent professionals and providing industry-ready talent. Our goal is to connect industry demands with available skills through structured training and reliable outsourcing services.',
            'commitment' => 'Our commitment is to bridge the gap between industry demands and talent availability. Through structured training programs and flexible, trusted outsourcing services, we empower individuals and organizations to excel in a competitive digital future.',
            'vision' => 'To be the leading strategic partner in developing and providing superior, innovative, and globally competitive digital talent to support international-standard digital transformation',
            'training_blocks' => 'We accommodate a wide range of industry-relevant IT training and certification needs. We ensure that participants gain in-depth understanding and practical expertise through dedicated mentoring in preparation for certification exams.',
            'outsourcing_blocks' => 'We assist companies in sourcing and managing top-tier IT experts for both short-term and long-term engagements. Through our flexible outsourcing model, we ensure cost efficiency, high-quality performance, and data security.',
            default => null,
        };
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    private function defaultSnapshotItems(): array
    {
        return [
            ['badge' => 'founded', 'title' => 'Founded', 'description' => 'Aug 2025'],
            ['badge' => 'group', 'title' => 'Group', 'description' => 'SGI Asia'],
            ['badge' => 'focus_1', 'title' => 'IT Training', 'description' => 'Structured learning, mentoring, certification preparation, and applied capability development.'],
            ['badge' => 'focus_2', 'title' => 'IT Outsourcing', 'description' => 'Trusted IT talent supply for project, operational, and long-term business needs.'],
        ];
    }
}
