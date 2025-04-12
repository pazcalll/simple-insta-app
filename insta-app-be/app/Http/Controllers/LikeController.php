<?php

namespace App\Http\Controllers;

use App\Http\Requests\RemoveLikeRequest;
use App\Http\Requests\StoreLikeRequest;
use App\Http\Requests\UpdateLikeRequest;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Post $post)
    {
        //
        try {
            $like = $post->likes()->create([
                'user_id' => Auth::id(),
            ]);
        } catch (\Throwable $th) {
            return apiResponse(
                message: $th->getMessage(),
                statusCode: 422,
            );
        }

        return apiResponse(
            data: $like,
            message: 'Post liked successfully',
            statusCode: 201,
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RemoveLikeRequest $request, Post $post, Like $like)
    {
        //
        try {
            $request->validated();

            $like->delete();
            return apiResponse(
                message: 'Post unliked successfully',
                statusCode: 200,
            );
        } catch (\Throwable $th) {
            return apiResponse(
                message: $th->getMessage(),
                statusCode: 422,
            );
        }
    }
}
