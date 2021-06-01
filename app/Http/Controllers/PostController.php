<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;
use App\Comment;
use App\User;
use DB;

class PostController extends Controller
{
    //
    public function view($id){
    	$post = Post::with('comments')->find($id);
    	//dd($post);
    	return view('single-post',compact('post'));
    }

    public function category_post($id){

    	$category_post = Category::with(['posts' => function($q){
        	$q->select('posts.id','posts.title','posts.content','posts.created_at','posts.user_id','posts.category_id');
    	}])->find($id);
    	//dd($category_post);

    	return view('category-wise-post',compact('category_post'));
    }

    public function tag_post($id){

    	$tag_post = Tag::with(['posts' => function($q){
    		$q->select('posts.id','posts.title','posts.content','posts.created_at','posts.user_id','posts.category_id');
    	}])->find($id);

    	return view('tag-wise-post',compact('tag_post'));

    }

    public function search_post(Request $request){

    	$title = $request->search;
    	$content = $request->search;

    	$sortBy = 'updated_at desc, title asc';

    	$sortByMostCommented = true;

    	$search = DB::table('posts')
    					->join('comments', 'posts.id','comments.post_id')
    					->join('users', 'posts.user_id','users.id')
    					->select('posts.*','users.name','comments.content')
    					->where('posts.title', 'like', "%$title%")
    					->orWhere('posts.content', 'like', "%$content%");

    					$search->when($sortBy, function($q, $sortBy){
                    // return $q->orderBy($sortBy);
                   			 return $q->orderByRaw($sortBy);
               			 }, function($q){
                    		return $q->orderBy('title');
                	});


    					$search->when($sortByMostCommented, function($q){
                    return $q->orderByDesc(
                        DB::table('comments')
                        ->selectRaw('count(comments.post_id)')
                        ->whereColumn('comments.post_id','posts.id')
                        ->orderByRaw('count(comments.post_id) DESC')
                        ->limit(1)
                    );
                });

    				$search = $search->get();

    					//dd($search);

    	//dd($search);
    	return view('search-post',compact('search'));

    }
}
