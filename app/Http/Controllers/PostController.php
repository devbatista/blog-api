<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function getPosts(Request $request)
    {
        $posts_per_page = 3;
        $posts = Post::published()->paginate($posts_per_page);

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

    public function getPost(string $slug)
    {
        $post = Post::published()->firstWhere('slug', $slug);

        if (!$post) {
            return response()->json(['error' => '404 Not Found'], 404);
        }

        $post = [
            'id' => $post->id,
            'title' => $post->title,
            'created_at' => $post->created_at,
            'cover' => $post->cover,
            'author_name' => $post->author->name,
            'tags' => $post->tags->implode('name', ', '),
            'content' => $post->content,
            'slug' => $post->slug,
        ];

        return response()->json(['post' => $post]);
    }

    public function getRelatedPosts(string $slug)
    {
        $post = Post::published()->firstWhere('slug', $slug);

        if (!$post) {
            return response()->json(['error' => '404 Not Found'], 404);
        }

        $tags = $post->tags->pluck('id')->toArray();

        $posts = Post::byTags($tags)
            ->published()
            ->where('id', '!=', $post->id)
            ->limit(5)
            ->get();

        $relatedPosts = $posts->map(function($post) {
            return [
                'id' => $post->id,
                'title' => $post->title,
                'created_at' => $post->created_at,
                'cover' => $post->cover,
                'author_name' => $post->author->name,
                'tags' => $post->tags->implode('name', ', '),
                'content' => $post->content,
                'slug' => $post->slug
            ];
        });

        return response()->json([
            'posts' => $relatedPosts,
            'count' => count($relatedPosts)
        ]);
    }
}
