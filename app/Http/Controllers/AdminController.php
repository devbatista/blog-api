<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Post;
use App\Models\Tag;

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

    public function createPost(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'in:PUBLISHED,DRAFT',
            'tags' => 'string|max:255'
        ]);

        $post = $request->user()->posts()->make([
            'id' => (string) Str::uuid(),
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'slug' => Str::slug($request->input('title')),
            'status' => $request->input('status', 'DRAFT')
        ]);

        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            if (!$file->isValid()) {
                return response()->json(['error' => 'Invalid file'], 422);
            }

            if (!in_array($file->getClientOriginalExtension(), ['jpg', 'png', 'jpeg'])) {
                return response()->json(['error' => 'Invalid image type'], 422);
            }

            $postId = (string) Str::uuid();
            $filename = $postId.'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);

            $post->cover = env('APP_URL').'/uploads/'.$filename;
        }

        $post->id = $postId;
        $post->save();

        if ($request->has('tags')) {
            $tags = explode(',', $request->input('tags'));

            foreach($tags as $tag) {
                $tag = trim($tag);
                $tagModel = Tag::firstOrCreate(['name' => $tag]);
                $post->tags()->attach($tagModel->id);
            }
        }

        $returnData = [
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

        return response()->json(['post' => $returnData], 201);
    }

    public function deletePost(string $slug, Request $request)
    {
        $user = $request->user();
        $post = $user->posts()->firstWhere('slug', $slug);

        if (!$post) {
            return response()->json(['error' => '404 Not Found'], 404);
        }

        $post->delete();

        return response()->json(['error' => 'Post deleted successfully'], 200);
    }
}
