<?php

use Illuminate\Database\Seeder;
use App\Models\ItemCategory; // Import the ItemCategory model

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Define categories
        $categories = [
            ['name' => 'Makanan'],
            ['name' => 'Minuman'],
            ['name' => 'Alat Tulis'],
            ['name' => 'Alat Dapur'],
            ['name' => 'Pembersih']
        ];

        // Create each category using the ItemCategory model
        foreach ($categories as $category) {
            ItemCategory::create($category);
        }
    }
}
