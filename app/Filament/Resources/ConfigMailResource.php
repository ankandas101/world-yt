<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ConfigMailResource\Pages;
use App\Filament\Resources\ConfigMailResource\RelationManagers;
use App\Models\ConfigMail;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ConfigMailResource extends Resource
{
    protected static ?string $model = ConfigMail::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = "Configurations";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('smtp_host')
                    ->maxLength(255),
                Forms\Components\TextInput::make('smtp_port')
                    ->maxLength(255),
                Forms\Components\TextInput::make('smtp_username')
                    ->maxLength(255),
                Forms\Components\TextInput::make('smtp_password')
                    ->password()
                    ->maxLength(255),
                Forms\Components\TextInput::make('smtp_encryption')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('smtp_host')
                    ->searchable(),
                Tables\Columns\TextColumn::make('smtp_port')
                    ->searchable(),
                Tables\Columns\TextColumn::make('smtp_username')
                    ->searchable(),
                Tables\Columns\TextColumn::make('smtp_encryption')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
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
            'index' => Pages\ListConfigMails::route('/'),
            // 'create' => Pages\CreateConfigMail::route('/create'),
            'edit' => Pages\EditConfigMail::route('/{record}/edit'),
        ];
    }
}
