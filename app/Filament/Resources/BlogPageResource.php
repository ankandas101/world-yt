<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogPageResource\Pages;
use App\Filament\Resources\BlogPageResource\RelationManagers;
use App\Models\BlogPage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BlogPageResource extends Resource
{
    protected static ?string $model = BlogPage::class;
    protected static ?string $navigationGroup = 'Page Setting';
    // protected static ?string $subNavigationGroup = 'Page Setting';
    protected static ?string $navigationLabel = 'Blog Page Settings';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('post_per_page')
                    ->required()
                    ->numeric()
                    ->default(10),
                Forms\Components\Toggle::make('enable_command_mode')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    // public static function table(Table $table): Table
    // {
    //     return $table
    //         ->columns([
    //             Tables\Columns\TextColumn::make('post_per_page')
    //                 ->numeric()
    //                 ->sortable(),
    //             Tables\Columns\IconColumn::make('enable_command_mode')
    //                 ->boolean(),
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
            'index' => Pages\ListBlogPages::route('/'),
            // 'create' => Pages\CreateBlogPage::route('/create'),
            'edit' => Pages\EditBlogPage::route('/{record}/edit'),
        ];
    }
}
