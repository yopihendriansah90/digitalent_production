<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiteSettingResource\Pages;
use App\Models\SiteSetting;
use Filament\Actions;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class SiteSettingResource extends Resource
{
    protected static ?string $model = SiteSetting::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationLabel = 'Pengaturan Website';

    protected static string|\UnitEnum|null $navigationGroup = 'Pengaturan';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Tabs::make('site_settings_tabs')
                ->tabs([
                    Tab::make('Identitas & Kontak')
                        ->schema([
                            Grid::make(2)->schema([
                                Forms\Components\TextInput::make('company_name')->label('Nama Perusahaan')->required()->maxLength(255),
                                Forms\Components\TextInput::make('tagline')->label('Tagline')->maxLength(255),
                                Forms\Components\TextInput::make('email')->email()->maxLength(255),
                                Forms\Components\TextInput::make('phone')->label('Telepon')->maxLength(50),
                                Forms\Components\TextInput::make('whatsapp')
                                    ->maxLength(255)
                                    ->rules([
                                        'nullable',
                                        'regex:/^((\+62|62|08)\d{8,13}|https?:\/\/(wa\.me|api\.whatsapp\.com)\/.+)$/i',
                                    ])
                                    ->helperText('Format didukung: +62812..., 0812..., 62812..., atau URL WhatsApp (wa.me / api.whatsapp.com).'),
                                Forms\Components\TextInput::make('website_url')->url()->label('Website URL')->maxLength(255),
                                Forms\Components\TextInput::make('instagram_url')->url()->maxLength(255),
                                Forms\Components\TextInput::make('linkedin_url')->url()->maxLength(255),
                            ]),
                            Forms\Components\Textarea::make('address')->label('Alamat Lengkap')->rows(3)->columnSpanFull(),
                            Forms\Components\Textarea::make('map_embed')
                                ->label('Google Maps Embed (iframe)')
                                ->rows(3)
                                ->helperText('Paste kode iframe dari Google Maps.')
                                ->columnSpanFull(),
                        ]),
                    Tab::make('Header (Topbar & Menu)')
                        ->schema([
                            Section::make('Topbar')
                                ->schema([
                                    Grid::make(2)->schema([
                                        Forms\Components\TextInput::make('topbar_working_hours.id')->label('Jam Kerja (ID)')->maxLength(255),
                                        Forms\Components\TextInput::make('topbar_working_hours.en')->label('Working Hours (EN)')->maxLength(255),
                                        Forms\Components\TextInput::make('topbar_address_short.id')->label('Alamat Singkat (ID)')->maxLength(255),
                                        Forms\Components\TextInput::make('topbar_address_short.en')->label('Short Address (EN)')->maxLength(255),
                                    ]),
                                ]),
                            Section::make('Label Tombol Konsultasi')
                                ->schema([
                                    Grid::make(2)->schema([
                                        Forms\Components\TextInput::make('consultation_label.id')->label('Label (ID)')->maxLength(100),
                                        Forms\Components\TextInput::make('consultation_label.en')->label('Label (EN)')->maxLength(100),
                                    ]),
                                ]),
                            Section::make('Label Menu Navigasi')
                                ->schema([
                                    Grid::make(2)->schema([
                                        Forms\Components\TextInput::make('nav_labels.home.id')->label('Home (ID)')->maxLength(100),
                                        Forms\Components\TextInput::make('nav_labels.home.en')->label('Home (EN)')->maxLength(100),
                                        Forms\Components\TextInput::make('nav_labels.about.id')->label('About (ID)')->maxLength(100),
                                        Forms\Components\TextInput::make('nav_labels.about.en')->label('About (EN)')->maxLength(100),
                                        Forms\Components\TextInput::make('nav_labels.services.id')->label('Services (ID)')->maxLength(100),
                                        Forms\Components\TextInput::make('nav_labels.services.en')->label('Services (EN)')->maxLength(100),
                                        Forms\Components\TextInput::make('nav_labels.vision_mission.id')->label('Vision Mission (ID)')->maxLength(100),
                                        Forms\Components\TextInput::make('nav_labels.vision_mission.en')->label('Vision Mission (EN)')->maxLength(100),
                                        Forms\Components\TextInput::make('nav_labels.portfolio.id')->label('Portfolio (ID)')->maxLength(100),
                                        Forms\Components\TextInput::make('nav_labels.portfolio.en')->label('Portfolio (EN)')->maxLength(100),
                                        Forms\Components\TextInput::make('nav_labels.training.id')->label('Training (ID)')->maxLength(100),
                                        Forms\Components\TextInput::make('nav_labels.training.en')->label('Training (EN)')->maxLength(100),
                                        Forms\Components\TextInput::make('nav_labels.outsourcing.id')->label('Outsourcing (ID)')->maxLength(100),
                                        Forms\Components\TextInput::make('nav_labels.outsourcing.en')->label('Outsourcing (EN)')->maxLength(100),
                                        Forms\Components\TextInput::make('nav_labels.contact.id')->label('Contact (ID)')->maxLength(100),
                                        Forms\Components\TextInput::make('nav_labels.contact.en')->label('Contact (EN)')->maxLength(100),
                                    ]),
                                ])
                                ->collapsible(),
                        ]),
                    Tab::make('Footer')
                        ->schema([
                            Grid::make(2)->schema([
                                Forms\Components\Textarea::make('footer_description.id')->label('Deskripsi Footer (ID)')->rows(2),
                                Forms\Components\Textarea::make('footer_description.en')->label('Footer Description (EN)')->rows(2),
                                Forms\Components\TextInput::make('footer_pages_title.id')->label('Judul Kolom Pages (ID)')->maxLength(100),
                                Forms\Components\TextInput::make('footer_pages_title.en')->label('Pages Column Title (EN)')->maxLength(100),
                                Forms\Components\TextInput::make('footer_services_title.id')->label('Judul Kolom Services (ID)')->maxLength(100),
                                Forms\Components\TextInput::make('footer_services_title.en')->label('Services Column Title (EN)')->maxLength(100),
                                Forms\Components\TextInput::make('footer_contact_title.id')->label('Judul Kolom Contact (ID)')->maxLength(100),
                                Forms\Components\TextInput::make('footer_contact_title.en')->label('Contact Column Title (EN)')->maxLength(100),
                                Forms\Components\TextInput::make('footer_bottom_right_text.id')->label('Teks Footer Bawah (ID)')->maxLength(255),
                                Forms\Components\TextInput::make('footer_bottom_right_text.en')->label('Footer Bottom Text (EN)')->maxLength(255),
                            ]),
                            Forms\Components\Repeater::make('footer_service_links')
                                ->label('Daftar Link Layanan (Footer)')
                                ->schema([
                                    Forms\Components\TextInput::make('id')->label('Service (ID)')->required(),
                                    Forms\Components\TextInput::make('en')->label('Service (EN)')->required(),
                                    Forms\Components\Select::make('route')
                                        ->label('Tujuan Link')
                                        ->options([
                                            'training' => 'Training',
                                            'outsourcing' => 'Outsourcing',
                                            'services' => 'Services',
                                            'contact' => 'Contact',
                                        ])
                                        ->required(),
                                ])
                                ->columns(3)
                                ->defaultItems(6)
                                ->addable(false)
                                ->deletable(false)
                                ->reorderableWithButtons(),
                            Forms\Components\TextInput::make('copyright_text')->label('Copyright Text')->maxLength(255),
                        ]),
                    Tab::make('Brand Asset')
                        ->schema([
                            Forms\Components\SpatieMediaLibraryFileUpload::make('logo_light')
                                ->label('Logo Light (Header)')
                                ->collection('logo_light')
                                ->image()
                                ->maxSize(2048),
                            Forms\Components\SpatieMediaLibraryFileUpload::make('logo_dark')
                                ->label('Logo Dark (Footer)')
                                ->collection('logo_dark')
                                ->image()
                                ->maxSize(2048),
                            Forms\Components\SpatieMediaLibraryFileUpload::make('favicon')
                                ->label('Favicon')
                                ->collection('favicon')
                                ->image()
                                ->maxSize(1024),
                            Forms\Components\SpatieMediaLibraryFileUpload::make('whatsapp_icon')
                                ->label('Icon Tombol WhatsApp')
                                ->collection('whatsapp_icon')
                                ->image()
                                ->maxSize(1024),
                        ]),
                ])
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('company_name')->searchable(),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('updated_at')->dateTime()->sortable(),
            ])
            ->actions([
                Actions\EditAction::make(),
            ])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSiteSettings::route('/'),
            'create' => Pages\CreateSiteSetting::route('/create'),
            'edit' => Pages\EditSiteSetting::route('/{record}/edit'),
        ];
    }
}
