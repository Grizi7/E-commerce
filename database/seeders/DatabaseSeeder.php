<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        

        \App\Models\User::factory()->create([
            'name' => 'Zidan',
            'email' => 'zidan@zidan.com',
            'password' => bcrypt('zidan123'),
            'role' => true,
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Eman',
            'email' => 'eman@eman.com',
            'password' => bcrypt('eman123'),
            'role' => true,
        ]);
        \App\Models\User::factory(10)->create();
        $products = \App\Models\Product::factory(10)->create();
        foreach ($products as $product){
            \App\Models\Image::factory()->create([
                'product_id' => $product->id,
            ]);
        }
        
    }
}
