<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $data = $this->getDataFromJsonFile('seeds/electronic-catalog.json');

        // Get categories
        $categories = Category::all()->pluck('id', 'name')->toArray();
        
        // Insert products
        Product::insert(
            array_map(
                function ($product) use ($categories) {
                    return [
                        'name' => $product['name'],
                        'sku' => $product['sku'],
                        'price' => $product['price'],
                        'quantity' => $product['quantity'],
                        'category_id' => $categories[$product['category']],
                        'created_at' => now()
                    ];
                },
                $data['products']
            )
        );
    }

    private function getDataFromJsonFile(string $path)
    {
        $json = file_get_contents(database_path($path));

        return json_decode($json, true);
    }
}
