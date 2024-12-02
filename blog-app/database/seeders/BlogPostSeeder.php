<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlogPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define an array of titles for the posts
        $titles = [
            'First Blog Post Title',
            'Second Blog Post Title',
            'Third Blog Post Title',
            'Fourth Blog Post Title',
            'Fifth Blog Post Title'
        ];

        // Loop through the titles and create blog posts
        foreach ($titles as $title) {
            BlogPost::create([
                'title' => $title,
                'content' => str_repeat('This is the content of the blog post titled "' . $title . '". ', 6),
                'user_id' => 1,
            ]);
        }
    }
}
