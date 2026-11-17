<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogResource\Pages;
use App\Filament\Resources\BlogResource\RelationManagers;
use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;

class BlogResource extends Resource
{
    protected static ?string $model = Blog::class;
    protected static ?string $navigationGroup = 'Content';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        $categories = Category::orderBy('order')->get()->pluck('name', 'id');
        $authors = User::orderBy('name')->get()->pluck('name', 'id');
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->live(onBlur: true)
                    ->afterStateUpdated(function ($operation, $state, Forms\Set $set) {
                        if ($operation !== 'create') {
                            return;
                        }
                        $set('slug', \Str::slug($state));
                    }),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
                Forms\Components\FileUpload::make('image')
                    ->required()
                    ->image()
                    //->previewable(true)
                    ->imageEditor()
                    ->maxSize(100) // 100 KB
                    ->imageCropAspectRatio('5:3')
                    //->imageResizeTargetWidth(1000)
                    //->imageResizeTargetHeight(600)
                    ->imageResizeMode('cover')
                    ->helperText('Upload AVIF or WebP image (5:3 ratio, max 100KB)'),

                Forms\Components\TextInput::make('image_alt_text')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('video_embed')
                    ->label('Or Video (embeded code')
                    ->maxLength(255),
                Forms\Components\RichEditor::make('content')
                    // ->view('forms.components.summernote-editor')
                    ->required()
                    ->columnSpanFull()
                    ->dehydrated(true)
                    ->reactive(),
                Forms\Components\Select::make('category_id')
                    ->required()
                    ->label('Category')
                    ->options($categories)
                    ->searchable()
                    ->native(false),
                Forms\Components\Select::make('user_id')
                    ->required()
                    ->label('Author')
                    ->options($authors)
                    ->searchable()
                    ->native(false),
                Forms\Components\TextInput::make('reading_time')
                    ->required()
                    ->maxLength(255)
                    ->default('3 minutes'),

                Forms\Components\TextInput::make('fb_url')
                    ->maxLength(255),
                Forms\Components\TextInput::make('linkedin_url')
                    ->maxLength(255),
                Forms\Components\TextInput::make('twitter_url')
                    ->maxLength(255),
                Forms\Components\TextInput::make('telegram_url')
                    ->tel()
                    ->maxLength(255),
                Forms\Components\Toggle::make('is_slider')
                    ->required()
                    ->default(true)
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('is_trending')
                    ->required()
                    ->default(true)
                    ->columnSpanFull(),
                // Forms\Components\Toggle::make('is_published')
                //     ->required()
                //     ->default(true)
                //     ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                // Tables\Columns\TextColumn::make('slug')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('video_embed')
                //     ->searchable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Category')
                    ->sortable(),
                Tables\Columns\TextColumn::make('author.name')
                    ->label('Author')
                    ->sortable(),
                Tables\Columns\TextColumn::make('reading_time')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_published')
                    ->boolean(),
                Tables\Columns\TextColumn::make('view_count')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_slider')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_trending')
                    ->boolean(),
                // Tables\Columns\TextColumn::make('fb_url')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('linkedin_url')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('twitter_url')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('telegram_url')
                //     ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                // Tables\Columns\TextColumn::make('updated_at')
                //     ->dateTime()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
                // Tables\Columns\TextColumn::make('deleted_at')
                //     ->dateTime()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListBlogs::route('/'),
            'create' => Pages\CreateBlog::route('/create'),
            'view' => Pages\ViewBlog::route('/{record}'),
            'edit' => Pages\EditBlog::route('/{record}/edit'),
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
