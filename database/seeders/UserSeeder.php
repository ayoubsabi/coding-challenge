<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $data = $this->getDataFromJsonFile('seeds/electronic-catalog.json');

        // Insert users
        User::insert(
            array_map(
                function ($user) {
                    return [
                        'name' => $user['name'],
                        'email' => $user['email'],
                        'password' => bcrypt("Hello108*"),
                        'created_at' => now()
                    ];
                },
                $data['users']
            )
        );
    }

    private function getDataFromJsonFile(string $path)
    {
        $json = file_get_contents(database_path($path));

        return json_decode($json, true);
    }
}
