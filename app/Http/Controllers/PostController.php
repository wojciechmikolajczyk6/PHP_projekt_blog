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
    /**
    * @return View|JsonResponse
    */


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



    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = Post::query();

        if(!is_null($search)) {
            $query = Post::where('title', 'like', "%" . "$search" . "%")->first()->get();



            return response()->json([

                'data' => $query,

                'categories' => Category::all()
            ]);
        } else{


       $posts = Post::latest();

            return view('posts', [
                //'posts' => Post::paginate(7),
                'posts' => $posts->paginate(8),
                'categories' => Category::orderBy('name', 'ASC')->get(),

            ]);
        }
        }


    public function show(Post $post)
    {

            return view('post', [
                'post' => $post
            ]);
    }
    public function search(Request $request){


        $search = $request->input('search');
        $posts = DB::table('posts')->where('title', 'like', "%"."$search"."%")->get();

        return response()->json($posts);

    }










}
