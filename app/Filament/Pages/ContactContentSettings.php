<?php

namespace App\Filament\Pages;

use App\Models\ContactContent;
use Filament\Actions\Action;
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

class ContactContentSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-envelope';
    protected static ?string $navigationLabel = 'Contact';
    protected static ?string $title = 'Edit Contact';
    protected static ?string $slug = 'content/contact';
    protected static string | UnitEnum | null $navigationGroup = 'Konten Website';
    protected static ?int $navigationSort = 8;
    protected string $view = 'filament.pages.home-content-settings';

    public ?array $data = [];
    public ContactContent $record;

    public function mount(): void
    {
        $this->record = ContactContent::query()->firstOrCreate(['id' => 1]);
        $this->form->model($this->record)->fill($this->record->toArray());
    }

    public function form(Schema $schema): Schema
    {
        return $schema->statePath('data')->model($this->record)->components([
            Tabs::make('contact_tabs')->tabs([
                Tab::make('Hero')->schema([
                    Grid::make(2)->schema([
                        Forms\Components\TextInput::make('hero_title.id')->label('Judul Hero (ID)')->required(),
                        Forms\Components\TextInput::make('hero_title.en')->label('Hero Title (EN)')->required(),
                    ]),
                    Forms\Components\SpatieMediaLibraryFileUpload::make('hero_background')
                        ->collection('hero_background')
                        ->label('Background Hero')
                        ->image()
                        ->imageEditor()
                        ->maxSize(4096),
                ]),
                Tab::make('Contact Info')->schema([
                    Grid::make(2)->schema([
                        Forms\Components\TextInput::make('contact_info_title.id')->label('Judul Informasi Kontak (ID)')->required(),
                        Forms\Components\TextInput::make('contact_info_title.en')->label('Contact Information Title (EN)')->required(),
                    ]),
                    Forms\Components\Repeater::make('contact_items')
                        ->label('Daftar Info Kontak')
                        ->schema([
                            Forms\Components\TextInput::make('label.id')->label('Label (ID)')->required(),
                            Forms\Components\TextInput::make('label.en')->label('Label (EN)')->required(),
                            Forms\Components\TextInput::make('value.id')->label('Isi (ID)')->required(),
                            Forms\Components\TextInput::make('value.en')->label('Value (EN)')->required(),
                            Forms\Components\TextInput::make('link')
                                ->label('Link (Opsional)')
                                ->nullable()
                                ->rules([
                                    'nullable',
                                    'regex:/^(https?:\/\/|mailto:|tel:).+/i',
                                ])
                                ->helperText('Contoh: https://..., mailto:info@..., tel:+628...')
                                ->columnSpanFull(),
                        ])
                        ->columns(2)
                        ->defaultItems(7)
                        ->minItems(1)
                        ->addable(false)
                        ->deletable(false)
                        ->reorderableWithButtons(),
                ]),
                Tab::make('Contact Form')->schema([
                    Grid::make(2)->schema([
                        Forms\Components\TextInput::make('form_title.id')->label('Judul Form (ID)')->required(),
                        Forms\Components\TextInput::make('form_title.en')->label('Form Title (EN)')->required(),
                    ]),
                    Grid::make(2)->schema([
                        Forms\Components\TextInput::make('form_labels.name.id')->label('Label Nama (ID)')->required(),
                        Forms\Components\TextInput::make('form_labels.name.en')->label('Name Label (EN)')->required(),
                        Forms\Components\TextInput::make('form_labels.name_placeholder.id')->label('Placeholder Nama (ID)')->required(),
                        Forms\Components\TextInput::make('form_labels.name_placeholder.en')->label('Name Placeholder (EN)')->required(),
                        Forms\Components\TextInput::make('form_labels.email.id')->label('Label Email (ID)')->required(),
                        Forms\Components\TextInput::make('form_labels.email.en')->label('Email Label (EN)')->required(),
                        Forms\Components\TextInput::make('form_labels.email_placeholder.id')->label('Placeholder Email (ID)')->required(),
                        Forms\Components\TextInput::make('form_labels.email_placeholder.en')->label('Email Placeholder (EN)')->required(),
                        Forms\Components\TextInput::make('form_labels.service_type.id')->label('Label Jenis Service (ID)')->required(),
                        Forms\Components\TextInput::make('form_labels.service_type.en')->label('Service Type Label (EN)')->required(),
                        Forms\Components\TextInput::make('form_labels.service_placeholder.id')->label('Placeholder Service (ID)')->required(),
                        Forms\Components\TextInput::make('form_labels.service_placeholder.en')->label('Service Placeholder (EN)')->required(),
                        Forms\Components\TextInput::make('form_labels.message.id')->label('Label Pertanyaan (ID)')->required(),
                        Forms\Components\TextInput::make('form_labels.message.en')->label('Message Label (EN)')->required(),
                        Forms\Components\TextInput::make('form_labels.message_placeholder.id')->label('Placeholder Pertanyaan (ID)')->required(),
                        Forms\Components\TextInput::make('form_labels.message_placeholder.en')->label('Message Placeholder (EN)')->required(),
                    ]),
                    Forms\Components\Repeater::make('service_options')
                        ->label('Pilihan Layanan')
                        ->schema([
                            Forms\Components\TextInput::make('id')->label('Service (ID)')->required(),
                            Forms\Components\TextInput::make('en')->label('Service (EN)')->required(),
                        ])
                        ->columns(2)
                        ->defaultItems(5)
                        ->minItems(1)
                        ->addActionLabel('Tambah Pilihan Layanan')
                        ->reorderableWithButtons(),
                    Grid::make(2)->schema([
                        Forms\Components\TextInput::make('button_labels.submit.id')->label('Tombol Submit (ID)')->required(),
                        Forms\Components\TextInput::make('button_labels.submit.en')->label('Submit Button (EN)')->required(),
                        Forms\Components\Textarea::make('button_labels.success.id')->label('Pesan Sukses (ID)')->rows(2)->required(),
                        Forms\Components\Textarea::make('button_labels.success.en')->label('Success Message (EN)')->rows(2)->required(),
                        Forms\Components\Textarea::make('button_labels.error.id')->label('Pesan Error (ID)')->rows(2)->required(),
                        Forms\Components\Textarea::make('button_labels.error.en')->label('Error Message (EN)')->rows(2)->required(),
                    ]),
                ]),
            ])->columnSpanFull(),
        ]);
    }

    /**
     * @return array<int, Action>
     */
    protected function getHeaderActions(): array
    {
        return [
            Action::make('save')
                ->label('Simpan Perubahan')
                ->icon('heroicon-o-check-circle')
                ->color('primary')
                ->action('save'),
        ];
    }

    public function save(): void
    {
        $this->record->update($this->form->getState());

        Notification::make()->title('Contact berhasil diperbarui')->success()->send();
    }
}
