<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\User;
use App\Models\Check;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
      $user = Auth::user();
      // データベース内のすべてのpostを取得し、post変数に代入
      $posts = Post::all();
      // 'posts'フォルダ内の'index'viewファイルを返す。
      // その際にview内で使用する変数を代入します。
      return view('posts/index', ['posts' => $posts, 'user'=> $user]);
    }
    
    public function show($id)
    {
      $user = Auth::user();
      $post = Post::find($id); // idでPostを探し出す
      // 現在認証しているユーザーを取得
      $current_user = auth()->user();
      $user_posts = Post::where('user_id', '=', $post->user_id)->get();
      if($user){
        //チェック登録されているかの確認
        $checks = Check::all();
        $check = Check::where('user_id', '=', $current_user->id)
                      ->where('check_id', '=', $post->user_id)
                      ->first();
        return view('posts.show', ['post' => $post, 'current_user'=> $current_user, 'user'=> $user, 'check'=>$check, 'checks'=>$checks, 'user_posts'=>$user_posts]);
      }
      return view('posts.show', ['post' => $post, 'current_user'=> $current_user, 'user'=> $user, 'user_posts'=>$user_posts]);
    }
    
    public function create () 
    {
      $user = Auth::user();
        return view('posts/create', ['user'=> $user]);
    }
    
    public function new()
    {
        return view('post/new');

    }
    public function edit(Request $request, $id)
    {
        $user = Auth::user();
        $post = post::find($id);
        return view('posts.edit', ['user' => $user], compact('post'));
    }
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $post->name = $request->name;
        $post->detail = $request->detail;
        // データベースに保存
        $post->save();
        $user = Auth::user();
        $current_user = auth()->user();
        $posts = Post::where('user_id', '=', $current_user)->get();
        return view('posts.show', ['user' => $user, 'current_user'=> $current_user, 'posts' => $posts, 'post' => $post]);
    }
    
    public function destroy($id)
    {
      $post = Post::find($id);
      $post->delete();
      \Session::flash('flash_message', '削除しました。');
      return redirect('/');
    }
    
    public function store(Request $request)
    {
      //ユーザーIDを取得
      $user_id = Auth::id();
      $post = new Post;
      // フォームから送られてきたデータをそれぞれ代入
      $post->user_id = $user_id;
      $post->name = $request->name;
      
      //音声投稿の記述
      $post->audio = $request->audio->store('audios');
      //画像投稿の記述
      $post->image = $request->image->store('images');
      
      $post->detail = $request->detail;
      // データベースに保存
      $post->save();
      return redirect('/')->with('flash_message', '投稿が完了しました');
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'image' => ['file', 'mimes:gif,png,jpg,webp', 'max:3072'],
            'audio' => ['file', 'mp3,mp4,wave'],
        ]);
    }
}