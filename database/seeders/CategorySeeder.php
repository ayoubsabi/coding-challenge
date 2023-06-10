<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $data = $this->getDataFromJsonFile('seeds/electronic-catalog.json');

        // Insert categories
        Category::insert($this->fetchCategoriesFromData($data));
    }

    private function getDataFromJsonFile(string $path)
    {
        $json = file_get_contents(database_path($path));

        return json_decode($json, true);
    }

    private function fetchCategoriesFromData(array $data)
    {
        $categories = [];

        foreach ($data['products'] as $product) {
            if (! isset($categories[$product['category']])) {
                $categories[$product['category']] = [
                    'name' => $product['category'],
                    'created_at' => now()
                ];
            }
        }

        return $categories;
    }
}
