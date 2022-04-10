<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Database\Query\BuilderClass;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class PostController extends Controller
{



    public function create()
    {

        return view('admin.create');
    }
    public function store()
    {

        $new_post = request()->validate([
            'title' => 'required',
            'post_fragment' => 'required',
            'body' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')]

        ]);
        $new_post['user_id'] = auth()->id();

        Post::create($new_post);

        return back();

    }
    public function index()
    {

       $posts = Post::latest();


        if (request('search')) {
            $posts->where('title', 'like', '%' . request('search') . '%')->get();
            
        }
            return view('posts', [
           'posts' => $posts->paginate(3)
            ]);
        }


    public function show(Post $post)
    {

            return view('post', [
                'post' => $post
            ]);
    }

    public function findSearch() {

    }






}
