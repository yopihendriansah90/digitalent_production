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

    protected static bool $shouldRegisterNavigation = true;

    protected static ?string $navigationLabel = 'Pertanyaan Kontak';

    protected static string | \UnitEnum | null $navigationGroup = 'Komunikasi';

    protected static ?int $navigationSort = 1;

    public static function getModelLabel(): string
    {
        return 'Pertanyaan Kontak';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Pertanyaan Kontak';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            \Filament\Schemas\Components\Section::make('Informasi Pengirim')
                ->description('Data identitas pengirim pertanyaan kontak.')
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->label('Nama')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('email')
                        ->label('Email')
                        ->required()
                        ->email()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('service_type')
                        ->label('Jenis Layanan')
                        ->maxLength(255)
                        ->columnSpanFull(),
                ])
                ->columns(2),
            \Filament\Schemas\Components\Section::make('Isi Pertanyaan')
                ->description('Pesan utama yang dikirim oleh pengunjung.')
                ->schema([
                    Forms\Components\Textarea::make('message')
                        ->label('Pesan')
                        ->required()
                        ->rows(6)
                        ->columnSpanFull(),
                ]),
            \Filament\Schemas\Components\Section::make('Tindak Lanjut')
                ->description('Atur status penanganan dan PIC yang bertanggung jawab.')
                ->schema([
                    Forms\Components\Select::make('status')
                        ->label('Status')
                        ->required()
                        ->options([
                            ContactInquiry::STATUS_NEW => 'Baru',
                            ContactInquiry::STATUS_READ => 'Dibaca',
                            ContactInquiry::STATUS_REPLIED => 'Dibalas',
                        ]),
                    Forms\Components\Select::make('assigned_to')
                        ->label('Ditugaskan Ke')
                        ->relationship('assignee', 'name')
                        ->searchable()
                        ->preload(),
                ])
                ->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('no')
                    ->label('No')
                    ->rowIndex()
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('name')->label('Nama')->searchable(),
                Tables\Columns\TextColumn::make('email')->label('Email')->searchable(),
                Tables\Columns\TextColumn::make('service_type')->label('Jenis Layanan')->toggleable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        ContactInquiry::STATUS_NEW => 'Baru',
                        ContactInquiry::STATUS_READ => 'Dibaca',
                        ContactInquiry::STATUS_REPLIED => 'Dibalas',
                        default => ucfirst($state),
                    }),
                Tables\Columns\TextColumn::make('assignee.name')->label('Ditugaskan Ke'),
                Tables\Columns\TextColumn::make('created_at')->label('Tanggal Masuk')->dateTime()->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        ContactInquiry::STATUS_NEW => 'Baru',
                        ContactInquiry::STATUS_READ => 'Dibaca',
                        ContactInquiry::STATUS_REPLIED => 'Dibalas',
                    ]),
                Tables\Filters\SelectFilter::make('assigned_to')
                    ->relationship('assignee', 'name')
                    ->label('Ditugaskan Ke'),
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
