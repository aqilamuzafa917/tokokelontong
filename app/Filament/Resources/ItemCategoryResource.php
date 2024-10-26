<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ItemCategoryResource\Pages;
use App\Models\ItemCategory; // Import your ItemCategory model
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;


class ItemCategoryResource extends Resource
{
    protected static ?string $model = ItemCategory::class; // Your model class

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack'; // Navigation icon for the resource
    protected static ?string $navigationGroup = 'Master Data';

    // Define the form schema
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Name') // Label for the name input
                    ->required() // Required field
                    ->maxLength(191), // Maximum length for varchar(191)
            ]);
    }

    // Define the table schema
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id') 
                    ->label('ID') // Label for the ID column
                    ->sortable()
                    ->searchable(), // Enable sorting

                Tables\Columns\TextColumn::make('name')
                    ->label('Name') // Label for the Name column
                    ->sortable()
                    ->searchable(), // Enable sorting

         
            ])
            ->filters([
                // Add any filters if necessary
            ])
            ->actions([
                Tables\Actions\EditAction::make(), // Enable edit action
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(), // Enable delete action
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Define any relationships if necessary
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListItemCategories::route('/'),
            'create' => Pages\CreateItemCategory::route('/create'),
            'edit' => Pages\EditItemCategory::route('/{record}/edit'),
        ];
    }
}
