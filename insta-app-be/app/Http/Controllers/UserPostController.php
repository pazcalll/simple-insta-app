<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(User $user)
    {
        //
        $posts = $user->posts()
            ->with(['user', 'liked'])
            ->withCount(['likes', 'comments'])
            ->latest()
            ->paginate(10);
        return apiPaginationResponse($posts);
    }
}
