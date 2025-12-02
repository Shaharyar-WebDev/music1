<?php

namespace App\Filament\Resources\Songs\Schemas;

use Illuminate\Support\Str;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Textarea;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;

class SongForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->live(onBlur: true)
                    ->afterStateUpdated(function ($get, $set) {
                        $title = $get('title');
                        // convert title to slug
                        $slug = Str::slug($title);
                        $set('slug', $slug);
                    })
                    ->required(),

                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true),

                FileUpload::make('thumbnail')
                    ->label('Thumbnail')
                    ->image()
                    ->directory('thumbnails')
                    ->disk('public')
                    ->visibility('public')
                    ->required()
                    ->deleteUploadedFileUsing(function ($file) {
                        Storage::disk('public')->delete($file);
                    })
                    ->downloadable()
                    ->openable()
                    ->columnSpanFull(),

                FileUpload::make('audio')
                    ->label('Audio')
                    ->acceptedFileTypes(['audio/mpeg', 'audio/mp3'])
                    ->directory('songs')
                    ->disk('public')
                    ->maxSize(10240)
                    ->visibility('public')
                    ->required()
                    ->deleteUploadedFileUsing(function ($file) {
                        Storage::disk('public')->delete($file);
                    })
                    ->downloadable()
                    ->openable()
                    ->columnSpanFull(),
            ]);
    }
}
