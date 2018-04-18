<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Profile;
use App\user;
use App\Post;
use Auth;

class HomeController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index()
    {
        $user_id=Auth::user()->id;
        $profile=DB::table('users')
        ->join('profiles','users.id','=','profiles.user_id')
        ->select('users.*','profiles.*')
        ->where(['profiles.user_id'=>$user_id])
        ->first();
      
        $posts=Post::paginate(3);
         
        return view('home',['profile'=>$profile,'posts'=>$posts]);
    }
}
