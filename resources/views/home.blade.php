@extends('layouts.app')

@section('content')
<!-- フラッシュメッセージ -->
@if (session('flash_message'))
    <div class="flash_message">
       {{ session('flash_message') }}
    </div>
@endif
  @auth
    <div class="auth-home">
      @foreach($posts as $post)
        <div class='home-card'>
          <a href="/posts/{{$post['id']}}" class="card-post-a">
            <p class="home-card-img"><img src="{{ asset('storage/' . $post['image']) }}"></p>
            <div class="home-card-body">
              <div class="home-card-title">
                <p>{{ $post['name'] }}</p>
              </div>
              <div class="home-card-name">
                <p>{{ $post->user->name }}</p>
              </div>
            </div>
          </a>
        </div>
      @endforeach
    </div>
    
  @else
    <div class="auth-home">
      @foreach($posts as $post)
        <div class='home-card'>
          <a href="/posts/{{$post['id']}}" class="card-post-a">
            <p class="home-card-img"><img src="{{ asset('storage/' . $post['image']) }}"></p>
            <div class="home-card-body">
              <div class="home-card-title">
                <p>{{ $post['name'] }}</p>
              </div>
              <div class="home-card-name">
                <p>{{ $post->user->name }}</p>
              </div>
            </div>
          </a>
        </div>
      @endforeach
    </div>
    
  @endauth
@endsection
