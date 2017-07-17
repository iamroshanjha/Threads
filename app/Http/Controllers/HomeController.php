<?php

namespace Threads\Http\Controllers;

use Illuminate\Http\Request;
use Threads\Post as Post;
use Threads\User as User;
use Threads\Categories as Categories;
use Threads\Http\Requests\CreateProfileRequest;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except' => ['index']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categories::all();
        if(request()->has('category')){
            $posts = Post::where('category_id',request('category'))->orderBy('created_at','desc')->paginate(3);
        }

        elseif(request()->has('search')){
            $posts = Post::where(function($query){
                $search=request('search');
                return $query->where('body','like','%'.$search.'%')->orWhere('title','like','%'.$search.'%');
            })->orderBy('created_at','desc')->paginate(3);
        }
        elseif(request()->has('')){
            $posts = Post::orderBy('created_at','desc')->paginate(3);
        }
        else {
            $posts = Post::orderBy('created_at','desc')->paginate(3);
        }
        return view('home',compact('posts','categories'));
    }

    public function viewMyPosts(){
        try {
            $posts = Post::where('user_id', '=', Auth::user()->id)->paginate(3);
            return view('user_profile',compact('posts'));   
        } 

        catch (ModelNotFoundException $e) {
        return redirect('/home');    
        }


    }
}
