<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        // Seed the prompts table with sample data
        $this->call(PromptSeeder::class);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test123@example.com',
        ]);
    }
}
