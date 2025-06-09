<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function getPosts(Request $request)
    {
        $posts_per_page = 3;
        $posts = Post::paginate($posts_per_page);

        $pages_posts = [];

        foreach($posts as $post) {
            $pages_posts[] = [
                'id' => $post->id,
                'title' => $post->title,
                'created_at' => $post->created_at,
                'cover' => $post->cover,
                'author_name' => $post->author->name,
                'tags' => $post->tags->implode('name', ', '),
                'content' => $post->content,
                'slug' => $post->slug
            ];
        }

        return [
            'posts' => $pages_posts,
            'page' => $posts->currentPage()
        ];
    }
}
