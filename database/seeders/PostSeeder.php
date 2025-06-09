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
            'slug' => 'post-1',
            'cover' => null,
            'status' => 'PUBLISHED',
            'author_id' => User::inRandomOrder()->first()->id
        ]);
        Post::create([
            'title' => 'Post 2',
            'content' => 'Post 2 content',
            'slug' => 'post-2',
            'cover' => null,
            'status' => 'PUBLISHED',
            'author_id' => User::inRandomOrder()->first()->id
        ]);
        Post::create([
            'title' => 'Post 3',
            'content' => 'Post 3 content',
            'slug' => 'post-3',
            'cover' => null,
            'status' => 'PUBLISHED',
            'author_id' => User::inRandomOrder()->first()->id
        ]);
        Post::create([
            'title' => 'Post 4',
            'content' => 'Post 4 content',
            'slug' => 'post-4',
            'cover' => null,
            'status' => 'PUBLISHED',
            'author_id' => User::inRandomOrder()->first()->id
        ]);
        Post::create([
            'title' => 'Post 5',
            'content' => 'Post 5 content',
            'slug' => 'post-5',
            'cover' => null,
            'status' => 'PUBLISHED',
            'author_id' => User::inRandomOrder()->first()->id
        ]);
        Post::create([
            'title' => 'Post 6',
            'content' => 'Post 6 content',
            'slug' => 'post-6',
            'cover' => null,
            'status' => 'PUBLISHED',
            'author_id' => User::inRandomOrder()->first()->id
        ]);
        Post::create([
            'title' => 'Post 7',
            'content' => 'Post 7 content',
            'slug' => 'post-7',
            'cover' => null,
            'status' => 'PUBLISHED',
            'author_id' => User::inRandomOrder()->first()->id
        ]);
        Post::create([
            'title' => 'Post 8',
            'content' => 'Post 8 content',
            'slug' => 'post-8',
            'cover' => null,
            'status' => 'PUBLISHED',
            'author_id' => User::inRandomOrder()->first()->id
        ]);
        Post::create([
            'title' => 'Post 9',
            'content' => 'Post 9 content',
            'slug' => 'post-9',
            'cover' => null,
            'status' => 'PUBLISHED',
            'author_id' => User::inRandomOrder()->first()->id
        ]);
        Post::create([
            'title' => 'Post 10',
            'content' => 'Post 10 content',
            'slug' => 'post-10',
            'cover' => null,
            'status' => 'PUBLISHED',
            'author_id' => User::inRandomOrder()->first()->id
        ]);
    }
}
