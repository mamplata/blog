<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define an array of headlines for the news posts
        $headlines = [
            'Breaking News: Local Economy Booms',
            'New Technology Revolutionizes Agriculture',
            'City to Host Annual Cultural Festival',
            'Healthcare Advancements Benefit Rural Areas',
            'Sports Update: Local Team Wins Championship',
        ];

        // Loop through the headlines and create news posts
        foreach ($headlines as $index => $headline) {
            News::create([
                'headline' => $headline,
                'content' => str_repeat('This is the content of the news post titled "' . $headline . '". ', 6),
                'author' => 'John Loui Amular',
                'date_published' => now()->subDays($index), // Use Carbon instance for date
                'user_id' => 1,
            ]);
        }
    }
}
