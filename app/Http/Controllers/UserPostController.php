<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Database\Query\BuilderClass;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;


class PostController extends Controller
{



    public function create()
    {

        return view('addPost');
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


//        if (request('search')) {
//            $posts->where('title', 'like', '%' . request('search') . '%')->get();
//
//        }

        return view('posts', [
//                'posts' => DB::table('posts')->orderBy('id')->cursorPaginate(3),
            'posts' => Post::latest()->filter(request(['search', 'category', 'author']))->paginate(3),
            'categories' => Category::all(),

        ]);
    }


    public function show(Post $post)
    {

        return view('post', [
            'post' => $post
        ]);
    }







}
