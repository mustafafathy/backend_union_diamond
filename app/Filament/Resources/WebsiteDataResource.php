<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WebsiteDataResource\Pages;
use App\Filament\Resources\WebsiteDataResource\RelationManagers;
use App\Models\WebsiteData;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WebsiteDataResource extends Resource
{
    protected static ?string $model = WebsiteData::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static bool $shouldRegisterNavigation = false;

    public static function getNavigationSort(): ?int
    {
        return 4;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('projects_count')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('units_count')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('res_num1')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('res_num2')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('whats_app_num')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('instagram_link')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('footer_num1')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('footer_num2')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('latitude')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('longitude')
                    ->required()
                    ->numeric(),
                Forms\Components\FileUpload::make('logos')
                    ->label('Logos')
                    ->image()
                    ->multiple()
                    ->acceptedFileTypes(['image/*'])
                    ->directory('images/logos')
                    ->visibility('public')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('projects_count')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('units_count')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('res_num1')
                    ->searchable(),
                Tables\Columns\TextColumn::make('res_num2')
                    ->searchable(),
                Tables\Columns\TextColumn::make('whats_app_num')
                    ->searchable(),
                Tables\Columns\TextColumn::make('instagram_link')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('footer_num1')
                    ->searchable(),
                Tables\Columns\TextColumn::make('footer_num2')
                    ->searchable(),
                Tables\Columns\TextColumn::make('latitude')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('longitude')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWebsiteData::route('/'),
            'edit' => Pages\EditWebsiteData::route('/{record}/edit'),
        ];
    }
}
