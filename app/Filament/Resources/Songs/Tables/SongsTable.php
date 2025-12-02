<?php

namespace App\Filament\Resources\Songs\Tables;

use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Grid;
use Filament\Tables\Columns\Layout\Panel;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;

class SongsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Panel::make([
                    Stack::make([
                        ImageColumn::make('thumbnail')
                            ->label('Thumbnail')
                            ->disk('public')
                            ->imageSize(160)
                            // ->imageWidth(300)
                            ->extraAttributes(['class' => 'table-song-card'])
                        // ->toggleable()
                        ,

                        TextColumn::make('title')
                            ->label('Title')
                            ->searchable()
                            ->sortable()
                            // ->toggleable()
                            ->weight('bold')
                            ->extraAttributes(['class' => 'text-center text-lg mt-2']),

                        TextColumn::make('slug')
                            ->label('Slug')
                            ->searchable()
                            ->sortable()
                            // ->toggleable()
                            ->extraAttributes(['class' => 'text-center text-sm text-gray-500 mt-1']),

                        Panel::make([
                            TextColumn::make('audio')
                                ->label('Audio')
                                // ->sortable()
                                // ->toggleable()
                                ->html()
                                ->extraAttributes(['class' => 'whitespace-normal mt-2'])
                                ->formatStateUsing(
                                    fn($state) => $state
                                    ? '<audio controls style="width: 100%;">
                           <source src="' . asset('storage/' . $state) . '" type="audio/mpeg">
                       </audio>'
                                    : null
                                ),
                        ])
                            ->collapsible()
                    ])
                        ->alignCenter()
                        ->extraAttributes(['class' => 'text-center']), // center everything
                ])
                    ->columnSpanFull(),
            ])
            ->contentGrid([
                'md' => 2,
                'xl' => 3,
            ])
            ->filters([
                //
            ])
            // ->reorderableColumns()
            ->defaultSort('created_at', 'desc')
            ->recordActions([
                // ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
