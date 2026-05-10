<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SectionItemResource\Pages;
use App\Models\SectionItem;
use Filament\Actions;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SectionItemResource extends Resource
{
    protected static ?string $model = SectionItem::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-list-bullet';

    protected static bool $shouldRegisterNavigation = false;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Forms\Components\Select::make('section_block_id')
                ->relationship('sectionBlock', 'section_key')
                ->required(),
            Forms\Components\TextInput::make('title')->required()->maxLength(255),
            Forms\Components\Textarea::make('description')->rows(3),
            Forms\Components\TextInput::make('badge')->maxLength(255),
            Forms\Components\TextInput::make('order_index')->numeric()->default(0)->required(),
            Forms\Components\KeyValue::make('extra')
                ->keyLabel('Key')
                ->valueLabel('Value')
                ->addActionLabel('Add metadata'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->reorderable('order_index')
            ->defaultSort('order_index')
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable(),
                Tables\Columns\TextColumn::make('sectionBlock.section_key')->label('Section')->searchable(),
                Tables\Columns\TextColumn::make('badge')->toggleable(),
                Tables\Columns\TextColumn::make('order_index')->sortable(),
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
            'index' => Pages\ListSectionItems::route('/'),
            'create' => Pages\CreateSectionItem::route('/create'),
            'edit' => Pages\EditSectionItem::route('/{record}/edit'),
        ];
    }
}
