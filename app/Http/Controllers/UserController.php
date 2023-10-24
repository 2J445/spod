<?php

namespace App\Http\Controllers;
use App\Providers\RouteServiceProvider;
use App\Models\Post;
use App\Models\User;
use App\Models\Check;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $current_user = Auth::id();
        
        //チェッカーの配信取得
        $myChecks = Check::where('user_id', '=', $current_user)->get();
        $checkerPosts = Post::where('user_id', '=', $myChecks->check_id)->get();
        
        return view('user.index', ['user' => $user, 'current_user'=> $current_user, 'checkerPosts'=> $checkerPosts]);
    }
    public function show($id)
    {
        $user = User::find($id);
        $current_user = Auth::id();
        $posts = Post::where('user_id', '=', $current_user)->get();
        $other_posts = Post::where('user_id', '=', $id)->get();
        $check = Check::where('user_id', '=', $current_user)
                    ->where('check_id', '=', $id)
                    ->first();
        return view('users.show', ['user' => $user, 'current_user'=> $current_user, 'posts' => $posts, 'other_posts' => $other_posts, 'check'=>$check,]);
    }
    public function edit(Request $request, $id)
    {
        $user = Auth::user();
        return view('users.edit', compact('user'));
    }
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $current_user = Auth::id();
        $posts = Post::where('user_id', '=', $current_user)->get();
        if($request->profile_image){
            $user->profile_image = $request->profile_image->store('profile_images');
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->self_introduction = $request->self_introduction;
        if($request->password){
            $user->password = $request->password;
            $user->save();
            return view('users.show', ['user' => $user, 'current_user'=> $current_user, 'posts' => $posts])->with('ユーザー情報を更新しました');
        }
        $user->save();
        return view('users.show', ['user' => $user, 'current_user'=> $current_user, 'posts' => $posts])->with('ユーザー情報を更新しました');
    }
    public function destroy($id)
    {
        $current_user = Auth::id();
        $user = Auth::user();
        $post = Post::where('user_id', '=', $current_user)->get();
        $user->delete();
        $post->each->delete();
        \Session::flash('flash_message', '退会しました。');
        return redirect('/');
    }
}
