<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiteSettingResource\Pages;
use App\Models\SiteSetting;
use Filament\Actions;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SiteSettingResource extends Resource
{
    protected static ?string $model = SiteSetting::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static bool $shouldRegisterNavigation = false;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Forms\Components\TextInput::make('company_name')->required()->maxLength(255),
            Forms\Components\TextInput::make('tagline')->maxLength(255),
            Forms\Components\TextInput::make('email')->email()->maxLength(255),
            Forms\Components\TextInput::make('phone')->maxLength(50),
            Forms\Components\TextInput::make('whatsapp')->maxLength(50),
            Forms\Components\Textarea::make('address')->rows(3),
            Forms\Components\TextInput::make('instagram_url')->url()->maxLength(255),
            Forms\Components\TextInput::make('linkedin_url')->url()->maxLength(255),
            Forms\Components\TextInput::make('website_url')->url()->maxLength(255),
            Forms\Components\TextInput::make('copyright_text')->maxLength(255),
            Forms\Components\Textarea::make('map_embed')->rows(3),
            Forms\Components\TextInput::make('topbar_working_hours.id')->label('Jam Kerja Topbar (ID)')->maxLength(255),
            Forms\Components\TextInput::make('topbar_working_hours.en')->label('Topbar Working Hours (EN)')->maxLength(255),
            Forms\Components\TextInput::make('topbar_address_short.id')->label('Alamat Singkat Topbar (ID)')->maxLength(255),
            Forms\Components\TextInput::make('topbar_address_short.en')->label('Topbar Short Address (EN)')->maxLength(255),
            Forms\Components\TextInput::make('consultation_label.id')->label('Label Tombol Konsultasi (ID)')->maxLength(100),
            Forms\Components\TextInput::make('consultation_label.en')->label('Consultation Button Label (EN)')->maxLength(100),
            Forms\Components\TextInput::make('nav_labels.home.id')->label('Menu Home (ID)')->maxLength(100),
            Forms\Components\TextInput::make('nav_labels.home.en')->label('Menu Home (EN)')->maxLength(100),
            Forms\Components\TextInput::make('nav_labels.about.id')->label('Menu About (ID)')->maxLength(100),
            Forms\Components\TextInput::make('nav_labels.about.en')->label('Menu About (EN)')->maxLength(100),
            Forms\Components\TextInput::make('nav_labels.services.id')->label('Menu Services (ID)')->maxLength(100),
            Forms\Components\TextInput::make('nav_labels.services.en')->maxLength(100)->label('Menu Services (EN)'),
            Forms\Components\TextInput::make('nav_labels.vision_mission.id')->label('Menu Vision Mission (ID)')->maxLength(100),
            Forms\Components\TextInput::make('nav_labels.vision_mission.en')->label('Menu Vision Mission (EN)')->maxLength(100),
            Forms\Components\TextInput::make('nav_labels.portfolio.id')->label('Menu Portfolio (ID)')->maxLength(100),
            Forms\Components\TextInput::make('nav_labels.portfolio.en')->label('Menu Portfolio (EN)')->maxLength(100),
            Forms\Components\TextInput::make('nav_labels.training.id')->label('Menu Training (ID)')->maxLength(100),
            Forms\Components\TextInput::make('nav_labels.training.en')->label('Menu Training (EN)')->maxLength(100),
            Forms\Components\TextInput::make('nav_labels.outsourcing.id')->label('Menu Outsourcing (ID)')->maxLength(100),
            Forms\Components\TextInput::make('nav_labels.outsourcing.en')->label('Menu Outsourcing (EN)')->maxLength(100),
            Forms\Components\TextInput::make('nav_labels.contact.id')->label('Menu Contact (ID)')->maxLength(100),
            Forms\Components\TextInput::make('nav_labels.contact.en')->label('Menu Contact (EN)')->maxLength(100),
            Forms\Components\SpatieMediaLibraryFileUpload::make('logo_light')->collection('logo_light')->image()->maxSize(2048),
            Forms\Components\SpatieMediaLibraryFileUpload::make('logo_dark')->collection('logo_dark')->image()->maxSize(2048),
            Forms\Components\SpatieMediaLibraryFileUpload::make('favicon')->collection('favicon')->image()->maxSize(1024),
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
