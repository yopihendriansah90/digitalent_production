<?php

namespace App\Filament\Pages;

use App\Models\HomeContent;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use UnitEnum;

class HomeContentSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-home-modern';

    protected static ?string $navigationLabel = 'Konten Home';

    protected static ?string $title = 'Edit Konten Home';

    protected static ?string $slug = 'content/home';

    protected static string | UnitEnum | null $navigationGroup = 'Manajemen Konten';

    protected static ?int $navigationSort = 10;

    protected string $view = 'filament.pages.home-content-settings';

    public ?array $data = [];

    public HomeContent $record;

    public function mount(): void
    {
        $this->record = HomeContent::query()->firstOrCreate(
            ['id' => 1],
            [
                'hero_title' => ['id' => 'Memberdayakan Talenta Digital, Mendorong Sukses Global', 'en' => 'Empowering Digital Talent, Enabling Global Success'],
            ]
        );

        $this->form->model($this->record)->fill($this->normalizeState($this->record->toArray()));
    }

    private function normalizeState(array $state): array
    {
        $localeFields = [
            'hero_title',
            'hero_subtitle',
            'hero_primary_cta_label',
            'hero_primary_cta_url',
            'hero_secondary_cta_label',
            'hero_secondary_cta_url',
            'core_values_kicker',
            'core_values_title',
            'progress_kicker',
            'why_choose_kicker',
            'why_choose_title',
            'faq_kicker',
            'faq_title',
        ];

        foreach ($localeFields as $field) {
            $state[$field] = $this->toLocaleArray($state[$field] ?? null);
        }

        $state['hero_proof_items'] = collect($state['hero_proof_items'] ?? [])
            ->map(fn (array $item): array => [
                'label' => $this->toLocaleArray($item['label'] ?? null),
                'value' => $this->toLocaleArray($item['value'] ?? null),
            ])
            ->values()
            ->all();

        $state['core_values_items'] = collect($state['core_values_items'] ?? [])
            ->map(fn (array $item): array => [
                'title' => $this->toLocaleArray($item['title'] ?? null),
                'description' => $this->toLocaleArray($item['description'] ?? null),
            ])
            ->values()
            ->all();

        $state['progress_items'] = collect($state['progress_items'] ?? [])
            ->map(fn (array $item): array => [
                'label' => $this->toLocaleArray($item['label'] ?? null),
                'value' => $this->toLocaleArray($item['value'] ?? null),
                'counter' => data_get($item, 'counter'),
                'suffix' => data_get($item, 'suffix'),
            ])
            ->values()
            ->all();

        $state['why_choose_items'] = collect($state['why_choose_items'] ?? [])
            ->map(fn (array $item): array => [
                'title' => $this->toLocaleArray($item['title'] ?? null),
                'description' => $this->toLocaleArray($item['description'] ?? null),
            ])
            ->values()
            ->all();

        $state['faq_items'] = collect($state['faq_items'] ?? [])
            ->map(fn (array $item): array => [
                'question' => $this->toLocaleArray($item['question'] ?? null),
                'answer' => $this->toLocaleArray($item['answer'] ?? null),
            ])
            ->values()
            ->all();

        return $state;
    }

    private function toLocaleArray(mixed $value): array
    {
        if (is_array($value)) {
            return [
                'id' => data_get($value, 'id') ?? data_get($value, 'en'),
                'en' => data_get($value, 'en') ?? data_get($value, 'id'),
            ];
        }

        if (filled($value)) {
            return ['id' => (string) $value, 'en' => (string) $value];
        }

        return ['id' => null, 'en' => null];
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->statePath('data')
            ->model($this->record)
            ->components([
                Tabs::make('home_content_tabs')
                    ->tabs([
                        Tab::make('Hero')
                            ->schema([
                                Grid::make(2)->schema([
                                    Forms\Components\TextInput::make('hero_title.id')
                                        ->label('Judul Hero (ID)')
                                        ->required()
                                        ->maxLength(255),
                                    Forms\Components\TextInput::make('hero_title.en')
                                        ->label('Hero Title (EN)')
                                        ->required()
                                        ->maxLength(255),
                                ]),
                                Grid::make(2)->schema([
                                    Forms\Components\Textarea::make('hero_subtitle.id')
                                        ->label('Subjudul Hero (ID)')
                                        ->rows(3),
                                    Forms\Components\Textarea::make('hero_subtitle.en')
                                        ->label('Hero Subtitle (EN)')
                                        ->rows(3),
                                ]),
                                Grid::make(2)
                                    ->schema([
                                        Forms\Components\TextInput::make('hero_primary_cta_label.id')
                                            ->label('Teks Tombol Utama (ID)')
                                            ->placeholder('Contoh: Lihat Layanan')
                                            ->maxLength(100),
                                        Forms\Components\TextInput::make('hero_primary_cta_label.en')
                                            ->label('Primary Button Text (EN)')
                                            ->placeholder('Example: Explore Services')
                                            ->maxLength(100),
                                        Forms\Components\TextInput::make('hero_primary_cta_url.id')
                                            ->label('Link Tombol Utama (ID)')
                                            ->maxLength(255)
                                            ->rule('regex:/^(https?:\/\/|\/).+/'),
                                        Forms\Components\TextInput::make('hero_primary_cta_url.en')
                                            ->label('Primary Button Link (EN)')
                                            ->maxLength(255)
                                            ->rule('regex:/^(https?:\/\/|\/).+/'),
                                        Forms\Components\TextInput::make('hero_secondary_cta_label.id')
                                            ->label('Teks Tombol Kedua (ID)')
                                            ->placeholder('Contoh: Konsultasi Gratis')
                                            ->maxLength(100),
                                        Forms\Components\TextInput::make('hero_secondary_cta_label.en')
                                            ->label('Secondary Button Text (EN)')
                                            ->placeholder('Example: Free Consultation')
                                            ->maxLength(100),
                                        Forms\Components\TextInput::make('hero_secondary_cta_url.id')
                                            ->label('Link Tombol Kedua (ID)')
                                            ->maxLength(255)
                                            ->rule('regex:/^(https?:\/\/|\/).+/'),
                                        Forms\Components\TextInput::make('hero_secondary_cta_url.en')
                                            ->label('Secondary Button Link (EN)')
                                            ->maxLength(255)
                                            ->rule('regex:/^(https?:\/\/|\/).+/'),
                                    ]),
                                Forms\Components\Repeater::make('hero_proof_items')
                                    ->label('Poin Ringkas Hero')
                                    ->helperText('Jumlah item dikunci 2 agar desain tetap konsisten.')
                                    ->schema([
                                        Forms\Components\TextInput::make('label.id')
                                            ->label('Label (ID)')
                                            ->required()
                                            ->maxLength(100),
                                        Forms\Components\TextInput::make('label.en')
                                            ->label('Label (EN)')
                                            ->required()
                                            ->maxLength(100),
                                        Forms\Components\TextInput::make('value.id')
                                            ->label('Isi (ID)')
                                            ->required()
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('value.en')
                                            ->label('Value (EN)')
                                            ->required()
                                            ->maxLength(255),
                                    ])
                                    ->defaultItems(2)
                                    ->minItems(2)
                                    ->maxItems(2)
                                    ->reorderable(false)
                                    ->addable(false)
                                    ->deletable(false)
                                    ->columns(2),
                                Grid::make(3)
                                    ->schema([
                                        Forms\Components\SpatieMediaLibraryFileUpload::make('hero_background_1')
                                            ->collection('hero_background_1')
                                            ->label('Background Hero 1')
                                            ->image()
                                            ->imageEditor()
                                            ->helperText('Rekomendasi rasio 16:9, ukuran maksimal 4 MB.')
                                            ->maxSize(4096),
                                        Forms\Components\SpatieMediaLibraryFileUpload::make('hero_background_2')
                                            ->collection('hero_background_2')
                                            ->label('Background Hero 2')
                                            ->image()
                                            ->imageEditor()
                                            ->helperText('Rekomendasi rasio 16:9, ukuran maksimal 4 MB.')
                                            ->maxSize(4096),
                                        Forms\Components\SpatieMediaLibraryFileUpload::make('hero_background_3')
                                            ->collection('hero_background_3')
                                            ->label('Background Hero 3')
                                            ->image()
                                            ->imageEditor()
                                            ->helperText('Rekomendasi rasio 16:9, ukuran maksimal 4 MB.')
                                            ->maxSize(4096),
                                    ]),
                            ]),
                        Tab::make('Core Values')
                            ->schema([
                                Grid::make(2)->schema([
                                    Forms\Components\TextInput::make('core_values_kicker.id')->label('Kicker (ID)')->maxLength(100),
                                    Forms\Components\TextInput::make('core_values_kicker.en')->label('Kicker (EN)')->maxLength(100),
                                    Forms\Components\TextInput::make('core_values_title.id')->label('Judul Section (ID)')->maxLength(255),
                                    Forms\Components\TextInput::make('core_values_title.en')->label('Section Title (EN)')->maxLength(255),
                                ]),
                                Forms\Components\Repeater::make('core_values_items')
                                    ->label('Daftar Core Values')
                                    ->helperText('Jumlah item dikunci 5 agar layout tidak berubah.')
                                    ->schema([
                                        Forms\Components\TextInput::make('title.id')
                                            ->label('Judul (ID)')
                                            ->required()
                                            ->maxLength(120),
                                        Forms\Components\TextInput::make('title.en')
                                            ->label('Title (EN)')
                                            ->required()
                                            ->maxLength(120),
                                        Forms\Components\Textarea::make('description.id')
                                            ->label('Deskripsi (ID)')
                                            ->rows(2)
                                            ->required(),
                                        Forms\Components\Textarea::make('description.en')
                                            ->label('Description (EN)')
                                            ->rows(2)
                                            ->required(),
                                    ])
                                    ->defaultItems(5)
                                    ->minItems(5)
                                    ->maxItems(5)
                                    ->reorderable(false)
                                    ->addable(false)
                                    ->deletable(false)
                                    ->columns(2),
                            ]),
                        Tab::make('Progress Counter')
                            ->schema([
                                Grid::make(2)->schema([
                                    Forms\Components\TextInput::make('progress_kicker.id')->label('Kicker (ID)')->maxLength(100),
                                    Forms\Components\TextInput::make('progress_kicker.en')->label('Kicker (EN)')->maxLength(100),
                                ]),
                                Forms\Components\Repeater::make('progress_items')
                                    ->label('Daftar Progress Counter')
                                    ->helperText('Jumlah item dikunci 4 agar tampilan statistik tetap sama.')
                                    ->schema([
                                        Forms\Components\TextInput::make('label.id')
                                            ->label('Label (ID)')
                                            ->required()
                                            ->maxLength(100),
                                        Forms\Components\TextInput::make('label.en')
                                            ->label('Label (EN)')
                                            ->required()
                                            ->maxLength(100),
                                        Forms\Components\TextInput::make('value.id')
                                            ->label('Keterangan (ID)')
                                            ->required()
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('value.en')
                                            ->label('Description (EN)')
                                            ->required()
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('counter')
                                            ->label('Angka')
                                            ->numeric()
                                            ->required(),
                                        Forms\Components\TextInput::make('suffix')
                                            ->label('Akhiran')
                                            ->placeholder('Contoh: +')
                                            ->maxLength(8),
                                    ])
                                    ->defaultItems(4)
                                    ->minItems(4)
                                    ->maxItems(4)
                                    ->reorderable(false)
                                    ->addable(false)
                                    ->deletable(false)
                                    ->columns(2),
                            ]),
                        Tab::make('Why Choose Us')
                            ->schema([
                                Grid::make(2)->schema([
                                    Forms\Components\TextInput::make('why_choose_kicker.id')->label('Kicker (ID)')->maxLength(100),
                                    Forms\Components\TextInput::make('why_choose_kicker.en')->label('Kicker (EN)')->maxLength(100),
                                    Forms\Components\TextInput::make('why_choose_title.id')->label('Judul Section (ID)')->maxLength(255),
                                    Forms\Components\TextInput::make('why_choose_title.en')->label('Section Title (EN)')->maxLength(255),
                                ]),
                                Forms\Components\Repeater::make('why_choose_items')
                                    ->label('Daftar Alasan Memilih Kami')
                                    ->helperText('Jumlah item dikunci 5 agar desain section tetap rapi.')
                                    ->schema([
                                        Forms\Components\TextInput::make('title.id')
                                            ->label('Judul (ID)')
                                            ->required()
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('title.en')
                                            ->label('Title (EN)')
                                            ->required()
                                            ->maxLength(255),
                                        Forms\Components\Textarea::make('description.id')
                                            ->label('Deskripsi (ID)')
                                            ->rows(3)
                                            ->required(),
                                        Forms\Components\Textarea::make('description.en')
                                            ->label('Description (EN)')
                                            ->rows(3)
                                            ->required(),
                                    ])
                                    ->defaultItems(5)
                                    ->minItems(5)
                                    ->maxItems(5)
                                    ->reorderable(false)
                                    ->addable(false)
                                    ->deletable(false)
                                    ->columns(2),
                            ]),
                        Tab::make('FAQ')
                            ->schema([
                                Grid::make(2)->schema([
                                    Forms\Components\TextInput::make('faq_kicker.id')->label('Kicker (ID)')->maxLength(100),
                                    Forms\Components\TextInput::make('faq_kicker.en')->label('Kicker (EN)')->maxLength(100),
                                    Forms\Components\TextInput::make('faq_title.id')->label('Judul Section (ID)')->maxLength(255),
                                    Forms\Components\TextInput::make('faq_title.en')->label('Section Title (EN)')->maxLength(255),
                                ]),
                                Forms\Components\Repeater::make('faq_items')
                                    ->label('Daftar FAQ')
                                    ->helperText('Jumlah item dikunci 4 agar struktur FAQ tetap konsisten.')
                                    ->schema([
                                        Forms\Components\TextInput::make('question.id')
                                            ->label('Pertanyaan (ID)')
                                            ->required()
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('question.en')
                                            ->label('Question (EN)')
                                            ->required()
                                            ->maxLength(255),
                                        Forms\Components\Textarea::make('answer.id')
                                            ->label('Jawaban (ID)')
                                            ->rows(3)
                                            ->required(),
                                        Forms\Components\Textarea::make('answer.en')
                                            ->label('Answer (EN)')
                                            ->rows(3)
                                            ->required(),
                                    ])
                                    ->defaultItems(4)
                                    ->minItems(4)
                                    ->maxItems(4)
                                    ->reorderable(false)
                                    ->addable(false)
                                    ->deletable(false)
                                    ->columns(2),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public function save(): void
    {
        $state = $this->form->getState();

        $this->record->update($state);

        Notification::make()
            ->title('Konten Home berhasil diperbarui')
            ->success()
            ->send();
    }
}
