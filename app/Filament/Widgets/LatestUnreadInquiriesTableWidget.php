<?php

namespace App\Filament\Widgets;

use App\Models\ContactInquiry;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class LatestUnreadInquiriesTableWidget extends BaseWidget
{
    protected static ?string $heading = 'Pertanyaan Kontak Terbaru (Belum Dibaca)';

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                ContactInquiry::query()
                    ->where('status', ContactInquiry::STATUS_NEW)
                    ->latest('created_at')
            )
            ->defaultPaginationPageOption(10)
            ->paginated([10, 25, 50])
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Masuk')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('service_type')
                    ->label('Jenis Layanan')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('message')
                    ->label('Pesan')
                    ->limit(80)
                    ->tooltip(fn (ContactInquiry $record): string => $record->message),
                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->formatStateUsing(fn (string $state): string => $state === ContactInquiry::STATUS_NEW ? 'Baru' : ucfirst($state))
                    ->colors([
                        'warning' => ContactInquiry::STATUS_NEW,
                    ]),
                Tables\Columns\TextColumn::make('aksi_buka')
                    ->label('Aksi')
                    ->state('Buka')
                    ->icon('heroicon-o-eye')
                    ->color('primary')
                    ->url(fn (ContactInquiry $record): string => route('filament.admin.resources.contact-inquiries.edit', $record)),
            ])
            ->filters([
                Tables\Filters\Filter::make('hari_ini')
                    ->label('Hari Ini')
                    ->query(fn (Builder $query): Builder => $query->whereDate('created_at', today())),
            ])
            ->actions([])
            ->emptyStateHeading('Belum ada inquiry baru')
            ->emptyStateDescription('Inquiry dengan status belum dibaca akan tampil di sini.');
    }
}
