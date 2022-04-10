<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminPostController extends Controller
{
    public function update(Post $editPost)
    {
        $attributes = request()->validate([
            'title' => 'required',
            'post_fragment' => 'required',
            'body' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')]

        ]);

        $editPost->update($attributes);

        return back();

    }

    public function delete (Post $editPost)
    {
        $editPost->delete();

        return back();
    }
}
