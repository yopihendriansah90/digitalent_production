<?php

namespace App\Filament\Pages;

use App\Models\VisionMissionContent;
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

class VisionMissionContentSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-light-bulb';
    protected static ?string $navigationLabel = 'Konten Vision & Mission';
    protected static ?string $title = 'Edit Konten Vision & Mission';
    protected static ?string $slug = 'content/vision-mission';
    protected static string | UnitEnum | null $navigationGroup = 'Manajemen Konten';
    protected static ?int $navigationSort = 13;
    protected string $view = 'filament.pages.home-content-settings';

    public ?array $data = [];
    public VisionMissionContent $record;

    public function mount(): void
    {
        $this->record = VisionMissionContent::query()->firstOrCreate(['id' => 1]);
        $this->form->model($this->record)->fill($this->record->toArray());
    }

    public function form(Schema $schema): Schema
    {
        return $schema->statePath('data')->model($this->record)->components([
            Tabs::make('vision_mission_tabs')->tabs([
                Tab::make('Hero & Vision')->schema([
                    Grid::make(2)->schema([
                        Forms\Components\TextInput::make('hero_title.id')->label('Judul Hero (ID)')->required(),
                        Forms\Components\TextInput::make('hero_title.en')->label('Hero Title (EN)')->required(),
                    ]),
                    Forms\Components\SpatieMediaLibraryFileUpload::make('hero_background')->collection('hero_background')->label('Background Hero')->image()->imageEditor()->maxSize(4096),
                    Grid::make(2)->schema([
                        Forms\Components\TextInput::make('vision_kicker.id')->label('Kicker Visi (ID)')->required(),
                        Forms\Components\TextInput::make('vision_kicker.en')->label('Vision Kicker (EN)')->required(),
                        Forms\Components\Textarea::make('vision_text.id')->label('Teks Visi (ID)')->rows(4)->required(),
                        Forms\Components\Textarea::make('vision_text.en')->label('Vision Text (EN)')->rows(4)->required(),
                    ]),
                ]),
                Tab::make('Mission')->schema([
                    Grid::make(2)->schema([
                        Forms\Components\TextInput::make('mission_kicker.id')->label('Kicker Misi (ID)')->required(),
                        Forms\Components\TextInput::make('mission_kicker.en')->label('Mission Kicker (EN)')->required(),
                    ]),
                    Forms\Components\Repeater::make('mission_items')->label('Mission Items')->minItems(5)->maxItems(5)->defaultItems(5)->addable(false)->deletable(false)->reorderable(false)
                        ->schema([
                            Forms\Components\Textarea::make('body.id')->label('Isi Misi (ID)')->rows(3)->required()->columnSpanFull(),
                            Forms\Components\Textarea::make('body.en')->label('Mission Content (EN)')->rows(3)->required()->columnSpanFull(),
                        ])->columns(2),
                ]),
            ])->columnSpanFull(),
        ]);
    }

    public function save(): void
    {
        $this->record->update($this->form->getState());

        Notification::make()->title('Konten Vision & Mission berhasil diperbarui')->success()->send();
    }
}
