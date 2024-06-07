<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Filament\Resources\ProjectResource\RelationManagers\PlansRelationManager;
use App\Models\Logo;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use IbrahimBougaoua\RadioButtonImage\Actions\RadioButtonImage;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-list-bullet';

    public static function getNavigationSort(): ?int
    {
        return 1;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('type')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('description')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\Toggle::make('is_featured')
                            ->required(),
                        Forms\Components\Select::make('status')
                            ->required()
                            ->options([
                                '1' => 'قريبا',
                                '2' => 'متاح',
                                '3' => 'مباع',
                                '4' => 'جاري الإنشاء',
                            ]),
                    ])
                    ->columns(2),
                Section::make('')
                    ->schema([
                        Forms\Components\TextInput::make('area')
                            ->required()
                            ->numeric(),
                        Forms\Components\TextInput::make('units_no')
                            ->label('Units Number')
                            ->required()
                            ->numeric(),
                    ])
                    ->columns(2),
                Section::make('Features')
                    ->schema([
                        CheckboxList::make('features')
                            ->label('')
                            ->columns(5)
                            ->relationship('features', 'name'),
                    ]),
                Section::make("Media")
                    ->schema([
                        RadioButtonImage::make('logo_id')
                            ->label('Logo')
                            ->options(Logo::all()->pluck('image', 'id')->toArray()),
                        Forms\Components\FileUpload::make('main_image')
                            ->label('Main Image')
                            ->image()
                            ->directory('images/main')
                            ->visibility('public')
                            ->acceptedFileTypes(['image/*'])
                            ->required(),
                        Forms\Components\FileUpload::make('alt_images')
                            ->label('Alt Images')
                            ->image()
                            ->multiple()
                            ->acceptedFileTypes(['image/*'])
                            ->directory('images/alt')
                            ->visibility('public')
                            ->required(),
                        Forms\Components\FileUpload::make('stages_images')
                            ->label('Stages Images')
                            ->image()
                            ->multiple()
                            ->acceptedFileTypes(['image/*'])
                            ->directory('images/stages')
                            ->visibility('public'),
                        Forms\Components\FileUpload::make('brochure')
                            ->required()
                            ->acceptedFileTypes(['application/pdf'])
                            ->directory('documents'),
                        Forms\Components\TextInput::make('video')
                            ->required()
                            ->maxLength(255),
                    ])->columns(2),
                Section::make('Location')
                    ->schema([
                        Forms\Components\TextInput::make('latitude')
                            ->required()
                            ->numeric(),
                        Forms\Components\TextInput::make('longitude')
                            ->required()
                            ->numeric(),
                    ])->columns(2),
                Section::make('Plans')
                    ->schema([
                        Repeater::make('plans')
                            ->grid(2)
                            ->label('')
                            ->relationship()
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\FileUpload::make('image')
                                    ->required()
                                    ->directory('images/plans')
                                    ->visibility('public')
                                    ->acceptedFileTypes(['image/*']),
                            ])
                            ->addActionLabel('Add another plan'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('area')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('units_no')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean(),
                Tables\columns\TextColumn::make('description')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\ImageColumn::make('main_image'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            PlansRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
