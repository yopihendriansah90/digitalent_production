<?php

namespace App\Filament\Pages;

use App\Models\PortfolioContent;
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

class PortfolioContentSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-building-office-2';
    protected static ?string $navigationLabel = 'Konten Client / Portfolio';
    protected static ?string $title = 'Edit Konten Client / Portfolio';
    protected static ?string $slug = 'content/portfolio';
    protected static string | UnitEnum | null $navigationGroup = 'Manajemen Konten';
    protected static ?int $navigationSort = 14;
    protected string $view = 'filament.pages.home-content-settings';

    public ?array $data = [];
    public PortfolioContent $record;

    public function mount(): void
    {
        $this->record = PortfolioContent::query()->firstOrCreate(['id' => 1]);
        $this->form->model($this->record)->fill($this->record->toArray());
    }

    public function form(Schema $schema): Schema
    {
        return $schema->statePath('data')->model($this->record)->components([
            Tabs::make('portfolio_tabs')->tabs([
                Tab::make('Hero')->schema([
                    Grid::make(2)->schema([
                        Forms\Components\TextInput::make('hero_title.id')->label('Judul Hero (ID)')->required(),
                        Forms\Components\TextInput::make('hero_title.en')->label('Hero Title (EN)')->required(),
                    ]),
                    Forms\Components\SpatieMediaLibraryFileUpload::make('hero_background')->collection('hero_background')->label('Background Hero')->image()->imageEditor()->maxSize(4096),
                    Forms\Components\Repeater::make('hero_cards')->label('Hero Cards')->minItems(2)->maxItems(2)->defaultItems(2)->addable(false)->deletable(false)->reorderable(false)
                        ->schema([
                            Forms\Components\TextInput::make('title.id')->label('Title (ID)')->required(),
                            Forms\Components\TextInput::make('title.en')->label('Title (EN)')->required(),
                            Forms\Components\Textarea::make('body.id')->label('Body (ID)')->rows(2)->required(),
                            Forms\Components\Textarea::make('body.en')->label('Body (EN)')->rows(2)->required(),
                        ])->columns(2),
                ]),
                Tab::make('Client')->schema([
                    Grid::make(2)->schema([
                        Forms\Components\TextInput::make('clients_kicker.id')->label('Kicker Client (ID)')->required(),
                        Forms\Components\TextInput::make('clients_kicker.en')->label('Client Kicker (EN)')->required(),
                    ]),
                    Forms\Components\Repeater::make('client_logos')->label('Logo Client')
                        ->grid(3)
                        ->schema([
                            Forms\Components\FileUpload::make('image')->label('Logo')->image()->disk('public')->directory('portfolio/client-logos')->columnSpanFull()->required(),
                            Forms\Components\TextInput::make('name')->label('Nama Client')->required()->columnSpanFull(),
                        ])->columns(1),
                ]),
                Tab::make('Gallery')->schema([
                    Grid::make(2)->schema([
                        Forms\Components\TextInput::make('gallery_heading.id')->label('Heading Gallery (ID)')->required(),
                        Forms\Components\TextInput::make('gallery_heading.en')->label('Gallery Heading (EN)')->required(),
                    ]),
                    Forms\Components\Repeater::make('gallery_items')->label('Gallery Items')
                        ->schema([
                            Forms\Components\TextInput::make('year')->label('Tahun')->required(),
                            Forms\Components\TextInput::make('title.id')->label('Title (ID)')->required(),
                            Forms\Components\TextInput::make('title.en')->label('Title (EN)')->required(),
                            Forms\Components\Textarea::make('body.id')->label('Body (ID)')->rows(2)->required(),
                            Forms\Components\Textarea::make('body.en')->label('Body (EN)')->rows(2)->required(),
                            Forms\Components\FileUpload::make('image')->label('Gambar')->image()->disk('public')->directory('portfolio/gallery')->columnSpanFull(),
                        ])->columns(2),
                ]),
            ])->columnSpanFull(),
        ]);
    }

    public function save(): void
    {
        $this->record->update($this->form->getState());

        Notification::make()->title('Konten Client / Portfolio berhasil diperbarui')->success()->send();
    }
}
