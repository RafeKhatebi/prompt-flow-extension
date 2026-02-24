<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PromptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure that there is a user :
        $userId = DB::table('users')->value('id') ?? DB::table('users')->insertGetId([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('prompts')->insert([
            [
                'user_id' => $userId,
                'title' => 'What is the capital of France?',
                'content' => 'A simple question about geography.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $userId,
                'title' => 'Explain the theory of relativity.',
                'content' => 'A complex question about physics.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $userId,
                'title' => 'How to bake a cake?',
                'content' => 'A practical question about cooking.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
