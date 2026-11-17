<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiteInfoResource\Pages;
use App\Filament\Resources\SiteInfoResource\RelationManagers;
use App\Models\SiteInfo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SiteInfoResource extends Resource
{
    protected static ?string $model = SiteInfo::class;
    protected static ?string $navigationGroup = 'Settings';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('site_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('site_tagline')
                    ->maxLength(255),
                Forms\Components\FileUpload::make('site_logo')
                    ->image()
                    ->imageEditor(),
                Forms\Components\FileUpload::make('site_favicon')
                    ->label('Site Favicon (32X32 or 48X48)')
                    ->image()
                    ->imageEditor(),
                Forms\Components\TextInput::make('site_primary_color')
                    ->maxLength(255),
                Forms\Components\TextInput::make('site_secondary_color')
                    ->maxLength(255),
                Forms\Components\FileUpload::make('default_og_image')
                    ->image(),
            ]);
    }

    // public static function table(Table $table): Table
    // {
    //     return $table
    //         ->columns([
    //             Tables\Columns\TextColumn::make('site_name')
    //                 ->searchable(),
    //             Tables\Columns\TextColumn::make('site_tagline')
    //                 ->searchable(),
    //             Tables\Columns\TextColumn::make('site_logo')
    //                 ->searchable(),
    //             Tables\Columns\TextColumn::make('site_favicon')
    //                 ->searchable(),
    //             Tables\Columns\TextColumn::make('site_primary_color')
    //                 ->searchable(),
    //             Tables\Columns\TextColumn::make('site_secondary_color')
    //                 ->searchable(),
    //             Tables\Columns\ImageColumn::make('default_og_image'),
    //             Tables\Columns\TextColumn::make('created_at')
    //                 ->dateTime()
    //                 ->sortable()
    //                 ->toggleable(isToggledHiddenByDefault: true),
    //             Tables\Columns\TextColumn::make('updated_at')
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
            'index' => Pages\ListSiteInfos::route('/'),
            // 'create' => Pages\CreateSiteInfo::route('/create'),
            'edit' => Pages\EditSiteInfo::route('/{record}/edit'),
        ];
    }
}
