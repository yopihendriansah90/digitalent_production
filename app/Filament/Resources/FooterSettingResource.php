<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FooterSettingResource\Pages;
use App\Models\SiteSetting;
use Filament\Actions;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class FooterSettingResource extends Resource
{
    protected static ?string $model = SiteSetting::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Footer';

    protected static ?string $modelLabel = 'Footer Settings';

    protected static ?string $pluralModelLabel = 'Footer Settings';

    protected static ?int $navigationSort = 20;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Forms\Components\Textarea::make('address')->rows(3),
            Forms\Components\TextInput::make('email')->email()->maxLength(255),
            Forms\Components\TextInput::make('phone')->maxLength(50),
            Forms\Components\TextInput::make('whatsapp')->maxLength(50),
            Forms\Components\TextInput::make('instagram_url')->url()->maxLength(255),
            Forms\Components\TextInput::make('linkedin_url')->url()->maxLength(255),
            Forms\Components\TextInput::make('website_url')->url()->maxLength(255),
            Forms\Components\TextInput::make('copyright_text')->maxLength(255),
            Forms\Components\SpatieMediaLibraryFileUpload::make('logo_light')->collection('logo_light')->image()->maxSize(2048),
            Forms\Components\SpatieMediaLibraryFileUpload::make('logo_dark')->collection('logo_dark')->image()->maxSize(2048),
            Forms\Components\SpatieMediaLibraryFileUpload::make('favicon')->collection('favicon')->image()->maxSize(1024),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('updated_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('company_name')->label('Company'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('phone'),
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
            'index' => Pages\ListFooterSettings::route('/'),
            'create' => Pages\CreateFooterSetting::route('/create'),
            'edit' => Pages\EditFooterSetting::route('/{record}/edit'),
        ];
    }

    public static function canDelete(\Illuminate\Database\Eloquent\Model $record): bool
    {
        return false;
    }

    public static function canDeleteAny(): bool
    {
        return false;
    }
}
