<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $allTagIds = Tag::pluck('id')->toArray();
        shuffle($allTagIds);

        $post1 = Post::create([
            'title' => 'Post 1',
            'content' => 'Post 1 content',
            'slug' => 'post-1',
            'cover' => null,
            'status' => 'PUBLISHED',
            'author_id' => User::inRandomOrder()->first()->id
        ]);
        $randomCount = rand(1, count($allTagIds));
        $post1->tags()->attach(array_slice($allTagIds, 0, $randomCount));

        $post2 = Post::create([
            'title' => 'Post 2',
            'content' => 'Post 2 content',
            'slug' => 'post-2',
            'cover' => null,
            'status' => 'PUBLISHED',
            'author_id' => User::inRandomOrder()->first()->id
        ]);
        $randomCount = rand(1, count($allTagIds));
        $post2->tags()->attach(array_slice($allTagIds, 0, $randomCount));

        $post3 = Post::create([
            'title' => 'Post 3',
            'content' => 'Post 3 content',
            'slug' => 'post-3',
            'cover' => null,
            'status' => 'PUBLISHED',
            'author_id' => User::inRandomOrder()->first()->id
        ]);
        $randomCount = rand(1, count($allTagIds));
        $post3->tags()->attach(array_slice($allTagIds, 0, $randomCount));

        $post4 = Post::create([
            'title' => 'Post 4',
            'content' => 'Post 4 content',
            'slug' => 'post-4',
            'cover' => null,
            'status' => 'PUBLISHED',
            'author_id' => User::inRandomOrder()->first()->id
        ]);
        $randomCount = rand(1, count($allTagIds));
        $post4->tags()->attach(array_slice($allTagIds, 0, $randomCount));

        $post5 = Post::create([
            'title' => 'Post 5',
            'content' => 'Post 5 content',
            'slug' => 'post-5',
            'cover' => null,
            'status' => 'PUBLISHED',
            'author_id' => User::inRandomOrder()->first()->id
        ]);
        $randomCount = rand(1, count($allTagIds));
        $post5->tags()->attach(array_slice($allTagIds, 0, $randomCount));

        $post6 = Post::create([
            'title' => 'Post 6',
            'content' => 'Post 6 content',
            'slug' => 'post-6',
            'cover' => null,
            'status' => 'PUBLISHED',
            'author_id' => User::inRandomOrder()->first()->id
        ]);
        $randomCount = rand(1, count($allTagIds));
        $post6->tags()->attach(array_slice($allTagIds, 0, $randomCount));

        $post7 = Post::create([
            'title' => 'Post 7',
            'content' => 'Post 7 content',
            'slug' => 'post-7',
            'cover' => null,
            'status' => 'PUBLISHED',
            'author_id' => User::inRandomOrder()->first()->id
        ]);
        $randomCount = rand(1, count($allTagIds));
        $post7->tags()->attach(array_slice($allTagIds, 0, $randomCount));

        $post8 = Post::create([
            'title' => 'Post 8',
            'content' => 'Post 8 content',
            'slug' => 'post-8',
            'cover' => null,
            'status' => 'PUBLISHED',
            'author_id' => User::inRandomOrder()->first()->id
        ]);
        $randomCount = rand(1, count($allTagIds));
        $post8->tags()->attach(array_slice($allTagIds, 0, $randomCount));

        $post9 = Post::create([
            'title' => 'Post 9',
            'content' => 'Post 9 content',
            'slug' => 'post-9',
            'cover' => null,
            'status' => 'PUBLISHED',
            'author_id' => User::inRandomOrder()->first()->id
        ]);
        $randomCount = rand(1, count($allTagIds));
        $post9->tags()->attach(array_slice($allTagIds, 0, $randomCount));

        $post10 = Post::create([
            'title' => 'Post 10',
            'content' => 'Post 10 content',
            'slug' => 'post-10',
            'cover' => null,
            'status' => 'PUBLISHED',
            'author_id' => User::inRandomOrder()->first()->id
        ]);
        $randomCount = rand(1, count($allTagIds));
        $post10->tags()->attach(array_slice($allTagIds, 0, $randomCount));
    }
}
