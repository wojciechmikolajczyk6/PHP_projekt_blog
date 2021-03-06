<?php

use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FileUpload;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\UserController;
use App\Models\Post;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Query\BuilderClass;
use App\Http\Controllers\UserPostController;

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
Route::get('search', [PostController::class, 'search']);



Route::get('posts/{post}', [PostController::class, 'show']);

Route::get('categories/{category:name}', function (Category $category) {

     $kategoria = last(request()->segments());
     $id = (DB::table('categories')
     ->select('id')
         ->where('name', '=', $kategoria)
     ->get());
    $id = json_decode($id, true);
    $id = $id[0]['id'];


    return view('posts', [
    'posts' => Post::where('category_id', '=', $id)->paginate(3)
    ]);

});
Route::get('authors/{author:username}', function (User $author) {
    $autor = last(request()->segments());
    $id = (DB::table('users')
        ->select('id')
        ->where('username', '=', $autor)
        ->get());
    $id = json_decode($id, true);
    $id = $id[0]['id'];


    return view('posts', [
//        'posts' => Post::latest()->filter(request(['search', 'category', 'author']))->paginate(1),
////        'posts' => $author->posts
        'posts' => Post::where('user_id', '=', $id)->paginate(3)
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

Route::get('admin', function () {
    return view('admin.index', [
//        'users' => User::all(),
        'posts' => Post::all()
    ]);
    })->middleware('admin');

//AJAX
//Route::get('admin', [SearchController::class, 'index']);
Route::get('/admin/action', [SearchController::class, 'action'])->name('index.action')->middleware('admin');;
//Route::delete('admin/{deleteUser}', [SearchController::class, 'delete'])->middleware('admin');



Route::get('/admin/posts', function () {
    return view('admin.showPosts', [
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



//captcha

Route::get('my-captcha', 'HomeContoller@myCaptcha') ->name('myCaptcha');
Route::post('my-captcha', 'HomeContoller@myCaptchaPost') ->name('myCaptcha.post');
Route::get('refresh-captcha', 'HomeContoller@refreshCaptcha') ->name('refresh_captcha');



// ContactUsForm

Route::get('/contact', [\App\Http\Controllers\ContactUsController::class, 'createForm']);
Route::post('/contact', [\App\Http\Controllers\ContactUsController::class, 'ContactForm'])->name('contact.store');;



//AddPostbyUser
Route::get('/addPost', [\App\Http\Controllers\UserPostController::class, 'create'])->middleware('auth');
Route::post('/addPost', [\App\Http\Controllers\UserPostController::class, 'store'])->middleware('auth');


//UserPage

Route::get('userpage/{user}', function() {
    return view('userpage',[
        'user' => auth()->user()
    ]);
})->middleware('auth');


//FileUpload(User avatar)

Route::get('/userpage', [FileUpload::class, 'createForm']);
Route::post('/userpage', [FileUpload::class, 'fileUpload'])->name('fileUpload');


// User controlling

Route::get('admin/editUser/{editUser}', function (User $editUser) {

    return view('admin.editUser', [
        'editUser' => $editUser
    ]);
})->middleware('admin');


Route::patch('admin/editUser/{editUser}/edit', [UserController::class, 'update'])->middleware('admin');

Route::GET('admin/editUser/{editUser}/delete', [UserController::class, 'delete'])->middleware('admin');
