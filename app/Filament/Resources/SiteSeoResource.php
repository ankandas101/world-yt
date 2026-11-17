<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiteSeoResource\Pages;
use App\Filament\Resources\SiteSeoResource\RelationManagers;
use App\Models\SiteSeo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SiteSeoResource extends Resource
{
    protected static ?string $model = SiteSeo::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'SEO';
    protected static ?string $navigationLabel = 'Site SEO';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('meta_title')
                    ->maxLength(255),
                Forms\Components\Textarea::make('meta_description')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('meta_keywords')
                    ->maxLength(255),
                Forms\Components\TextInput::make('site_logo_alt_text')
                    ->maxLength(255),
                Forms\Components\TextInput::make('site_tagline_meta')
                    ->maxLength(255),
                Forms\Components\TextInput::make('google_analytics_id')
                    ->maxLength(255),
                Forms\Components\TextInput::make('google_search_console_verification')
                    ->maxLength(255),
                Forms\Components\Textarea::make('robots_txt')
                    ->columnSpanFull(),
            ]);
    }

    // public static function table(Table $table): Table
    // {
    //     return $table
    //         ->columns([
    //             Tables\Columns\TextColumn::make('meta_title')
    //                 ->searchable(),
    //             Tables\Columns\TextColumn::make('meta_keywords')
    //                 ->searchable(),
    //             Tables\Columns\TextColumn::make('site_logo_alt_text')
    //                 ->searchable(),
    //             Tables\Columns\TextColumn::make('site_tagline_meta')
    //                 ->searchable(),
    //             Tables\Columns\TextColumn::make('google_analytics_id')
    //                 ->searchable(),
    //             Tables\Columns\TextColumn::make('google_search_console_verification')
    //                 ->searchable(),
    //             Tables\Columns\TextColumn::make('created_at')
    //                 ->dateTime()
    //                 ->sortable()
    //                 ->toggleable(isToggledHiddenByDefault: true),
    //             Tables\Columns\TextColumn::make('updated_at')
    //                 ->dateTime()
    //                 ->sortable()
    //                 ->toggleable(isToggledHiddenByDefault: true),
    //             Tables\Columns\TextColumn::make('deleted_at')
    //                 ->dateTime()
    //                 ->sortable()
    //                 ->toggleable(isToggledHiddenByDefault: true),
    //         ])
    //         ->filters([
    //             //
    //         ])
    //         ->actions([
    //             Tables\Actions\EditAction::make(),
    //         ])
    //         ->bulkActions([
    //             Tables\Actions\BulkActionGroup::make([
    //                 Tables\Actions\DeleteBulkAction::make(),
    //             ]),
    //         ]);
    // }

    // public static function getRelations(): array
    // {
    //     return [
    //         //
    //     ];
    // }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSiteSeos::route('/'),
            // 'create' => Pages\CreateSiteSeo::route('/create'),
            'edit' => Pages\EditSiteSeo::route('/{record}/edit'),
        ];
    }
}
