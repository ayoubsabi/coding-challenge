<?php

namespace Tests\Unit;

use Faker\Factory;
use Tests\TestCase;
use App\Models\Category;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;

class ProductCreationTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_product_creation()
    {
        $response = $this->post('/api/login', [
            'email' => 'ayoub@mail.com',
            'password' => 'Hello108*'
        ])->assertStatus(Response::HTTP_OK);

        $userData = $response->json();

        $categories = Category::select('id')->get();

        $faker = Factory::create();

        $this->withHeaders([
            'Authorization' => 'Bearer ' . $userData['data']['token'],
        ])->post('/api/products', [
            'name' => $faker->word,
            'sku' => $faker->word,
            'category_id' => $categories[rand(0, count($categories) - 1)]->id,
            'price' => $faker->randomFloat(2, 0, 10000),
            'quantity' => rand(3, 10),
        ])->assertStatus(Response::HTTP_CREATED);
    }
}
