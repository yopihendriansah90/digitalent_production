<?php

namespace App\Services\Content;

use App\Models\Page;
use App\Models\SiteSetting;

class PageContentService
{
    public function getSiteSetting(): ?SiteSetting
    {
        return SiteSetting::query()->first();
    }

    /**
     * @return array{page: ?Page, sections: array<string, mixed>}
     */
    public function getPageContent(string $slug): array
    {
        $page = Page::query()
            ->where('slug', $slug)
            ->where('is_published', true)
            ->with([
                'sectionBlocks' => fn ($query) => $query
                    ->where('is_active', true)
                    ->orderBy('order_index')
                    ->with(['items' => fn ($itemQuery) => $itemQuery->orderBy('order_index')]),
            ])
            ->first();

        if (! $page) {
            return ['page' => null, 'sections' => []];
        }

        $sections = $page->sectionBlocks
            ->keyBy('section_key')
            ->all();

        return [
            'page' => $page,
            'sections' => $sections,
        ];
    }
}
