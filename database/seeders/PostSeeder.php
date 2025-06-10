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

        for ($i = 1; $i <= 10; $i++) {
            $status = rand(1,100) <= 70 ? 'PUBLISHED' : 'DRAFT';
            $post = Post::create([
                'title' => "Post $i",
                'content' => "Post $i content",
                'slug' => "post-$i",
                'cover' => null,
                'status' => $status,
                'author_id' => User::inRandomOrder()->first()->id
            ]);
            $tagIdsShuffled = $allTagIds;
            shuffle($tagIdsShuffled);

            $randomCount = rand(1, count($allTagIds));

            $post->tags()->attach(array_slice($tagIdsShuffled, 0, $randomCount));
        }
    }
}
