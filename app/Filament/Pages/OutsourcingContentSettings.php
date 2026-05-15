<?php

namespace App\Filament\Pages;

use App\Models\OutsourcingContent;
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

class OutsourcingContentSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Konten Outsourcing';
    protected static ?string $title = 'Edit Konten Outsourcing';
    protected static ?string $slug = 'content/outsourcing';
    protected static string | UnitEnum | null $navigationGroup = 'Manajemen Konten';
    protected static ?int $navigationSort = 16;
    protected string $view = 'filament.pages.home-content-settings';

    public ?array $data = [];
    public OutsourcingContent $record;

    public function mount(): void
    {
        $this->record = OutsourcingContent::query()->firstOrCreate(['id' => 1]);
        $this->form->model($this->record)->fill($this->record->toArray());
    }

    public function form(Schema $schema): Schema
    {
        return $schema->statePath('data')->model($this->record)->components([
            Tabs::make('outsourcing_tabs')->tabs([
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
                        ->columnSpanFull(),
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
                Tab::make('Outsourcing Offer')->schema([
                    Forms\Components\Repeater::make('offer_cards')->label('Offer Cards')
                        ->minItems(4)->maxItems(4)->defaultItems(4)
                        ->addable(false)->deletable(false)->reorderable(false)
                        ->schema([
                            Forms\Components\FileUpload::make('icon')->label('Icon')->image()->disk('public')->directory('outsourcing/icons')->columnSpanFull(),
                            Forms\Components\TextInput::make('title.id')->label('Title (ID)')->required(),
                            Forms\Components\TextInput::make('title.en')->label('Title (EN)')->required(),
                            Forms\Components\RichEditor::make('body.id')->label('Body (ID)')->required()->columnSpanFull(),
                            Forms\Components\RichEditor::make('body.en')->label('Body (EN)')->required()->columnSpanFull(),
                        ])->columns(2),
                ]),
                Tab::make('Selection Process')->schema([
                    Grid::make(2)->schema([
                        Forms\Components\TextInput::make('selection_kicker.id')->label('Kicker (ID)')->required(),
                        Forms\Components\TextInput::make('selection_kicker.en')->label('Kicker (EN)')->required(),
                        Forms\Components\Textarea::make('selection_title.id')->label('Judul Section (ID)')->rows(3)->required(),
                        Forms\Components\Textarea::make('selection_title.en')->label('Section Title (EN)')->rows(3)->required(),
                    ]),
                    Forms\Components\Repeater::make('benefit_items')->label('Benefit Items')
                        ->minItems(4)->maxItems(4)->defaultItems(4)
                        ->addable(false)->deletable(false)->reorderable(false)
                        ->schema([
                            Forms\Components\FileUpload::make('icon')->label('Icon')->image()->disk('public')->directory('outsourcing/benefit-icons')->columnSpanFull(),
                            Forms\Components\RichEditor::make('body.id')->label('Body (ID)')->required()->columnSpanFull(),
                            Forms\Components\RichEditor::make('body.en')->label('Body (EN)')->required()->columnSpanFull(),
                        ])->columns(2),
                ]),
            ])->columnSpanFull(),
        ]);
    }

    public function save(): void
    {
        $this->record->update($this->form->getState());

        Notification::make()->title('Konten Outsourcing berhasil diperbarui')->success()->send();
    }
}
