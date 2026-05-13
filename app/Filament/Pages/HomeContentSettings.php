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
                'hero_title' => 'Empowering Digital Talent, Enabling Global Success',
            ]
        );

        $this->form->model($this->record)->fill($this->record->toArray());
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
                                Forms\Components\TextInput::make('hero_title')
                                    ->label('Judul Hero')
                                    ->helperText('Judul utama yang tampil paling atas pada halaman Home.')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\Textarea::make('hero_subtitle')
                                    ->label('Subjudul Hero')
                                    ->helperText('Deskripsi singkat di bawah judul hero.')
                                    ->rows(3),
                                Grid::make(2)
                                    ->schema([
                                        Forms\Components\TextInput::make('hero_primary_cta_label')
                                            ->label('Teks Tombol Utama')
                                            ->placeholder('Contoh: Explore Services')
                                            ->maxLength(100),
                                        Forms\Components\TextInput::make('hero_primary_cta_url')
                                            ->label('Link Tombol Utama')
                                            ->helperText('Gunakan URL absolut atau path internal, contoh: /services')
                                            ->maxLength(255)
                                            ->rule('regex:/^(https?:\/\/|\/).+/'),
                                        Forms\Components\TextInput::make('hero_secondary_cta_label')
                                            ->label('Teks Tombol Kedua')
                                            ->placeholder('Contoh: Free Consultation')
                                            ->maxLength(100),
                                        Forms\Components\TextInput::make('hero_secondary_cta_url')
                                            ->label('Link Tombol Kedua')
                                            ->helperText('Gunakan URL absolut atau path internal, contoh: /contact')
                                            ->maxLength(255)
                                            ->rule('regex:/^(https?:\/\/|\/).+/'),
                                    ]),
                                Forms\Components\Repeater::make('hero_proof_items')
                                    ->label('Poin Ringkas Hero')
                                    ->helperText('Jumlah item dikunci 2 agar desain tetap konsisten.')
                                    ->schema([
                                        Forms\Components\TextInput::make('label')
                                            ->label('Label')
                                            ->required()
                                            ->maxLength(100),
                                        Forms\Components\TextInput::make('value')
                                            ->label('Isi')
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
                                Forms\Components\TextInput::make('core_values_kicker')
                                    ->label('Kicker Section')
                                    ->maxLength(100),
                                Forms\Components\TextInput::make('core_values_title')
                                    ->label('Judul Section')
                                    ->maxLength(255),
                                Forms\Components\Repeater::make('core_values_items')
                                    ->label('Daftar Core Values')
                                    ->helperText('Jumlah item dikunci 5 agar layout tidak berubah.')
                                    ->schema([
                                        Forms\Components\TextInput::make('title')
                                            ->label('Judul')
                                            ->required()
                                            ->maxLength(120),
                                        Forms\Components\Textarea::make('description')
                                            ->label('Deskripsi')
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
                                Forms\Components\TextInput::make('progress_kicker')
                                    ->label('Kicker Section')
                                    ->maxLength(100),
                                Forms\Components\Repeater::make('progress_items')
                                    ->label('Daftar Progress Counter')
                                    ->helperText('Jumlah item dikunci 4 agar tampilan statistik tetap sama.')
                                    ->schema([
                                        Forms\Components\TextInput::make('label')
                                            ->label('Label')
                                            ->required()
                                            ->maxLength(100),
                                        Forms\Components\TextInput::make('value')
                                            ->label('Keterangan')
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
                                Forms\Components\TextInput::make('why_choose_kicker')
                                    ->label('Kicker Section')
                                    ->maxLength(100),
                                Forms\Components\TextInput::make('why_choose_title')
                                    ->label('Judul Section')
                                    ->maxLength(255),
                                Forms\Components\Repeater::make('why_choose_items')
                                    ->label('Daftar Alasan Memilih Kami')
                                    ->helperText('Jumlah item dikunci 5 agar desain section tetap rapi.')
                                    ->schema([
                                        Forms\Components\TextInput::make('title')
                                            ->label('Judul')
                                            ->required()
                                            ->maxLength(255),
                                        Forms\Components\Textarea::make('description')
                                            ->label('Deskripsi')
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
                                Forms\Components\TextInput::make('faq_kicker')
                                    ->label('Kicker Section')
                                    ->maxLength(100),
                                Forms\Components\TextInput::make('faq_title')
                                    ->label('Judul Section')
                                    ->maxLength(255),
                                Forms\Components\Repeater::make('faq_items')
                                    ->label('Daftar FAQ')
                                    ->helperText('Jumlah item dikunci 4 agar struktur FAQ tetap konsisten.')
                                    ->schema([
                                        Forms\Components\TextInput::make('question')
                                            ->label('Pertanyaan')
                                            ->required()
                                            ->maxLength(255),
                                        Forms\Components\Textarea::make('answer')
                                            ->label('Jawaban')
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
