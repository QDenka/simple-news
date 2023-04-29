<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\News\Category;
use App\Models\News\News;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         \App\Models\User\User::factory()->create([
             'name' => 'Test User',
             'email' => 'test@kaban.dev',
         ]);

        Category::factory()->count(10)->create();

        $news = News::factory()->count(10)->create();

        foreach ($news as $item) {
            $item->categories()->attach(Category::inRandomOrder()->first()->id);
        }
    }
}
