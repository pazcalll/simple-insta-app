<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $posts = Post::query()
            ->with(['user', 'liked'])
            ->withCount(['likes', 'comments'])
            ->latest()
            ->paginate(10);

        return apiPaginationResponse($posts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        //
        $validated = $request->validated();

        try {
            $post = Post::create([
                'user_id' => Auth::id(),
                'caption' => $validated['caption'],
                'image_path' => $validated['image']->store('posts', 'public'),
            ]);
        } catch (\Throwable $th) {
            return apiResponse(
                message: $th->getMessage(),
                statusCode: 422,
            );
        }

        return apiResponse(
            data: $post,
            message: 'Post created successfully',
            statusCode: 201,
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
