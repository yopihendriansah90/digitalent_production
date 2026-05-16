<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactInquiryResource\Pages;
use App\Models\ContactInquiry;
use Filament\Actions;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ContactInquiryResource extends Resource
{
    protected static ?string $model = ContactInquiry::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-inbox-stack';

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $navigationLabel = 'Contact Inquiries';

    protected static ?int $navigationSort = 30;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Forms\Components\TextInput::make('name')->required()->maxLength(255),
            Forms\Components\TextInput::make('email')->required()->email()->maxLength(255),
            Forms\Components\TextInput::make('service_type')->maxLength(255),
            Forms\Components\Textarea::make('message')->required()->rows(5),
            Forms\Components\Select::make('status')
                ->required()
                ->options([
                    ContactInquiry::STATUS_NEW => 'new',
                    ContactInquiry::STATUS_READ => 'read',
                    ContactInquiry::STATUS_REPLIED => 'replied',
                ]),
            Forms\Components\Select::make('assigned_to')
                ->relationship('assignee', 'name')
                ->searchable()
                ->preload(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('email')->searchable(),
                Tables\Columns\TextColumn::make('service_type')->toggleable(),
                Tables\Columns\BadgeColumn::make('status'),
                Tables\Columns\TextColumn::make('assignee.name')->label('Assignee'),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        ContactInquiry::STATUS_NEW => 'new',
                        ContactInquiry::STATUS_READ => 'read',
                        ContactInquiry::STATUS_REPLIED => 'replied',
                    ]),
                Tables\Filters\SelectFilter::make('assigned_to')
                    ->relationship('assignee', 'name')
                    ->label('Assignee'),
            ])
            ->actions([
                Actions\ViewAction::make(),
                Actions\EditAction::make(),
            ])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContactInquiries::route('/'),
            'edit' => Pages\EditContactInquiry::route('/{record}/edit'),
        ];
    }
}
