<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use App\Category;
use App\Post;
use DB;
use App\Like;
use App\Dislike;
use App\Comment;
use App\Profile;
Use Auth;

class PostController extends Controller
{
    
    public function post()
    {  
        $categories=Category::all();
        return view('posts.post',['categories'=>$categories]);
    }

    public function index()
    {
        //
    }

   public function addpost(Request $request)
   {
     $this->validate($request,[
            'post_title'=>'required',
            'post_body'=>'required',
            'category_id'=>'required',
            'post_image'=>'required'
            ]);

    $posts = new Post;
         
         $posts->post_title=$request->input('post_title');
         $posts->user_id=Auth::user()->id;
         $posts->post_body=$request->input('post_body');
         $posts->category_id=$request->input('category_id');
         $posts->post_image=$request->input('post_image');
        if(Input::hasFile('post_image'))
            {
    $file=Input::file('post_image');
    $file->move(public_path().'/posts/',$file->getClientOriginalName());
    $url=URL::to("/").'/posts/'.$file->getClientOriginalName();
                
            }


         $posts->post_image=$url;
         $posts->save();
         return redirect('/home')->with('response','Post added successfully');



    
   }

     public function view($post_id)
     {
        
        $posts=Post::where('id','=',$post_id)->get();
        $categories=Category::all();

        $likepost=Post::find($post_id);
        $likecount=Like::where(['post_id'=>$likepost->id])->count();
        $dislikecount=Dislike::where(['post_id'=>$likepost->id])->count();

        $comment =DB::table('users')
                   ->join('comments','users.id','=','comments.user_id')
                   ->join('posts','comments.post_id','=','posts.id')
                   ->select('users.name','comments.*')
                   ->where(['post_id'=>$post_id])
                   ->get();

                  

       

         return view("posts.view",['posts'=>$posts,'categories'=>$categories,'likecount'=>$likecount,'dislikecount'=>$dislikecount,'comment'=>$comment]);
     }



    public function edit($post_id)
     {
        $categories=Category::all();
        $posts=Post::find($post_id);
        $category=Category::find($posts->category_id);
         return view("posts.edit",['categories'=>$categories,'posts'=>$posts,'category'=>$category]);

     }

    public function editpost(Request $request, $post_id)
    {
        $this->validate($request,[
            'post_title'=>'required',
            'post_body'=>'required',
            'category_id'=>'required',
            'post_image'=>'required'
            ]);

    $posts = new Post;
         
         $posts->post_title=$request->input('post_title');
         $posts->user_id=Auth::user()->id;
         $posts->post_body=$request->input('post_body');
         $posts->category_id=$request->input('category_id');
         $posts->post_image=$request->input('post_image');
        if(Input::hasFile('post_image'))
            {
    $file=Input::file('post_image');
    $file->move(public_path().'/posts/',$file->getClientOriginalName());
    $url=URL::to("/").'/posts/'.$file->getClientOriginalName();
                
            }


         $posts->post_image=$url;
         $data=array('post_title'=>$posts->post_title,
            'post_body'=>$posts->post_body,
            'category_id'=>$posts->category_id,
            'post_image'=>$posts->post_image


     );
         Post::where('id','=',$post_id)->update($data);
        
         return redirect('/home')->with('response','Post update successfully');


    }
    public function delete($post_id)
    {
        Post::where('id','=',$post_id)->delete();
        return redirect('/home')->with('response','Post delete successfully');
    }

    public function category($cat_id)
    {
  $categories=Category::all();
  $posts = DB::table('posts')
    ->join('categories', 'posts.category_id', '=', 'categories.id')
    ->select('posts.*', 'categories.*')
    ->where(['categories.id'=>$cat_id])
    ->get();
    return view('categories.categoryposts',['categories'=>$categories,'posts'=>$posts]);
    }

    public function like($id)
    {
        $loggin_user=Auth::user()->id;
        $like_user=Like::where(['user_id'=>$loggin_user,'post_id'=>$id])->first();

        if(empty($like_user->user_id))
        {
            $user_id=Auth::user()->id;
            $email=Auth::user()->email;
            $post_id=$id;
            $like=new Like;
            $like->user_id=$user_id;
            $like->post_id=$post_id;
            $like->email=$email;
            $like->save();
            return redirect("/view/{$id}");


        }
        else
            return redirect("/view/{$id}");
    }


     public function dislike($id)
    {
        $loggin_user=Auth::user()->id;
        $dislike_user=Dislike::where(['user_id'=>$loggin_user,'post_id'=>$id])->first();

        if(empty($like_user->user_id))
        {
            $user_id=Auth::user()->id;
            $email=Auth::user()->email;
            $post_id=$id;
            $like=new Dislike;
            $like->user_id=$user_id;
            $like->post_id=$post_id;
            $like->email=$email;
            $like->save();
            return redirect("/view/{$id}");


        }
        else
            return redirect("/view/{$id}");
    }

    public function comment(Request $request,$id)
    {
           $this->validate($request,[
            'comment'=>'required'
                      ]);
       $user_id=Auth::user()->id;
         $comment =new Comment;
         $comment->user_id=$user_id;
         $comment->post_id=$id;
         $comment->comment=$request->input('comment');
         $comment->save();
         return redirect("/view/{$id}")->with('response','comments added successfully');




    }



    public function search(Request $request)
    {
        $user=Auth::user()->id;
        $profile=Profile::find( $user);
        $keyword=$request->input('search');
        $posts=Post::where('post_title','LIKE','%'.$keyword.'%')->get();

        return view('posts.search',['profile'=>$profile,'posts'=>$posts]);
    }

   
    public function store(Request $request)
    {
        //
    }

    
    public function show($id)
    {
        //
    }

   
    

    public function update(Request $request, $id)
    {
        //
    }

  
    public function destroy($id)
    {
        //
    }
}
