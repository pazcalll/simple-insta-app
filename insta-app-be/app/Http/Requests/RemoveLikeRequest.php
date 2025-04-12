<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class RemoveLikeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $isAuthenticated = Auth::check();
        $post = $this->route('post');
        $like = $this->route('like');

        if (!$isAuthenticated) return false;

        if (!$post || !$like) return false;

        if ($like->user_id !== Auth::id()) return false;

        if ($like->post_id !== $post->id) return false;

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
        ];
    }
}
