<?php

namespace App\Filament\Pages;

use App\Models\ServicesContent;
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

class ServicesContentSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationLabel = 'Services';
    protected static ?string $title = 'Edit Services';
    protected static ?string $slug = 'content/services';
    protected static string | UnitEnum | null $navigationGroup = 'Konten Website';
    protected static ?int $navigationSort = 3;
    protected string $view = 'filament.pages.home-content-settings';

    public ?array $data = [];
    public ServicesContent $record;

    public function mount(): void
    {
        $this->record = ServicesContent::query()->firstOrCreate(['id' => 1]);
        $this->form->model($this->record)->fill($this->record->toArray());
    }

    public function form(Schema $schema): Schema
    {
        return $schema->statePath('data')->model($this->record)->components([
            Tabs::make('services_tabs')->tabs([
                Tab::make('Hero')->schema([
                    Grid::make(2)->schema([
                        Forms\Components\TextInput::make('hero_title.id')->label('Judul Hero (ID)')->required(),
                        Forms\Components\TextInput::make('hero_title.en')->label('Hero Title (EN)')->required(),
                    ]),
                    Forms\Components\SpatieMediaLibraryFileUpload::make('hero_background')->collection('hero_background')->label('Background Hero')->image()->imageEditor()->maxSize(4096),
                    Forms\Components\Repeater::make('hero_cards')->label('Hero Cards')->minItems(2)->maxItems(2)->defaultItems(2)->reorderable(false)->addable(false)->deletable(false)
                        ->schema([
                            Forms\Components\TextInput::make('title.id')->label('Title (ID)')->required(),
                            Forms\Components\TextInput::make('title.en')->label('Title (EN)')->required(),
                            Forms\Components\Textarea::make('body.id')->label('Body (ID)')->rows(2)->required(),
                            Forms\Components\Textarea::make('body.en')->label('Body (EN)')->rows(2)->required(),
                        ])->columns(2),
                ]),
                Tab::make('IT Training')->schema([
                    Grid::make(2)->schema([
                        Forms\Components\TextInput::make('training_kicker.id')->label('Kicker (ID)'),
                        Forms\Components\TextInput::make('training_kicker.en')->label('Kicker (EN)'),
                        Forms\Components\TextInput::make('training_title.id')->label('Judul (ID)'),
                        Forms\Components\TextInput::make('training_title.en')->label('Title (EN)'),
                        Forms\Components\Textarea::make('training_body.id')->label('Deskripsi (ID)')->rows(3),
                        Forms\Components\Textarea::make('training_body.en')->label('Description (EN)')->rows(3),
                    ]),
                    Forms\Components\Repeater::make('training_overview_items')->label('Overview Cards')->minItems(2)->maxItems(2)->defaultItems(2)->addable(false)->deletable(false)->reorderable(false)
                        ->schema([
                            Forms\Components\TextInput::make('title.id')->label('Title (ID)'),
                            Forms\Components\TextInput::make('title.en')->label('Title (EN)'),
                            Forms\Components\Textarea::make('body.id')->label('Body (ID)')->rows(2),
                            Forms\Components\Textarea::make('body.en')->label('Body (EN)')->rows(2),
                        ])->columns(2),
                    Grid::make(2)->schema([
                        Forms\Components\TextInput::make('domain_kicker.id')->label('Domain Kicker (ID)'),
                        Forms\Components\TextInput::make('domain_kicker.en')->label('Domain Kicker (EN)'),
                        Forms\Components\TextInput::make('domain_title.id')->label('Domain Title (ID)'),
                        Forms\Components\TextInput::make('domain_title.en')->label('Domain Title (EN)'),
                        Forms\Components\Textarea::make('domain_body.id')->label('Domain Body (ID)')->rows(3),
                        Forms\Components\Textarea::make('domain_body.en')->label('Domain Body (EN)')->rows(3),
                    ]),
                    Forms\Components\SpatieMediaLibraryFileUpload::make('domain_chart_image')->collection('domain_chart_image')->label('Domain Chart Image')->image()->imageEditor()->maxSize(4096),
                    Grid::make(2)->schema([
                        Forms\Components\TextInput::make('mentored_kicker.id')->label('Mentored Kicker (ID)'),
                        Forms\Components\TextInput::make('mentored_kicker.en')->label('Mentored Kicker (EN)'),
                        Forms\Components\TextInput::make('mentored_title.id')->label('Mentored Title (ID)'),
                        Forms\Components\TextInput::make('mentored_title.en')->label('Mentored Title (EN)'),
                    ]),
                    Forms\Components\SpatieMediaLibraryFileUpload::make('mentored_cover_image')->collection('mentored_cover_image')->label('Mentored Cover Image')->image()->imageEditor()->maxSize(4096),
                    Forms\Components\Repeater::make('mentored_items')->label('Mentored Items')->minItems(5)->maxItems(5)->defaultItems(5)->addable(false)->deletable(false)->reorderable(false)
                        ->schema([
                            Forms\Components\FileUpload::make('icon')->label('Icon')->image()->disk('public')->directory('services/mentored-icons')->columnSpanFull(),
                            Forms\Components\TextInput::make('title.id')->label('Title (ID)'),
                            Forms\Components\TextInput::make('title.en')->label('Title (EN)'),
                            Forms\Components\Textarea::make('body.id')->label('Body (ID)')->rows(2),
                            Forms\Components\Textarea::make('body.en')->label('Body (EN)')->rows(2),
                        ])->columns(2),
                    Forms\Components\Repeater::make('support_items')->label('Support Items')->minItems(2)->maxItems(2)->defaultItems(2)->addable(false)->deletable(false)->reorderable(false)
                        ->schema([
                            Forms\Components\TextInput::make('title.id')->label('Title (ID)'),
                            Forms\Components\TextInput::make('title.en')->label('Title (EN)'),
                            Forms\Components\Textarea::make('body.id')->label('Body (ID)')->rows(2),
                            Forms\Components\Textarea::make('body.en')->label('Body (EN)')->rows(2),
                        ])->columns(2),
                ]),
                Tab::make('IT Outsourcing')->schema([
                    Grid::make(2)->schema([
                        Forms\Components\TextInput::make('outsourcing_kicker.id')->label('Kicker (ID)'),
                        Forms\Components\TextInput::make('outsourcing_kicker.en')->label('Kicker (EN)'),
                        Forms\Components\TextInput::make('outsourcing_title.id')->label('Judul (ID)'),
                        Forms\Components\TextInput::make('outsourcing_title.en')->label('Title (EN)'),
                        Forms\Components\Textarea::make('outsourcing_body.id')->label('Deskripsi (ID)')->rows(3),
                        Forms\Components\Textarea::make('outsourcing_body.en')->label('Description (EN)')->rows(3),
                    ]),
                    Forms\Components\Repeater::make('outsourcing_overview_items')->label('Overview Items')->minItems(2)->maxItems(2)->defaultItems(2)->addable(false)->deletable(false)->reorderable(false)
                        ->schema([
                            Forms\Components\TextInput::make('title.id')->label('Title (ID)'),
                            Forms\Components\TextInput::make('title.en')->label('Title (EN)'),
                            Forms\Components\Textarea::make('body.id')->label('Body (ID)')->rows(2),
                            Forms\Components\Textarea::make('body.en')->label('Body (EN)')->rows(2),
                        ])->columns(2),
                    Grid::make(2)->schema([
                        Forms\Components\TextInput::make('talent_kicker.id')->label('Talent Kicker (ID)'),
                        Forms\Components\TextInput::make('talent_kicker.en')->label('Talent Kicker (EN)'),
                        Forms\Components\TextInput::make('talent_title.id')->label('Talent Title (ID)'),
                        Forms\Components\TextInput::make('talent_title.en')->label('Talent Title (EN)'),
                    ]),
                    Forms\Components\Repeater::make('talent_profiles')->label('Talent Profiles')->minItems(4)->maxItems(4)->defaultItems(4)->addable(false)->deletable(false)->reorderable(false)
                        ->schema([
                            Forms\Components\FileUpload::make('icon')->label('Icon')->image()->disk('public')->directory('services/talent-icons')->columnSpanFull(),
                            Forms\Components\TextInput::make('title.id')->label('Title (ID)'),
                            Forms\Components\TextInput::make('title.en')->label('Title (EN)'),
                            Forms\Components\Textarea::make('body.id')->label('Body (ID)')->rows(2),
                            Forms\Components\Textarea::make('body.en')->label('Body (EN)')->rows(2),
                        ])->columns(2),
                    Grid::make(2)->schema([
                        Forms\Components\TextInput::make('selection_kicker.id')->label('Selection Kicker (ID)'),
                        Forms\Components\TextInput::make('selection_kicker.en')->label('Selection Kicker (EN)'),
                        Forms\Components\TextInput::make('selection_title.id')->label('Selection Title (ID)'),
                        Forms\Components\TextInput::make('selection_title.en')->label('Selection Title (EN)'),
                    ]),
                    Forms\Components\Repeater::make('selection_items')->label('Selection Items')->minItems(4)->maxItems(4)->defaultItems(4)->addable(false)->deletable(false)->reorderable(false)
                        ->schema([
                            Forms\Components\TextInput::make('title.id')->label('Title (ID)'),
                            Forms\Components\TextInput::make('title.en')->label('Title (EN)'),
                            Forms\Components\Textarea::make('body.id')->label('Body (ID)')->rows(2),
                            Forms\Components\Textarea::make('body.en')->label('Body (EN)')->rows(2),
                        ])->columns(2),
                ]),
            ])->columnSpanFull(),
        ]);
    }

    public function save(): void
    {
        $this->record->update($this->form->getState());

        Notification::make()->title('Services berhasil diperbarui')->success()->send();
    }
}
