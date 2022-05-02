<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use App\Models\User;
use App\Models\Consultation;
use App\Models\Product;
use App\Models\Newsfeed;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();
        Consultation::factory(10)->create();
        Product::factory(5)->create();
        NewsFeed::factory(10)->create();
        $this->call([
            UserSeeder::class,
            
        ]);
    }
}
