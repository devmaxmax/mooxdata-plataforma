<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BurraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Tacos', 'slug' => 'tacos', 'description' => 'Deliciosos tacos mexicanos'],
            ['name' => 'Burritos', 'slug' => 'burritos', 'description' => 'Burritos grandes y sabrosos'],
            ['name' => 'Quesadillas', 'slug' => 'quesadillas', 'description' => 'Quesadillas con mucho queso'],
            ['name' => 'Bebidas', 'slug' => 'bebidas', 'description' => 'Refrescos y aguas frescas'],
            ['name' => 'Extras', 'slug' => 'extras', 'description' => 'Salsas y acompañamientos'],
        ];

        foreach ($categories as $category) {
            \App\Models\Burra\BurraCategory::firstOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
