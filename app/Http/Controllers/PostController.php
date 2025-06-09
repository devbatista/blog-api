<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function getPosts(Request $request)
    {
        $posts = Post::all();

        $return_data = [];

        foreach($posts as $post) {
            $return_data[] = [
                'id' => $post->id,
                'title' => $post->title,
                'created_at' => $post->created_at,
                'author_name' => $post->author->name,
                'tags' => $post->tags->implode('name', ', '),
                'content' => $post->content,
                'slug' => $post->slug
            ];
        }

        return $return_data;
    }
}
