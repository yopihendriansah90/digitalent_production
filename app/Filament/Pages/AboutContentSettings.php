<?php

namespace App\Filament\Pages;

use App\Models\AboutContent;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use UnitEnum;

class AboutContentSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-information-circle';

    protected static ?string $navigationLabel = 'Konten About';

    protected static ?string $title = 'Edit Konten About';

    protected static ?string $slug = 'content/about';

    protected static string | UnitEnum | null $navigationGroup = 'Manajemen Konten';

    protected static ?int $navigationSort = 11;

    protected string $view = 'filament.pages.home-content-settings';

    public ?array $data = [];

    public AboutContent $record;

    public function mount(): void
    {
        $this->record = AboutContent::query()->firstOrCreate(['id' => 1]);
        $this->form->model($this->record)->fill($this->record->toArray());
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->statePath('data')
            ->model($this->record)
            ->components([
                Tabs::make('about_content_tabs')
                    ->tabs([
                        Tab::make('Hero')->schema([
                            Grid::make(2)->schema([
                                Forms\Components\TextInput::make('hero_title.id')->label('Judul Hero (ID)')->required(),
                                Forms\Components\TextInput::make('hero_title.en')->label('Hero Title (EN)')->required(),
                            ]),
                        ]),
                        Tab::make('Story')->schema([
                            Section::make('Who We Are')->schema([
                                Grid::make(2)->schema([
                                    Forms\Components\TextInput::make('who_we_are_title.id')->label('Judul (ID)')->required(),
                                    Forms\Components\TextInput::make('who_we_are_title.en')->label('Title (EN)')->required(),
                                    Forms\Components\Textarea::make('who_we_are_body.id')->label('Isi (ID)')->rows(4)->required(),
                                    Forms\Components\Textarea::make('who_we_are_body.en')->label('Body (EN)')->rows(4)->required(),
                                ]),
                            ]),
                            Section::make('Where We Come From')->schema([
                                Grid::make(2)->schema([
                                    Forms\Components\TextInput::make('where_we_come_from_title.id')->label('Judul (ID)')->required(),
                                    Forms\Components\TextInput::make('where_we_come_from_title.en')->label('Title (EN)')->required(),
                                    Forms\Components\Textarea::make('where_we_come_from_body.id')->label('Isi (ID)')->rows(4)->required(),
                                    Forms\Components\Textarea::make('where_we_come_from_body.en')->label('Body (EN)')->rows(4)->required(),
                                ]),
                            ]),
                            Section::make('Our Commitment')->schema([
                                Grid::make(2)->schema([
                                    Forms\Components\TextInput::make('commitment_title.id')->label('Judul (ID)')->required(),
                                    Forms\Components\TextInput::make('commitment_title.en')->label('Title (EN)')->required(),
                                    Forms\Components\Textarea::make('commitment_body.id')->label('Isi (ID)')->rows(4)->required(),
                                    Forms\Components\Textarea::make('commitment_body.en')->label('Body (EN)')->rows(4)->required(),
                                ]),
                            ]),
                        ]),
                        Tab::make('Sidebar')->schema([
                            Forms\Components\SpatieMediaLibraryFileUpload::make('about_photo')
                                ->collection('about_photo')
                                ->label('Foto About')
                                ->image()
                                ->imageEditor()
                                ->maxSize(4096),
                            Grid::make(2)->schema([
                                Forms\Components\TextInput::make('founded_label.id')->label('Founded Label (ID)'),
                                Forms\Components\TextInput::make('founded_label.en')->label('Founded Label (EN)'),
                                Forms\Components\TextInput::make('founded_value.id')->label('Founded Value (ID)'),
                                Forms\Components\TextInput::make('founded_value.en')->label('Founded Value (EN)'),
                                Forms\Components\TextInput::make('group_label.id')->label('Group Label (ID)'),
                                Forms\Components\TextInput::make('group_label.en')->label('Group Label (EN)'),
                                Forms\Components\TextInput::make('group_value.id')->label('Group Value (ID)'),
                                Forms\Components\TextInput::make('group_value.en')->label('Group Value (EN)'),
                            ]),
                            Grid::make(2)->schema([
                                Forms\Components\TextInput::make('business_focus_title.id')->label('Business Focus Title (ID)'),
                                Forms\Components\TextInput::make('business_focus_title.en')->label('Business Focus Title (EN)'),
                                Forms\Components\TextInput::make('focus_1_title.id')->label('Focus 1 Title (ID)'),
                                Forms\Components\TextInput::make('focus_1_title.en')->label('Focus 1 Title (EN)'),
                                Forms\Components\Textarea::make('focus_1_body.id')->label('Focus 1 Body (ID)')->rows(3),
                                Forms\Components\Textarea::make('focus_1_body.en')->label('Focus 1 Body (EN)')->rows(3),
                                Forms\Components\TextInput::make('focus_2_title.id')->label('Focus 2 Title (ID)'),
                                Forms\Components\TextInput::make('focus_2_title.en')->label('Focus 2 Title (EN)'),
                                Forms\Components\Textarea::make('focus_2_body.id')->label('Focus 2 Body (ID)')->rows(3),
                                Forms\Components\Textarea::make('focus_2_body.en')->label('Focus 2 Body (EN)')->rows(3),
                            ]),
                        ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public function save(): void
    {
        $this->record->update($this->form->getState());

        Notification::make()
            ->title('Konten About berhasil diperbarui')
            ->success()
            ->send();
    }
}
