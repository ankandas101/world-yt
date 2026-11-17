<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactInfoResource\Pages;
use App\Filament\Resources\ContactInfoResource\RelationManagers;
use App\Models\ContactInfo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContactInfoResource extends Resource
{
    protected static ?string $model = ContactInfo::class;
    protected static ?string $navigationGroup = 'Settings';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone2')
                    ->tel()
                    ->maxLength(255),
                Forms\Components\TextInput::make('whatsapp')
                    ->maxLength(255),
                Forms\Components\Textarea::make('address')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('map_embed')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('fb_url')
                    ->maxLength(255),
                Forms\Components\TextInput::make('linkedin_url')
                    ->maxLength(255),
                Forms\Components\TextInput::make('twitter_url')
                    ->maxLength(255),
                Forms\Components\TextInput::make('telegram_url')
                    ->tel()
                    ->maxLength(255),
            ]);
    }

    // public static function table(Table $table): Table
    // {
    //     return $table
    //         ->columns([
    //             Tables\Columns\TextColumn::make('email')
    //                 ->searchable(),
    //             Tables\Columns\TextColumn::make('phone')
    //                 ->searchable(),
    //             Tables\Columns\TextColumn::make('phone2')
    //                 ->searchable(),
    //             Tables\Columns\TextColumn::make('whatsapp')
    //                 ->searchable(),
    //             Tables\Columns\TextColumn::make('fb_url')
    //                 ->searchable(),
    //             Tables\Columns\TextColumn::make('linkedin_url')
    //                 ->searchable(),
    //             Tables\Columns\TextColumn::make('twitter_url')
    //                 ->searchable(),
    //             Tables\Columns\TextColumn::make('telegram_url')
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
        $record = ContactInfo::firstOrCreate([]);
        return [
            'index' => Pages\ListContactInfos::route('/'),
            'edit' => Pages\EditContactInfo::route("/{record}/edit"),
        ];
    }
}
