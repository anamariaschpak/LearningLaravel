<?php

use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PostCommentsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Models\Post;
use App\Services\Newsletter;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

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

Route::get('ping', function () {
    $mailchimp = new \MailchimpMarketing\ApiClient();

    $mailchimp->setConfig([
        'apiKey' => config('services.mailchimp.key'),
        'server' => 'us20',
    ]);

    $response = $mailchimp->ping->get();
    ddd($response);
});

Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('posts/{post:slug}', [PostController::class, 'show']);
Route::post('posts/{post:slug}/comments', [PostCommentsController::class, 'store']);

Route::post('newsletter', NewsletterController::class);

Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');

Route::get('login', [SessionsController::class, 'create'])->middleware('guest');
Route::post('sessions', [SessionsController::class, 'store'])->middleware('guest');
Route::post('logout', [SessionsController::class, 'destroy'])->middleware('auth');

// Route::get('authors/{author:username}', function (User $author) {
//     return view('posts.index', [
//         'posts' => $author->posts
//     ]);
// });

//      EXPLICATII 'Explicit Binding' by Puiu
// Route::get('autori/{autor:username}', function (User $autor) {

//     return view('posts.index', [
//         'posts' => $autor->posts
//     ]);
// });

// Route::get('autori/{user_autor}', function ($user_autor) {
//     $autor = User::where('username', $user_autor)->first();

//     return view('posts.index', [
//         'posts' => $autor->posts
//     ]);
// });

// Route::get('postari/{idul_postarii}', function ($idul_postarii) {
//     var_dump($idul_postarii);
//     var_dump((int) $idul_postarii);
//     $postare = Post::find($idul_postarii);
//     return response()->json($postare);
// });

// Route::get('postari/{idul_postarii}', function (User $idul_postarii) {
//     return view('posts.index', [
//         'posts' => $idul_postarii->posts
//     ]);
// });
