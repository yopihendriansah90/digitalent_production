<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SectionBlockResource\Pages;
use App\Models\SectionBlock;
use Filament\Actions;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Validation\Rule;

class SectionBlockResource extends Resource
{
    protected static ?string $model = SectionBlock::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-group';

    protected static bool $shouldRegisterNavigation = false;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Forms\Components\Select::make('page_id')
                ->relationship('page', 'title')
                ->required(),
            Forms\Components\TextInput::make('section_key')
                ->required()
                ->maxLength(255)
                ->rules([
                    fn (Forms\Get $get, ?SectionBlock $record) => Rule::unique('section_blocks', 'section_key')
                        ->where('page_id', $get('page_id'))
                        ->ignore($record),
                ])
                ->helperText('Unique per page.'),
            Forms\Components\TextInput::make('section_title')->maxLength(255),
            Forms\Components\Textarea::make('section_description')->rows(3),
            Forms\Components\TextInput::make('order_index')->numeric()->default(0)->required(),
            Forms\Components\Toggle::make('is_active')->required(),
            Forms\Components\SpatieMediaLibraryFileUpload::make('section_images')
                ->collection('section_images')
                ->multiple()
                ->image()
                ->maxSize(4096),
            Forms\Components\SpatieMediaLibraryFileUpload::make('section_icons')
                ->collection('section_icons')
                ->multiple()
                ->maxSize(2048),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->reorderable('order_index')
            ->defaultSort('order_index')
            ->columns([
                Tables\Columns\TextColumn::make('page.title')->label('Page')->searchable(),
                Tables\Columns\TextColumn::make('section_key')->searchable(),
                Tables\Columns\TextColumn::make('order_index')->sortable(),
                Tables\Columns\IconColumn::make('is_active')->boolean(),
            ])
            ->filters([
                TernaryFilter::make('is_active'),
            ])
            ->actions([
                Actions\EditAction::make(),
            ])
            ->bulkActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSectionBlocks::route('/'),
            'create' => Pages\CreateSectionBlock::route('/create'),
            'edit' => Pages\EditSectionBlock::route('/{record}/edit'),
        ];
    }
}
