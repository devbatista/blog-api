<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function getPosts(Request $request)
    {
        $user = $request->user();

        $posts = $user->posts->map(function($post){
            return [
                'id' => $post->id,
                'title' => $post->title,
                'created_at' => $post->created_at,
                'cover' => $post->cover,
                'author_name' => $post->author->name,
                'tags' => $post->tags->implode('name', ', '),
                'content' => $post->content,
                'slug' => $post->slug,
                'status' => $post->status
            ];
        });

        return response()->json(['posts' => $posts]);
    }

    public function getPost(string $slug, Request $request)
    {
        $user = $request->user();

        $post = $user->posts->firstWhere('slug', $slug);

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
            'status' => $post->status,
        ];

        return response()->json(['post' => $post]);
    }
}
