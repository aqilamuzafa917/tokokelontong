<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\ItemWidget;
use App\Filament\Widgets\TokoKelontongDashboard;
use App\Filament\Widgets\UserWidget;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected function getWidgets(): array
    {
        return [
            TokoKelontongDashboard::class,
            ItemWidget::class,
            UserWidget::class,
        ];
    }

    protected function getColumns(): int
    {
        return 12; // Set the total columns (default: 12 columns)
    }

    protected function getColumnSpan(string $widget): int|array
    {
        return match ($widget) {
            TokoKelontongDashboard::class => ['sm' => 6, 'lg' => 8],  // Larger on small and large screens
            ItemWidget::class => 4, // Another widget with 4 columns
            default => 3,
            UserWidget::class => 4,
        };
    }

    protected function getWidgetOrder(): array
    {
        return [
            TokoKelontongDashboard::class => 1, // Set this widget to be the first
            ItemWidget::class => 2,  
            UserWidget::class => 3,        // Set this widget to be second
        ];
    }
}
