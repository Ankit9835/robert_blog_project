<?php

use Illuminate\Support\Facades\Route;
use App\Category;
use App\Tag;
use App\Post;
use App\Comment;
use App\User;


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

Route::get('/', function () {
    $categories = Category::select('id','title')->orderBy('title')->get();
    $tags = Tag::select('id', 'name')->get();

    // $tags = Tag::select('id', 'name')->orderByDesc(
    //     DB::table('post_tag')
    //         ->selectRaw('count(tag_id) as tag_count')
    //         ->whereColumn('tags.id', 'post_tag.tag_id')
    //         ->orderBy('tag_count','desc')
    //         ->limit(1)
    // )
    // ->get();
    // dd($tags);
    $posts = Post::latest()->take(5)->withCount('comments')->get();
    // dd($posts);
    $popular_posts = Post::select('id','title')->orderByDesc(
        Comment::selectRaw('count(post_id) as comment_count')
        ->whereColumn('posts.id','comments.post_id')
        ->orderBy('comment_count','desc')
        ->limit(1)
    )->withCount('comments')->take(6)->get();

    $active_user = User::select('id','name')->orderByDesc(

        Post::selectRaw('count(user_id) as user_count')
        ->whereColumn('users.id','posts.user_id')
        ->orderBy('user_count','desc')
        ->limit(1)

    )->withCount('posts')->take(6)->get();

    $popular_category = Category::select('id','title')
                        ->withCount('comments')
                        ->orderBy('comments_count','desc')
                        ->take(2)->get();

    //dd($popular_category);
    

    return view('welcome',compact('categories','tags','posts','popular_posts','active_user','popular_category'));
});

Route::get('single/post/{id}','PostController@view');
Route::get('category/post/{id}','PostController@category_post');
Route::get('tag/post/{id}','PostController@tag_post');
Route::post('search/post','PostController@search_post')->name('search.post');
