<?php

namespace App\Services\Admin;

use App\Models\AboutContent;
use App\Models\ContactContent;
use App\Models\ContactInquiry;
use App\Models\HomeContent;
use App\Models\OutsourcingContent;
use App\Models\PortfolioContent;
use App\Models\ServicesContent;
use App\Models\SiteSetting;
use App\Models\TrainingContent;
use App\Models\VisionMissionContent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class DashboardDataService
{
    /**
     * @return Collection<int, array{label:string, route:string, is_complete:bool, updated_at:mixed, missing_fields:array<int,string>}>
     */
    public function contentHealth(): Collection
    {
        $contentMap = [
            ['label' => 'Home', 'model' => HomeContent::query()->first(), 'route' => route('filament.admin.pages.content.home'), 'required' => ['hero_title']],
            ['label' => 'About Us', 'model' => AboutContent::query()->first(), 'route' => route('filament.admin.pages.content.about'), 'required' => ['hero_title', 'who_we_are_title']],
            ['label' => 'Services', 'model' => ServicesContent::query()->first(), 'route' => route('filament.admin.pages.content.services'), 'required' => ['hero_title', 'training_title']],
            ['label' => 'Vision & Mission', 'model' => VisionMissionContent::query()->first(), 'route' => route('filament.admin.pages.content.vision-mission'), 'required' => ['hero_title', 'vision_text']],
            ['label' => 'Client / Portfolio', 'model' => PortfolioContent::query()->first(), 'route' => route('filament.admin.pages.content.portfolio'), 'required' => ['hero_title', 'gallery_heading']],
            ['label' => 'Training', 'model' => TrainingContent::query()->first(), 'route' => route('filament.admin.pages.content.training'), 'required' => ['hero_title', 'domains']],
            ['label' => 'Outsourcing', 'model' => OutsourcingContent::query()->first(), 'route' => route('filament.admin.pages.content.outsourcing'), 'required' => ['hero_title', 'offer_cards']],
            ['label' => 'Contact', 'model' => ContactContent::query()->first(), 'route' => route('filament.admin.pages.content.contact'), 'required' => ['hero_title', 'contact_items']],
        ];

        return collect($contentMap)->map(function (array $item): array {
            /** @var Model|null $record */
            $record = $item['model'];
            $missingFields = $record ? $this->getMissingFields($record, $item['required']) : $item['required'];

            return [
                'label' => $item['label'],
                'route' => $item['route'],
                'is_complete' => count($missingFields) === 0,
                'updated_at' => $record?->updated_at,
                'missing_fields' => $missingFields,
            ];
        });
    }

    /**
     * @return array{total_pages:int, complete_pages:int, inquiry_new:int, last_updated:string}
     */
    public function kpis(): array
    {
        $health = $this->contentHealth();
        $lastUpdatedAt = $health->pluck('updated_at')->filter()->max();

        return [
            'total_pages' => $health->count(),
            'complete_pages' => $health->where('is_complete', true)->count(),
            'inquiry_new' => ContactInquiry::query()->where('status', ContactInquiry::STATUS_NEW)->count(),
            'last_updated' => $lastUpdatedAt instanceof Carbon ? $lastUpdatedAt->diffForHumans() : '-',
        ];
    }

    /**
     * @return array{new:int, read:int, replied:int, total:int}
     */
    public function inquiryStats(): array
    {
        return [
            'new' => ContactInquiry::query()->where('status', ContactInquiry::STATUS_NEW)->count(),
            'read' => ContactInquiry::query()->where('status', ContactInquiry::STATUS_READ)->count(),
            'replied' => ContactInquiry::query()->where('status', ContactInquiry::STATUS_REPLIED)->count(),
            'total' => ContactInquiry::query()->count(),
        ];
    }

    public function siteSettingEditUrl(): string
    {
        $siteSetting = SiteSetting::query()->first();

        return $siteSetting
            ? route('filament.admin.resources.site-settings.edit', ['record' => $siteSetting])
            : route('filament.admin.resources.site-settings.create');
    }

    public function recentInquiries(int $limit = 6): Collection
    {
        return ContactInquiry::query()->latest()->limit($limit)->get();
    }

    /**
     * @param array<int, string> $fields
     * @return array<int, string>
     */
    private function getMissingFields(Model $record, array $fields): array
    {
        $missing = [];

        foreach ($fields as $field) {
            $value = data_get($record, $field);

            if (is_array($value)) {
                if ($this->isAssoc($value)) {
                    $id = trim((string) data_get($value, 'id', ''));
                    $en = trim((string) data_get($value, 'en', ''));

                    if ($id === '') {
                        $missing[] = "{$field}.id";
                    }

                    if ($en === '') {
                        $missing[] = "{$field}.en";
                    }

                    continue;
                }

                if (count($value) === 0) {
                    $missing[] = $field;
                }

                continue;
            }

            if (is_string($value) && trim($value) === '') {
                $missing[] = $field;
                continue;
            }

            if ($value === null) {
                $missing[] = $field;
            }
        }

        return $missing;
    }

    /**
     * @param array<mixed> $array
     */
    private function isAssoc(array $array): bool
    {
        return array_keys($array) !== range(0, count($array) - 1);
    }
}
