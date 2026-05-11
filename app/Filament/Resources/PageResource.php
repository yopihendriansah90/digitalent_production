<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Models\Page;
use Filament\Actions;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Pages';

    protected static ?int $navigationSort = 10;

    /**
     * @return array<string, string>
     */
    public static function pageLabels(): array
    {
        return [
            'home' => 'Home',
            'about' => 'About Us',
            'services' => 'Services',
            'vision-mission' => 'Vision & Mission',
            'portfolio' => 'Client / Portfolio',
            'training' => 'Training',
            'outsourcing' => 'Outsourcing',
            'contact' => 'Contact',
        ];
    }

    /**
     * @return array<string>
     */
    public static function orderedSlugs(): array
    {
        return array_keys(self::pageLabels());
    }

    public static function form(Schema $schema): Schema
    {
        $sectionKeys = collect(config('company_profile.section_keys', []))
            ->flatten()
            ->unique()
            ->values()
            ->all();

        $tabs = [
            Tab::make('General')
                ->schema([
                    Forms\Components\TextInput::make('title')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\Select::make('slug')
                        ->required()
                        ->options(self::pageLabels())
                        ->disabled()
                        ->dehydrated(true),
                    Forms\Components\Hidden::make('is_published')
                        ->default(true)
                        ->dehydrated(true),
                    Forms\Components\TextInput::make('meta_title')
                        ->maxLength(255),
                    Forms\Components\Textarea::make('meta_description')
                        ->rows(3),
                ]),
        ];

        foreach ($sectionKeys as $sectionKey) {
            $sectionSchema = [];

            if ($sectionKey === 'hero') {
                $sectionSchema = [
                    Forms\Components\TextInput::make('hero_title')
                        ->maxLength(255),
                    Forms\Components\SpatieMediaLibraryFileUpload::make('hero_image_1')
                        ->label('Hero Image')
                        ->collection('hero_image_1')
                        ->image()
                        ->maxSize(4096),
                    Forms\Components\SpatieMediaLibraryFileUpload::make('hero_image_2')
                        ->label('Hero Image 2')
                        ->collection('hero_image_2')
                        ->image()
                        ->maxSize(4096)
                        ->visible(fn (?Page $record): bool => $record?->slug !== 'services'),
                    Forms\Components\SpatieMediaLibraryFileUpload::make('hero_image_3')
                        ->label('Hero Image 3')
                        ->collection('hero_image_3')
                        ->image()
                        ->maxSize(4096)
                        ->visible(fn (?Page $record): bool => $record?->slug !== 'services'),
                ];
            } elseif ($sectionKey === 'core_values') {
                $sectionSchema = [
                    Forms\Components\TextInput::make("section_content.{$sectionKey}.section_title")
                        ->label('Section Title')
                        ->maxLength(255),
                    Forms\Components\Repeater::make("section_content.{$sectionKey}.items")
                        ->label('Core Value Items')
                        ->defaultItems(0)
                        ->addable(false)
                        ->deletable(false)
                        ->reorderableWithButtons()
                        ->schema([
                            Forms\Components\Hidden::make('id'),
                            Forms\Components\TextInput::make('title')
                                ->label('Value Title')
                                ->required()
                                ->maxLength(255),
                            Forms\Components\RichEditor::make('description')
                                ->label('Value Description')
                                ->toolbarButtons([
                                    ['bold', 'italic', 'underline'],
                                    ['bulletList', 'orderedList', 'link'],
                                    ['undo', 'redo'],
                                ])
                                ->columnSpanFull(),
                            Forms\Components\FileUpload::make('extra.icon_path')
                                ->label('Value Icon / Image')
                                ->disk('public')
                                ->directory('core-values')
                                ->image()
                                ->maxSize(2048),
                        ])
                        ->columns(2)
                        ->collapsed(),
                ];
            } elseif ($sectionKey === 'progress_counter') {
                $sectionSchema = [
                    Forms\Components\TextInput::make("section_content.{$sectionKey}.section_title")
                        ->label('Section Title')
                        ->maxLength(255),
                    Forms\Components\Toggle::make("section_content.{$sectionKey}.is_active")
                        ->label('Section Active')
                        ->default(true)
                        ->visible(fn (?Page $record): bool => $record?->slug !== 'services'),
                    Forms\Components\Repeater::make("section_content.{$sectionKey}.items")
                        ->label('Progress Counter Items')
                        ->defaultItems(0)
                        ->addable(false)
                        ->deletable(false)
                        ->reorderableWithButtons()
                        ->schema([
                            Forms\Components\Hidden::make('id'),
                            Forms\Components\TextInput::make('description')
                                ->label('Label Kecil (contoh: Training)')
                                ->required()
                                ->maxLength(255),
                            Forms\Components\TextInput::make('title')
                                ->label('Judul Utama')
                                ->required()
                                ->maxLength(255),
                            Forms\Components\TextInput::make('extra.counter')
                                ->label('Counter Number')
                                ->numeric()
                                ->required()
                                ->default(0),
                            Forms\Components\TextInput::make('extra.suffix')
                                ->label('Suffix')
                                ->maxLength(10)
                                ->default('+'),
                        ])
                        ->columns(2)
                        ->collapsed(),
                ];
            } elseif ($sectionKey === 'why_choose_us') {
                $sectionSchema = [
                    Forms\Components\TextInput::make("section_content.{$sectionKey}.section_title")
                        ->label('Section Title')
                        ->maxLength(255),
                    Forms\Components\Repeater::make("section_content.{$sectionKey}.items")
                        ->label('Why Choose Us Items')
                        ->defaultItems(0)
                        ->addable(false)
                        ->deletable(false)
                        ->reorderableWithButtons()
                        ->schema([
                            Forms\Components\Hidden::make('id'),
                            Forms\Components\TextInput::make('title')
                                ->label('Card Title')
                                ->required()
                                ->maxLength(255),
                            Forms\Components\RichEditor::make('description')
                                ->label('Card Description')
                                ->toolbarButtons([
                                    ['bold', 'italic', 'underline'],
                                    ['bulletList', 'orderedList', 'link'],
                                    ['undo', 'redo'],
                                ])
                                ->columnSpanFull(),
                        ])
                        ->columns(2)
                        ->collapsed(),
                ];
            } elseif ($sectionKey === 'client_logos') {
                $sectionSchema = [
                    Forms\Components\TextInput::make("section_content.{$sectionKey}.section_title")
                        ->label('Section Title')
                        ->maxLength(255),
                    Forms\Components\Repeater::make("section_content.{$sectionKey}.items")
                        ->label('Client Logo Items')
                        ->defaultItems(0)
                        ->addable(false)
                        ->deletable(false)
                        ->reorderableWithButtons()
                        ->schema([
                            Forms\Components\Hidden::make('id'),
                            Forms\Components\TextInput::make('title')
                                ->label('Client Name')
                                ->required()
                                ->maxLength(255),
                            Forms\Components\FileUpload::make('extra.image_path')
                                ->label('Logo Image')
                                ->disk('public')
                                ->directory('portfolio/client-logos')
                                ->image()
                                ->maxSize(2048),
                            Forms\Components\RichEditor::make('description')
                                ->label('Description (Optional)')
                                ->toolbarButtons([
                                    ['bold', 'italic', 'underline'],
                                    ['bulletList', 'orderedList', 'link'],
                                    ['undo', 'redo'],
                                ])
                                ->columnSpanFull(),
                        ])
                        ->columns(2)
                        ->collapsed(),
                ];
            } elseif ($sectionKey === 'training_gallery') {
                $sectionSchema = [
                    Forms\Components\TextInput::make("section_content.{$sectionKey}.section_title")
                        ->label('Section Title')
                        ->maxLength(255),
                    Forms\Components\Repeater::make("section_content.{$sectionKey}.items")
                        ->label('Training Gallery Items')
                        ->defaultItems(0)
                        ->addable(false)
                        ->deletable(false)
                        ->reorderableWithButtons()
                        ->schema([
                            Forms\Components\Hidden::make('id'),
                            Forms\Components\TextInput::make('title')
                                ->label('Card Title')
                                ->required()
                                ->maxLength(255),
                            Forms\Components\TextInput::make('badge')
                                ->label('Year / Badge (Optional)')
                                ->maxLength(255),
                            Forms\Components\FileUpload::make('extra.image_path')
                                ->label('Gallery Image')
                                ->disk('public')
                                ->directory('portfolio/training-gallery')
                                ->image()
                                ->maxSize(4096),
                            Forms\Components\RichEditor::make('description')
                                ->label('Card Description')
                                ->toolbarButtons([
                                    ['bold', 'italic', 'underline'],
                                    ['bulletList', 'orderedList', 'link'],
                                    ['undo', 'redo'],
                                ])
                                ->columnSpanFull(),
                        ])
                        ->columns(2)
                        ->collapsed(),
                ];
            } elseif ($sectionKey === 'contact_info') {
                $sectionSchema = [
                    Forms\Components\TextInput::make("section_content.{$sectionKey}.section_title")
                        ->label('Section Title')
                        ->maxLength(255),
                    Forms\Components\Toggle::make("section_content.{$sectionKey}.is_active")
                        ->label('Section Active')
                        ->default(true),
                    Forms\Components\Repeater::make("section_content.{$sectionKey}.items")
                        ->label('Contact Info Items')
                        ->defaultItems(0)
                        ->addable(false)
                        ->deletable(false)
                        ->reorderableWithButtons()
                        ->schema([
                            Forms\Components\Hidden::make('id'),
                            Forms\Components\TextInput::make('title')
                                ->label('Label')
                                ->required()
                                ->maxLength(255),
                            Forms\Components\TextInput::make('description')
                                ->label('Value')
                                ->maxLength(255),
                        ])
                        ->columns(2)
                        ->collapsed(),
                ];
            } elseif ($sectionKey === 'contact_cta') {
                $sectionSchema = [
                    Forms\Components\TextInput::make("section_content.{$sectionKey}.section_title")
                        ->label('Form Title')
                        ->maxLength(255),
                    Forms\Components\Toggle::make("section_content.{$sectionKey}.is_active")
                        ->label('Section Active')
                        ->default(true),
                ];
            } elseif ($sectionKey === 'snapshot') {
                $sectionSchema = [
                    Forms\Components\TextInput::make("section_content.{$sectionKey}.section_title")
                        ->label('Section Title')
                        ->maxLength(255),
                    Forms\Components\Toggle::make("section_content.{$sectionKey}.is_active")
                        ->label('Section Active')
                        ->default(true),
                    Forms\Components\Repeater::make("section_content.{$sectionKey}.items")
                        ->label('Snapshot Items')
                        ->defaultItems(0)
                        ->addable(false)
                        ->deletable(false)
                        ->reorderableWithButtons()
                        ->schema([
                            Forms\Components\Hidden::make('id'),
                            Forms\Components\Hidden::make('badge'),
                            Forms\Components\TextInput::make('title')
                                ->label('Item Title')
                                ->required()
                                ->maxLength(255),
                            Forms\Components\TextInput::make('description')
                                ->label('Item Description / Value')
                                ->required()
                                ->maxLength(255),
                        ])
                        ->columns(2)
                        ->collapsed(),
                ];
            } elseif (in_array($sectionKey, ['who_we_are', 'where_we_come_from', 'commitment', 'vision'], true)) {
                $sectionSchema = [
                    Forms\Components\TextInput::make("section_content.{$sectionKey}.section_title")
                        ->label('Section Title')
                        ->maxLength(255),
                    Forms\Components\RichEditor::make("section_content.{$sectionKey}.section_description")
                        ->label('Section Description')
                        ->toolbarButtons([
                            ['bold', 'italic', 'underline', 'strike'],
                            ['h3', 'bulletList', 'orderedList'],
                            ['blockquote', 'link', 'undo', 'redo'],
                        ])
                                ->columnSpanFull(),
                    Forms\Components\SpatieMediaLibraryFileUpload::make('about_photo')
                        ->label('About Photo')
                        ->collection('about_photo')
                        ->image()
                        ->maxSize(4096)
                        ->visible(fn (?Page $record): bool => $record?->slug === 'about' && $sectionKey === 'who_we_are'),
                    Forms\Components\Toggle::make("section_content.{$sectionKey}.is_active")
                        ->label('Section Active')
                        ->default(true),
                ];
            } elseif ($sectionKey === 'mission_list') {
                $sectionSchema = [
                    Forms\Components\Toggle::make("section_content.{$sectionKey}.is_active")
                        ->label('Section Active')
                        ->default(true),
                    Forms\Components\Repeater::make("section_content.{$sectionKey}.items")
                        ->label('Mission Items')
                        ->defaultItems(0)
                        ->addable(false)
                        ->deletable(false)
                        ->reorderableWithButtons()
                        ->schema([
                            Forms\Components\Hidden::make('id'),
                            Forms\Components\RichEditor::make('description')
                                ->label('Mission Description')
                                ->toolbarButtons([
                                    ['bold', 'italic', 'underline'],
                                    ['bulletList', 'orderedList', 'link'],
                                    ['undo', 'redo'],
                                ])
                                ->columnSpanFull(),
                        ])
                        ->columns(1)
                        ->collapsed(),
                ];
            } elseif ($sectionKey === 'services_intro_cards') {
                $sectionSchema = [
                    Forms\Components\Repeater::make("section_content.{$sectionKey}.items")
                        ->label('Hero Intro Cards')
                        ->defaultItems(2)
                        ->addable(false)
                        ->deletable(false)
                        ->reorderable(false)
                        ->minItems(2)
                        ->maxItems(2)
                        ->schema([
                            Forms\Components\Hidden::make('id'),
                            Forms\Components\TextInput::make('title')
                                ->label('Card Label')
                                ->required()
                                ->maxLength(255),
                            Forms\Components\TextInput::make('description')
                                ->label('Card Description')
                                ->required()
                                ->maxLength(255),
                        ])
                        ->columns(2)
                        ->collapsed(),
                ];
            } elseif ($sectionKey === 'training_domain') {
                $sectionSchema = [
                    Forms\Components\Repeater::make("section_content.{$sectionKey}.items")
                        ->label('Domain Content')
                        ->defaultItems(1)
                        ->addable(false)
                        ->deletable(false)
                        ->reorderable(false)
                        ->minItems(1)
                        ->maxItems(1)
                        ->schema([
                            Forms\Components\Hidden::make('id'),
                            Forms\Components\TextInput::make('title')
                                ->label('Domain Title')
                                ->required()
                                ->maxLength(255),
                            Forms\Components\RichEditor::make('description')
                                ->label('Domain Description')
                                ->toolbarButtons([
                                    ['bold', 'italic', 'underline'],
                                    ['bulletList', 'orderedList', 'link'],
                                    ['undo', 'redo'],
                                ])
                                ->columnSpanFull(),
                            Forms\Components\FileUpload::make('extra.image_path')
                                ->label('Domain Image')
                                ->disk('public')
                                ->directory('services')
                                ->image()
                                ->maxSize(4096)
                                ->required(),
                        ])
                        ->columns(1),
                ];
            } elseif ($sectionKey === 'mentored_learning') {
                $sectionSchema = [
                    Forms\Components\TextInput::make("section_content.{$sectionKey}.section_title")
                        ->label('Section Title')
                        ->maxLength(255),
                    Forms\Components\RichEditor::make("section_content.{$sectionKey}.section_description")
                        ->label('Section Description')
                        ->toolbarButtons([
                            ['bold', 'italic', 'underline'],
                            ['bulletList', 'orderedList', 'link'],
                            ['undo', 'redo'],
                        ])
                        ->columnSpanFull(),
                    Forms\Components\Toggle::make("section_content.{$sectionKey}.is_active")
                        ->label('Section Active')
                        ->default(true),
                    Forms\Components\Repeater::make("section_content.{$sectionKey}.items")
                        ->label('Mentored Learning Items (item pertama untuk foto utama)')
                        ->defaultItems(0)
                        ->addable(false)
                        ->deletable(false)
                        ->reorderableWithButtons()
                        ->schema([
                            Forms\Components\Hidden::make('id'),
                            Forms\Components\TextInput::make('title')
                                ->required()
                                ->maxLength(255),
                            Forms\Components\RichEditor::make('description')
                                ->toolbarButtons([
                                    ['bold', 'italic', 'underline'],
                                    ['bulletList', 'orderedList', 'link'],
                                    ['undo', 'redo'],
                                ])
                                ->columnSpanFull(),
                            Forms\Components\FileUpload::make('extra.image_path')
                                ->label('Image/Icon')
                                ->disk('public')
                                ->directory('services')
                                ->image()
                                ->maxSize(4096)
                                ->required(),
                        ])
                        ->columns(1)
                        ->collapsed(),
                ];
            } elseif (in_array($sectionKey, ['training_support_cards', 'selection_process'], true)) {
                $sectionSchema = [
                    Forms\Components\TextInput::make("section_content.{$sectionKey}.section_title")
                        ->label('Section Title')
                        ->maxLength(255),
                    Forms\Components\RichEditor::make("section_content.{$sectionKey}.section_description")
                        ->label('Section Description')
                        ->toolbarButtons([
                            ['bold', 'italic', 'underline'],
                            ['bulletList', 'orderedList', 'link'],
                            ['undo', 'redo'],
                        ])
                        ->columnSpanFull(),
                    Forms\Components\Toggle::make("section_content.{$sectionKey}.is_active")
                        ->label('Section Active')
                        ->default(true),
                    Forms\Components\Repeater::make("section_content.{$sectionKey}.items")
                        ->label($sectionKey === 'training_support_cards' ? 'Training Support Cards' : 'Selection Process Items')
                        ->defaultItems(0)
                        ->addable(false)
                        ->deletable(false)
                        ->reorderableWithButtons()
                        ->schema([
                            Forms\Components\Hidden::make('id'),
                            Forms\Components\TextInput::make('title')
                                ->required()
                                ->maxLength(255),
                            Forms\Components\RichEditor::make('description')
                                ->toolbarButtons([
                                    ['bold', 'italic', 'underline'],
                                    ['bulletList', 'orderedList', 'link'],
                                    ['undo', 'redo'],
                                ])
                                ->columnSpanFull(),
                        ])
                        ->columns(1)
                        ->collapsed(),
                ];
            } elseif (in_array($sectionKey, ['training_blocks', 'outsourcing_blocks', 'talent_profiles', 'benefit_cards'], true)) {
                $sectionSchema = [
                    Forms\Components\TextInput::make("section_content.{$sectionKey}.section_title")
                        ->label('Section Title')
                        ->maxLength(255),
                    Forms\Components\TextInput::make("section_content.{$sectionKey}.section_subtitle")
                        ->label('Section Subtitle')
                        ->maxLength(255),
                    Forms\Components\RichEditor::make("section_content.{$sectionKey}.section_description")
                        ->label('Section Description')
                        ->toolbarButtons([
                            ['bold', 'italic', 'underline'],
                            ['bulletList', 'orderedList', 'link'],
                            ['undo', 'redo'],
                        ])
                        ->columnSpanFull(),
                    Forms\Components\Toggle::make("section_content.{$sectionKey}.is_active")
                        ->label('Section Active')
                        ->default(true),
                    Forms\Components\Repeater::make("section_content.{$sectionKey}.items")
                        ->label(match ($sectionKey) {
                            'training_blocks' => 'Training Overview Cards',
                            'outsourcing_blocks' => 'Outsourcing Overview Cards',
                            'talent_profiles', 'services_talent_profiles' => 'Talent Profile Cards',
                            default => 'Section Items',
                        })
                        ->defaultItems(0)
                        ->addable(false)
                        ->deletable(false)
                        ->reorderableWithButtons()
                        ->schema([
                            Forms\Components\Hidden::make('id'),
                            Forms\Components\TextInput::make('title')
                                ->required()
                                ->maxLength(255),
                            Forms\Components\RichEditor::make('description')
                                ->toolbarButtons([
                                    ['bold', 'italic', 'underline'],
                                    ['bulletList', 'orderedList', 'link'],
                                    ['undo', 'redo'],
                                ])
                                ->columnSpanFull(),
                        ])
                        ->columns(1)
                        ->collapsed(),
                ];
            } elseif ($sectionKey === 'services_talent_profiles') {
                $sectionSchema = [
                    Forms\Components\TextInput::make("section_content.{$sectionKey}.section_title")
                        ->label('Section Title')
                        ->maxLength(255),
                    Forms\Components\RichEditor::make("section_content.{$sectionKey}.section_description")
                        ->label('Section Description')
                        ->toolbarButtons([
                            ['bold', 'italic', 'underline'],
                            ['bulletList', 'orderedList', 'link'],
                            ['undo', 'redo'],
                        ])
                        ->columnSpanFull(),
                    Forms\Components\Toggle::make("section_content.{$sectionKey}.is_active")
                        ->label('Section Active')
                        ->default(true),
                    Forms\Components\Repeater::make("section_content.{$sectionKey}.items")
                        ->label('Talent Profile Cards')
                        ->defaultItems(0)
                        ->addable(false)
                        ->deletable(false)
                        ->reorderableWithButtons()
                        ->schema([
                            Forms\Components\Hidden::make('id'),
                            Forms\Components\TextInput::make('title')
                                ->required()
                                ->maxLength(255),
                            Forms\Components\RichEditor::make('description')
                                ->toolbarButtons([
                                    ['bold', 'italic', 'underline'],
                                    ['bulletList', 'orderedList', 'link'],
                                    ['undo', 'redo'],
                                ])
                                ->columnSpanFull(),
                            Forms\Components\FileUpload::make('extra.image_path')
                                ->label('Image/Icon')
                                ->disk('public')
                                ->directory('services')
                                ->image()
                                ->maxSize(4096)
                                ->required()
                                ->columnSpanFull(),
                        ])
                        ->columns(1)
                        ->collapsed(),
                ];
            } elseif ($sectionKey === 'training_domains') {
                $sectionSchema = [
                    Forms\Components\Toggle::make("section_content.{$sectionKey}.is_active")
                        ->label('Section Active')
                        ->default(true),
                    Forms\Components\Repeater::make("section_content.{$sectionKey}.items")
                        ->label('Training Domain Items')
                        ->defaultItems(0)
                        ->addable(false)
                        ->deletable(false)
                        ->reorderableWithButtons()
                        ->schema([
                            Forms\Components\Hidden::make('id'),
                            Forms\Components\TextInput::make('title')
                                ->required()
                                ->maxLength(255),
                            Forms\Components\RichEditor::make('description')
                                ->toolbarButtons([
                                    ['bold', 'italic', 'underline'],
                                    ['bulletList', 'orderedList', 'link'],
                                    ['undo', 'redo'],
                                ])
                                ->columnSpanFull(),
                            Forms\Components\TextInput::make('badge')
                                ->label('Badge (Optional)')
                                ->maxLength(255),
                        ])
                        ->columns(1)
                        ->collapsed(),
                ];
            } elseif ($sectionKey === 'cta') {
                $sectionSchema = [
                    Forms\Components\TextInput::make("section_content.{$sectionKey}.section_title")
                        ->label('FAQ Title')
                        ->maxLength(255),
                    Forms\Components\Toggle::make("section_content.{$sectionKey}.is_active")
                        ->label('FAQ Active')
                        ->default(true),
                    Forms\Components\Repeater::make("section_content.{$sectionKey}.items")
                        ->label('FAQ Items')
                        ->defaultItems(0)
                        ->addable(false)
                        ->deletable(false)
                        ->reorderableWithButtons()
                        ->schema([
                            Forms\Components\Hidden::make('id'),
                            Forms\Components\TextInput::make('title')
                                ->label('Question')
                                ->required()
                                ->maxLength(255),
                            Forms\Components\RichEditor::make('description')
                                ->label('Answer')
                                ->toolbarButtons([
                                    ['bold', 'italic', 'underline'],
                                    ['bulletList', 'orderedList', 'link'],
                                    ['undo', 'redo'],
                                ])
                                ->columnSpanFull(),
                        ])
                        ->columns(1)
                        ->collapsed(),
                ];
            } else {
                $sectionSchema = [
                    Forms\Components\TextInput::make("section_content.{$sectionKey}.section_title")
                        ->label('Section Title')
                        ->maxLength(255),
                    Forms\Components\RichEditor::make("section_content.{$sectionKey}.section_description")
                        ->label('Section Description')
                        ->toolbarButtons([
                            ['bold', 'italic', 'underline', 'strike'],
                            ['h3', 'bulletList', 'orderedList'],
                            ['blockquote', 'link', 'undo', 'redo'],
                        ])
                        ->columnSpanFull(),
                    Forms\Components\Toggle::make("section_content.{$sectionKey}.is_active")
                        ->label('Section Active')
                        ->default(true),
                    Forms\Components\Repeater::make("section_content.{$sectionKey}.items")
                        ->label('Section Items')
                        ->defaultItems(0)
                        ->addable(false)
                        ->deletable(false)
                        ->reorderableWithButtons()
                        ->schema([
                            Forms\Components\Hidden::make('id'),
                            Forms\Components\TextInput::make('title')
                                ->required()
                                ->maxLength(255),
                            Forms\Components\RichEditor::make('description')
                                ->toolbarButtons([
                                    ['bold', 'italic', 'underline'],
                                    ['bulletList', 'orderedList', 'link'],
                                    ['undo', 'redo'],
                                ])
                                ->columnSpanFull(),
                            Forms\Components\TextInput::make('badge')
                                ->maxLength(255),
                        ])
                        ->columns(2)
                        ->collapsed(),
                ];
            }

            $tabLabel = $sectionKey === 'cta'
                ? 'FAQ'
                : str($sectionKey)->replace('_', ' ')->title()->toString();

            $tabs[] = Tab::make($tabLabel)
                ->visible(fn (?Page $record): bool => $record instanceof Page
                    && in_array($sectionKey, config("company_profile.section_keys.{$record->slug}", []), true))
                ->schema($sectionSchema);
        }

        return $schema->components([
            Tabs::make('Page Content')
                ->persistTab()
                ->id('page-content-tabs')
                ->tabs($tabs)
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        $orderedSlugs = self::orderedSlugs();
        $orderSql = "CASE slug ";

        foreach ($orderedSlugs as $index => $slug) {
            $position = $index + 1;
            $orderSql .= "WHEN '{$slug}' THEN {$position} ";
        }

        $orderSql .= 'ELSE 999 END';

        return $table
            ->modifyQueryUsing(fn ($query) => $query
                ->whereIn('slug', $orderedSlugs)
                ->orderByRaw($orderSql))
            ->columns([
                Tables\Columns\TextColumn::make('slug')
                    ->label('Page')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => self::pageLabels()[$state] ?? $state),
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
            'index' => Pages\ListPages::route('/'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
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
