<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Post;
use App\Models\Check;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CheckController extends Controller
{
    public function destroy($id)
    {
      $check = Check::find($id);
      $check->delete();
      return redirect('/');
    }
    public function store(Request $request)
    {
      //ユーザーIDを取得
      $user_id = Auth::id();
      $post_id = $request->post_id;
      $check = new Check;
      $check->check_id = $request->check_id;
      $check->user_id = $user_id;
      $check->save();
      $user = Auth::user();
      $current_user = auth()->user();
      $posts = Post::where('user_id', '=', $current_user)->get();
      $post = Post::find($post_id);
      return view('posts.show', ['user' => $user, 'current_user'=> $current_user, 'post' => $post, 'check'=> $check])->with('flash_message', 'チェック登録しました');
    }
    protected function validator(array $data)
    {
        
    }
}

