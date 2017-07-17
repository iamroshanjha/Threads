<?php

namespace Threads\Http\Controllers;

use Illuminate\Http\Request;
use Threads\Categories as Categories;
use Threads\Post as Post;
use Threads\Reply as Reply;
use Threads\Like as Like;
use Threads\User as User;
use Threads\ReplyThread as ReplyThread;

use Threads\Http\Requests\CreatePostRequest;
use Threads\Http\Requests\CreateReplyRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Threads\Notifications\QuestionAssigned;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Threads\Notifications\CreateNotificationReplied;


class ForumController extends Controller
{
    public function getPost(){
    	$categories = Categories::all();
        $users = User::all();
    	return view('question',compact('categories','users'));
    }

    public function __construct()
    {
        $this->middleware('auth',['except' => ['viewPost']]);
    }

    public function putPost(CreatePostRequest $request){
    	
        $post = new Post();
        $post->user_id = Auth::user()->id;
        $post->category_id = $request['category'];
        $post->title = $request['title'];
        $post->body = $request['body'];
        $post->save();
        
        $myCheckboxes = $request->user;
        if(is_array($myCheckboxes))
            {
                foreach($myCheckboxes as $check){
                $users = User::whereid($check)->first(); 
                //foreach ($users as $user) {
                $users->notify(new QuestionAssigned($post));  
                // }
                }                  
            }
        
    
        notify()->flash('<h3>Post Saved Successfully</h3>', 'success', ['timer' => 1500]);

        return redirect('/home');
    }

    public function viewPost($slug){

        try {
            $post = Post::where('slug', '=', $slug)->first();
            return view('reply',compact('post'));   
        } 

        catch (ModelNotFoundException $e) {
        return redirect('/home');    
        }
    }

    public function saveReply(CreateReplyRequest $request){
        $post = Post::where('slug', '=', $request['slug'])->first();

        if($post){
            $reply = new Reply;

            $reply->post_id = $post->id;
            $reply->user_id = Auth::user()->id;
            $reply->body=$request['body'];
            $reply->save();

            $users = User::whereid($post->user->id)->first(); 
            $users->notify(new CreateNotificationReplied($reply));  

            //notify()->flash('<h3>Reply Saved Succesfully</h3>', 'success', ['timer' => 1500]);
            


            return redirect()->back();
        }
        else{

           return redirect('/home');
        }
    }

    public function deletePost(Request $request){
        try {
            $post = Post::findOrFail($request['post_id']);
            if(Auth::user()->id == $post->user_id)
            {
                $post->delete();

                notify()->flash('<h3>Post Removed Successfully</h3>', 'success', ['timer' => 1500]);

                return redirect()->back();
            }
            else{
                return  redirect('/home'); 
            }
               
        } 

        catch (ModelNotFoundException $e) {
        return redirect('/home');    
        }
    }

    public function deleteReply(Request $request){
        try {
            $reply = Reply::findOrFail($request['reply_id']);
            if(Auth::user()->id == $reply->user_id)
            {
                $reply->delete();

                notify()->flash('<h3>Comment Removed Successfully</h3>', 'success', ['timer' => 1500]);

                return redirect()->back();
            }
            else{
                return  redirect('/home'); 
            }
               
        } 

        catch (ModelNotFoundException $e) {
        return redirect('/home');    
        }
    }


    public function getEditPost($id){

        try {
            $post = Post::findOrFail($id);
            if(Auth::user()->id == $post->user_id)
            {
              $categories = Categories::all();
              return view('edit_post', compact('post','categories'));
            }
            else{
                return  redirect('/home'); 
            }
               
        } 

        catch (ModelNotFoundException $e) {
        return redirect('/home');    
        }
    }

    public function saveEditPost(CreatePostRequest $request){
        try {
            $post = Post::findOrFail($request['post_id']);
            if(Auth::user()->id == $post->user_id)
            {
                $post->category_id = $request['category'];
                $post->title = $request['title'];
                $post->body = $request['body'];
                $a=$post->save();
                notify()->flash('<h3>Post Saved Successfully</h3>', 'success', ['timer' => 1500]);

                
                return redirect('/home');

            }
            else{
                return  redirect('/home'); 
            }
               
        } 

        catch (ModelNotFoundException $e) {
        return redirect('/home');    
        }
    }

    public function cancel(){
        return redirect('/home');
    }

    public function replyLike($id){
        $like = new Like();
        if (Like::whereuser_id(Auth::user()->id)->wherereply_id($id)->where('likes','=',1)->exists()){
            Like::whereuser_id(Auth::user()->id)->wherereply_id($id)->where(['likes' => 1])->delete();
        }
        else{
            $like->reply_id = $id;
            $like->user_id = Auth::user()->id;
            $like->likes = 1;
            $like->save();
        }
            
        
        return redirect()->back();  
    }


    public function viewReplyThread($slug1,$slug){

        try {
            $reply = Reply::where('slug', '=', $slug)->first();
            return view('replythread',compact('reply','slug1'));   
        } 

        catch (ModelNotFoundException $e) {
        return redirect('/home');    
        }
    }


    public function saveReplyThread(CreateReplyRequest $request){
        $reply = Reply::where('slug', '=', $request['slug'])->first();

        if($reply){
            $replythread = new ReplyThread;

            $replythread->reply_id = $reply->id;
            $replythread->user_id = Auth::user()->id;
            $replythread->body=$request['body'];
            $replythread->save();

            //notify()->flash('<h3>Reply Saved Succesfully</h3>', 'success', ['timer' => 1500]);
            


            return redirect()->back();
        }
        else{

            return redirect()->back();
        }
    }

    public function deleteReplyThread(Request $request){
        try {
            $replythread = ReplyThread::findOrFail($request['replythread_id']);
            if(Auth::user()->id == $replythread->user_id)
            {
                $replythread->delete();

                notify()->flash('<h3>Reply Removed Successfully</h3>', 'success', ['timer' => 1500]);

                return redirect()->back();
            }
            else{
                return redirect()->back();              }
               
        } 

        catch (ModelNotFoundException $e) {
                return redirect()->back();        }
    }

    
}
