<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransactionResource\Pages;
use App\Models\Transaction;
use App\Models\Item;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Notifications\Notification;
use Illuminate\Support\Collection;
use Filament\Infolists;
use Filament\Infolists\Infolist;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    protected static ?string $navigationGroup = 'Transactions';

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Transaction Information')
                    ->schema([
                        Infolists\Components\TextEntry::make('id')
                            ->label('Transaction ID'),
                        Infolists\Components\TextEntry::make('user.name')
                            ->label('Customer'),
                        Infolists\Components\TextEntry::make('created_at')
                            ->label('Transaction Date')
                            ->dateTime(),
                        Infolists\Components\TextEntry::make('total')
                            ->label('Total Amount')
                            ->money('IDR'),
                    ])
                    ->columns(2),
                
                Infolists\Components\Section::make('Transaction Details')
                    ->schema([
                        Infolists\Components\RepeatableEntry::make('transactionDetails')
                            ->schema([
                                Infolists\Components\TextEntry::make('item.name')
                                    ->label('Item'),
                                Infolists\Components\TextEntry::make('quantity')
                                    ->label('Quantity'),
                                Infolists\Components\TextEntry::make('subtotal')
                                    ->label('Subtotal')
                                    ->money('IDR'),
                            ])
                            ->columns(3)
                    ]),
            ]);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required()
                    ->label('Customer'),
                Forms\Components\Repeater::make('transactionDetails')
                    ->relationship()
                    ->schema([
                        Forms\Components\Select::make('item_id')
                            ->relationship('item', 'name')
                            ->required()
                            ->reactive()
                            ->options(function (Get $get): Collection {
                                $selectedItems = collect($get('../*.item_id'))
                                    ->filter()
                                    ->values()
                                    ->toArray();

                                $currentItemId = $get('item_id');

                                if ($currentItemId) {
                                    $selectedItems = array_filter($selectedItems, fn ($id) => $id != $currentItemId);
                                }

                                return Item::whereNotIn('id', $selectedItems)
                                    ->pluck('name', 'id');
                            })
                            ->afterStateUpdated(function ($state, Set $set, Get $get) {
                                $item = Item::find($state);
                                if ($item) {
                                    $set('quantity', 1);
                                    $set('subtotal', $item->price);
                                    $remainingStock = $item->stock - 1;
                                    $set('stock', max($remainingStock, 0));
                                }
                            }),
                        Forms\Components\TextInput::make('quantity')
                            ->required()
                            ->numeric()
                            ->minValue(1)
                            ->reactive()
                            ->afterStateUpdated(function ($state, Set $set, Get $get) {
                                $item = Item::find($get('item_id'));
                                if ($item) {
                                    if ($state > $item->stock) {
                                        $set('quantity', 1);
                                        
                                        Notification::make()
                                            ->title('Stok Habis')
                                            ->danger()
                                            ->send();
                                            
                                        $set('subtotal', $item->price);
                                        $remainingStock = $item->stock - 1;
                                        $set('stock', max($remainingStock, 0));
                                        return;
                                    }
                                    
                                    $subtotal = $item->price * $state;
                                    $set('subtotal', $subtotal);
                                    
                                    $remainingStock = $item->stock - $state;
                                    $set('stock', max($remainingStock, 0));
                                }
                            }),
                        Forms\Components\TextInput::make('subtotal')
                            ->disabled()
                            ->numeric()
                            ->dehydrated(false),
                        Forms\Components\TextInput::make('stock')
                            ->label('Available Stock')
                            ->disabled()
                            ->numeric()
                            ->dehydrated(false),
                    ])
                    ->columns(4),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Customer')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('total')
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Transaction Date')  
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\Filter::make('created_at')  
                    ->form([
                        Forms\Components\DatePicker::make('created_from'), 
                        Forms\Components\DatePicker::make('created_until'),  
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],  
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date), 
                            )
                            ->when(
                                $data['created_until'],  
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),  
                            );
                    })
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->defaultSort('created_at', 'desc');
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'),
            'view' => Pages\ViewTransaction::route('/{record}'),
        ];
    }    
}