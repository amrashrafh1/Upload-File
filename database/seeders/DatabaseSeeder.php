<?php

namespace Database\Seeders;

use App\Models\Album;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        /* Album::create([
            'name' => 'Test Album1',
            'slug' => 'test-album1',
            'cover_image' => 'test-album-cover.jpg',
            'user_id' => 1,
        ]);
        Album::create([
            'name' => 'Test Album2',
            'slug' => 'test-album2',
            'cover_image' => 'test-album-cover.jpg',
            'user_id' => 1,
        ]); */
    }
}
