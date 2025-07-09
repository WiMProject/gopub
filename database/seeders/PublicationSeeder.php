<?php

namespace Database\Seeders;

use App\Models\Publication;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PublicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        
        // Get publisher users
        $publishers = User::whereHas('role', function($query) {
            $query->where('name', 'publisher');
        })->get();
        
        // Publication types
        $types = ['jurnal', 'karya ilmiah', 'artikel', 'makalah', 'skripsi', 'tesis', 'disertasi'];
        
        // Create 100 publications
        for ($i = 1; $i <= 100; $i++) {
            $publisher = $publishers->random();
            $title = $faker->sentence(rand(5, 10));
            $abstract = $faker->paragraphs(rand(2, 4), true);
            $content = $faker->paragraphs(rand(10, 20), true);
            $type = $types[array_rand($types)];
            
            // Generate random authors (2-5 authors)
            $authorCount = rand(2, 5);
            $authors = [];
            for ($j = 0; $j < $authorCount; $j++) {
                $authors[] = $faker->name();
            }
            $authorString = implode(', ', $authors);
            
            // Generate random keywords (3-8 keywords)
            $keywordCount = rand(3, 8);
            $keywords = [];
            for ($j = 0; $j < $keywordCount; $j++) {
                $keywords[] = $faker->word();
            }
            $keywordString = implode(', ', $keywords);
            
            // Create publication
            Publication::create([
                'title' => $title,
                'abstract' => $abstract,
                'content' => $content,
                'publication_type' => $type,
                'authors' => $authorString,
                'keywords' => $keywordString,
                'user_id' => $publisher->id,
                'status' => 'published',
                'views' => rand(10, 1000),
                'downloads' => rand(5, 500),
            ]);
        }
    }
}