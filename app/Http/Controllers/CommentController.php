<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    public function store()
    {
        $authUser = auth()->id();
        $post = request()->session()->pull('post_id', '');
        $id_post = (int)$post;

        $post = DB::table('posts')->where('id', $id_post)->first();

        $post_id = $post->id;






        //validation
        $body = request()->validate([
           'body'=>  'required'
        ]);



        DB::insert('insert into comments (post_id, user_id, body) values (?, ?, ?)',
            [$post_id, $authUser, request('body')]);

//        Comment::->create([
//            'user_id' => request() -> user() -> id,
//            'body' => request('body')
//        ]);



        return back();


    }

}
