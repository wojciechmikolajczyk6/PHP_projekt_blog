<?php

use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Models\Post;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Query\BuilderClass;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PostController::class, 'index']);



Route::get('posts/{post}', [PostController::class, 'show']);

Route::get('categories/{category:name}', function (Category $category) {
    $url=$_SERVER["PHP_SELF"];
    $kategoria=explode("/", $url);
    $kategoria = end($kategoria);
    $posts = Category::where('name', 'like', $kategoria)->paginate(3);
    return view('postscategory', [
        'posts' => $category->posts


    ]);

});
Route::get('authors/{author:username}', function (User $author) {
    return view('postscategory', [
        'posts' => $author->posts
    ]);
});
// Only the guests can visit those pages:
Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');

Route::get('login', [SessionsController::class, 'start'])->middleware('guest');
Route::post('login', [SessionsController::class, 'store'])->middleware('guest');

Route::post('logout', [SessionsController::class, 'destroy'])->middleware('auth');

Route::post('comments', [CommentController::class, 'store']);



// admin

Route::get('admin/create', [PostController::class, 'create'])->middleware('admin');
Route::get('admin/posts', [AdminPostController::class, 'create'])->middleware('admin');


Route::post('admin/addPost', [PostController::class, 'store'])->middleware('admin');

Route::get('admin/', function () {
    return view('admin.index', [
        'users' => User::all(),
        'posts' => Post::all()
    ]);
    })->middleware('admin');
Route::get('admin/{editPost}', function (Post $editPost) {

//    $post = Post::find($id);
    return view('admin.editPost', [
        'editPost' => $editPost
    ]);
})->middleware('admin');

Route::patch('admin/{editPost}/edit', [AdminPostController::class, 'update'])->middleware('admin');

Route::delete('admin/{editPost}', [AdminPostController::class, 'delete'])->middleware('admin');

