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
                @if($post->user->profile_image)
                  <p><img src="{{ asset('storage/' . $post->user['profile_image']) }}" width="80" height="30" class="home-show-profile-img"></p>
                @else
                  <p class="home-profile-no-img">No Image</p>
                @endif
                <div class="home-page-profile-name">
                  <p>{{ $post->user->name }}</p>
                </div>
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
                @if($post->user->profile_image)
                  <p><img src="{{ asset('storage/' . $post->user['profile_image']) }}" width="80" height="30" class="home-show-profile-img"></p>
                @else
                  <p class="home-profile-no-img">No Image</p>
                @endif
                <div class="user-page-profile-name">
                  <p>{{ $post->user->name }}</p>
                </div>
              </div>
            </div>
          </a>
        </div>
      @endforeach
    </div>
    
  @endauth
@endsection
