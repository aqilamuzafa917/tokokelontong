<?php

namespace App\Filament\Widgets;

use App\Models\Item; // Ensure this is the correct model for your items
use App\Models\Transaction;
use App\Models\User;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsWidget extends BaseWidget
{
    protected static ?int $sort = 2;
    
    protected function getStats(): array
    {
         // Calculate the total transaction amount
         $totalAmount = Transaction::sum('total'); // Get the sum of the 'total' column

         // Format the total amount as Rupiah
         $formattedTotal = number_format($totalAmount, 0, ',', '.');
 
        return [
            Stat::make('Jumlah Item', Item::count()) // Count of items
                ->description('Total jumlah item yang tersedia di toko ini') // Update description accordingly
                ->descriptionIcon('heroicon-m-archive-box', IconPosition::Before) // Use a relevant icon
                ->chart([1, 3, 5, 6, 7]) // You can keep or modify the chart data as needed
                ->color('info'), // Choose a color that fits your theme

            Stat::make('Jumlah Customer', User::count())
                ->description('Total pelanggan yang telah registrasi di toko ini')
                ->descriptionIcon('heroicon-m-user-group', IconPosition::Before)
                ->chart([1,3,5,6,7])
                ->color('warning'),
            
            Stat::make('Total Transaksi', 'Rp ' . $formattedTotal) // Display total in Rupiah
                ->description('Total uang dari semua transaksi di toko ini')
                ->descriptionIcon('heroicon-m-currency-dollar', IconPosition::Before) // You can change the icon as needed
                ->color('success') // Use a color that fits your design
                ->chart([1, 3, 5, 6, 7]) // Retain this if needed, or modify accordingly
        ];
    }
}   


