<?php

namespace App\Filament\Pages;

use App\Models\TrainingContent;
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

class TrainingContentSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationLabel = 'Konten Training';
    protected static ?string $title = 'Edit Konten Training';
    protected static ?string $slug = 'content/training';
    protected static string | UnitEnum | null $navigationGroup = 'Manajemen Konten';
    protected static ?int $navigationSort = 15;
    protected string $view = 'filament.pages.home-content-settings';

    public ?array $data = [];
    public TrainingContent $record;

    public function mount(): void
    {
        $this->record = TrainingContent::query()->firstOrCreate(['id' => 1]);
        $this->form->model($this->record)->fill($this->record->toArray());
    }

    public function form(Schema $schema): Schema
    {
        return $schema->statePath('data')->model($this->record)->components([
            Tabs::make('training_tabs')->tabs([
                Tab::make('Hero')->schema([
                    Grid::make(2)->schema([
                        Forms\Components\TextInput::make('hero_title.id')->label('Judul Hero (ID)')->required(),
                        Forms\Components\TextInput::make('hero_title.en')->label('Hero Title (EN)')->required(),
                    ]),
                    Forms\Components\Radio::make('hero_background_mode')
                        ->label('Mode Background Hero')
                        ->options([
                            'color' => 'Warna Default',
                            'image' => 'Background Image',
                        ])
                        ->default('color')
                        ->inline()
                        ->inlineLabel(false)
                        ->columnSpanFull()
                        ->helperText('Jika pilih Warna Default, foto tidak ditampilkan di frontend tetapi file tetap tersimpan.'),
                    Forms\Components\SpatieMediaLibraryFileUpload::make('hero_background')
                        ->collection('hero_background')
                        ->label('Background Hero')
                        ->image()
                        ->imageEditor()
                        ->maxSize(4096),
                    Forms\Components\Repeater::make('hero_cards')->label('Hero Cards')->minItems(2)->maxItems(2)->defaultItems(2)->addable(false)->deletable(false)->reorderable(false)
                        ->schema([
                            Forms\Components\TextInput::make('title.id')->label('Title (ID)')->required(),
                            Forms\Components\TextInput::make('title.en')->label('Title (EN)')->required(),
                            Forms\Components\Textarea::make('body.id')->label('Body (ID)')->rows(2)->required(),
                            Forms\Components\Textarea::make('body.en')->label('Body (EN)')->rows(2)->required(),
                        ])->columns(2),
                ]),
                Tab::make('Domain Training')->schema([
                    Forms\Components\Repeater::make('domains')->label('Training Domains')
                        ->minItems(8)->maxItems(8)->defaultItems(8)
                        ->addable(false)->deletable(false)->reorderable(false)
                        ->schema([
                            Forms\Components\TextInput::make('title.id')->label('Title (ID)')->required(),
                            Forms\Components\TextInput::make('title.en')->label('Title (EN)')->required(),
                            Forms\Components\Textarea::make('body.id')->label('Body (ID)')->rows(2)->required(),
                            Forms\Components\Textarea::make('body.en')->label('Body (EN)')->rows(2)->required(),
                            Forms\Components\TextInput::make('badge.id')->label('Badge (ID)')->required(),
                            Forms\Components\TextInput::make('badge.en')->label('Badge (EN)')->required(),
                        ])->columns(2),
                ]),
            ])->columnSpanFull(),
        ]);
    }

    public function save(): void
    {
        $this->record->update($this->form->getState());

        Notification::make()->title('Konten Training berhasil diperbarui')->success()->send();
    }
}
