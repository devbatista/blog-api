<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::create([
            'title' => 'Post 1',
            'content' => 'Post 1 content',
            'slug' => 'post_1',
            'cover' => null,
            'status' => 'PUBLISHED',
            'author_id' => User::first()->id
        ]);
    }
}
