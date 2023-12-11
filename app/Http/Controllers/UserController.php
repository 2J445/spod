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
        $current_user = Auth::user();
        $checks = Check::where("user_id", "=", $current_user)
                        ->orderBy('created_at', 'desc')
                        ->paginate(10);
        $users = User::paginate(10);
        foreach($checks as $check)
        {
            $posts = Post::where("user_id", $check->check_id)
                        ->orderBy('created_at', 'desc')
                        ->paginate(10);
            return view('users.index', ['user' => $user, 'current_user'=> $current_user, 'checks'=> $checks, 'posts'=>$posts, 'users'=>$users]);
        }
        return view('users.index', ['user' => $user, 'current_user'=> $current_user, 'checks'=> $checks, 'users'=>$users]);
    }
    public function show($id)
    {
        $user = User::find($id);
        $current_user = Auth::user();
        $posts = Post::where('user_id', '=', $current_user)->orderBy('created_at', 'desc')->get();
        $other_posts = Post::where('user_id', '=', $id)->orderBy('created_at', 'desc')->get();
        $check = Check::where('user_id', '=', $current_user)
                    ->where('check_id', '=', $id)
                    ->first();
        return view('users.show', ['user' => $user, 'current_user'=> $current_user, 'posts' => $posts, 'other_posts' => $other_posts, 'check'=>$check,]);
    }
    public function edit(Request $request, $id)
    {
        $user = Auth::user();
        $current_user = Auth::user();
        return view('users.edit', compact('user'));
    }
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        var_dump($user);
        return view('users.show', ['user' => $user,  'current_user'=> $current_user, 'posts' => $posts]);
    }
    public function destroy($id)
    {
        $current_user = Auth::id();
        $user = User::find($id);
        $post = Post::where('user_id', '=', $current_user)->get();
        $user->delete();
        $post->each->delete();
        \Session::flash('flash_message', '退会しました。');
        return redirect('/');
    }
    public function regulation($id)
    {
        $user = User::find($id);
        $current_user = Auth::id();
        $user->is_use = true;
        $user->save();
        \Session::flash('flash_message', '利用制限を掛けました。');
        return redirect('/');
    }
    public function cancell_regulation($id)
    {
        $user = User::find($id);
        $current_user = Auth::id();
        $user->is_use = false;
        $user->save();
        \Session::flash('flash_message', '利用制限を解除しました。');
        return redirect('/');
    }
}
