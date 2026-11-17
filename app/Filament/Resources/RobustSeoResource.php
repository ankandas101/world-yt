<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RobustSeoResource\Pages;
use App\Filament\Resources\RobustSeoResource\RelationManagers;
use App\Models\Blog;
use App\Models\RobustSeo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RobustSeoResource extends Resource
{
    protected static ?string $model = RobustSeo::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'SEO';
    protected static ?string $navigationLabel = 'Robust SEO';
    public static function form(Form $form): Form
    {
        $blogs = Blog::latest()->get()->pluck('title', 'id');
        return $form
            ->schema([
                Forms\Components\Select::make('blog_id')
                    ->required()
                    ->label('Blog')
                    ->options($blogs)
                    ->searchable()
                    ->native(false),
                Forms\Components\TextInput::make('meta_title')
                    ->maxLength(255),
                Forms\Components\Textarea::make('meta_description')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('focus_keywords')
                    ->maxLength(255),
                Forms\Components\TextInput::make('meta_tags')
                    ->maxLength(255),
                Forms\Components\TextInput::make('conical_url')
                    ->maxLength(255),
                Forms\Components\TextInput::make('og_title')
                    ->maxLength(255),
                Forms\Components\TextInput::make('og_description')
                    ->maxLength(255),
                Forms\Components\Toggle::make('no_index')
                    ->required()
                    ->default(false)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('blog.title')
                    ->label('Blog Title')
                    ->sortable(),
                Tables\Columns\TextColumn::make('meta_title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('focus_keywords')
                    ->searchable(),
                Tables\Columns\TextColumn::make('meta_tags')
                    ->searchable(),
                Tables\Columns\TextColumn::make('conical_url')
                    ->searchable(),
                Tables\Columns\TextColumn::make('og_title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('og_description')
                    ->searchable(),
                Tables\Columns\IconColumn::make('no_index')
                    ->boolean(),
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
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListRobustSeos::route('/'),
            'create' => Pages\CreateRobustSeo::route('/create'),
            'view' => Pages\ViewRobustSeo::route('/{record}'),
            'edit' => Pages\EditRobustSeo::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
