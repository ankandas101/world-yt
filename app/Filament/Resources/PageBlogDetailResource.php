<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageBlogDetailResource\Pages;
use App\Filament\Resources\PageBlogDetailResource\RelationManagers;
use App\Models\PageBlogDetail;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PageBlogDetailResource extends Resource
{
    protected static ?string $model = PageBlogDetail::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Page Setting';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('posts_per_page')
                    ->required()
                    ->numeric()
                    ->default(10),
                Forms\Components\Toggle::make('enable_comments')
                    ->required(),
                // Forms\Components\FileUpload::make('default_post_image')
                //     ->image(),
                Forms\Components\Toggle::make('show_related_posts')
                    ->required(),
                Forms\Components\Toggle::make('show_author_info')
                    ->required(),
                Forms\Components\Toggle::make('show_social_share_buttons')
                    ->required(),
                Forms\Components\Select::make('check_also_blog')
                    ->relationship('pop_up_blog', titleAttribute: 'title')
                    ->searchable()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('posts_per_page')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('enable_comments')
                    ->boolean(),
                // Tables\Columns\ImageColumn::make('default_post_image'),
                Tables\Columns\IconColumn::make('show_related_posts')
                    ->boolean(),
                Tables\Columns\IconColumn::make('show_author_info')
                    ->boolean(),
                Tables\Columns\IconColumn::make('show_social_share_buttons')
                    ->boolean(),
                Tables\Columns\TextColumn::make('check_also_blog')
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
            'index' => Pages\ListPageBlogDetails::route('/'),
            // 'create' => Pages\CreatePageBlogDetail::route('/create'),
            'edit' => Pages\EditPageBlogDetail::route('/{record}/edit'),
        ];
    }
}
