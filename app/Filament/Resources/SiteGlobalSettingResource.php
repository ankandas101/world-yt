<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiteGlobalSettingResource\Pages;
use App\Filament\Resources\SiteGlobalSettingResource\RelationManagers;
use App\Models\SiteGlobalSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SiteGlobalSettingResource extends Resource
{
    protected static ?string $model = SiteGlobalSetting::class;
    protected static ?string $navigationGroup = 'Settings';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Toggle::make('maintenance_mode')
                    ->required(),
                Forms\Components\Textarea::make('maintenance_message')
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('enable_recaptcha')
                    ->required(),
                Forms\Components\Toggle::make('enable_email')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\IconColumn::make('maintenance_mode')
                    ->boolean(),
                Tables\Columns\IconColumn::make('enable_recaptcha')
                    ->boolean(),
                Tables\Columns\IconColumn::make('enable_email')
                    ->boolean(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSiteGlobalSettings::route('/'),
            // 'create' => Pages\CreateSiteGlobalSetting::route('/create'),
            'edit' => Pages\EditSiteGlobalSetting::route('/{record}/edit'),
        ];
    }
}
