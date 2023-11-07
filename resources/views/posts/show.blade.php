@extends('layouts.app')

@section('content')
    @auth
        @if($current_user->id == $post->user_id)
            <div class="post">
                
                <div class="post-head">
                    <div class="post-content">
                        <div class="post-user">
                            <a href="{{ route('user.show', $post->user_id) }}" class="post-user-name">
                            @if($post->user->profile_image)
                              <p><img src="{{ asset('storage/' . $post->user['profile_image']) }}" width="100" height="40" class="post-show-profile-img"></p>
                            @else
                              <p class="profile-no-img">No Image</p>
                            @endif
                            <h4>{{ $post->user->name }}</a></h4>
                        </div>
                        <div class="post-img">
                            <p><img src="{{ asset('storage/' . $post['image']) }}" width="300" class="post-show-img"></p>
                        </div>
                        <div class="post-audio">
                            <audio controlslist=”nodownload” controls src="{{ asset('storage/' . $post['audio']) }}"></audio>
                        </div>
                    </div>
                    <div class="post-article">
                        <div class="post-title">
                            <h3>{{ $post->name }}</h3>
                        </div>
                        <div class="post-detail">
                            <p style="white-space:pre-wrap;">{!! nl2br(e($post->detail)) !!}</p>
                            <div class="post-upload">
                                <p>アップロード日：{{ $post['created_at']->format('Y年m月d日') }}</p>
                            </div>
                        </div>
                        <div class="post-delete">
                            <form onsubmit="return confirm('本当に削除しますか？')" action="{{ route('post.destroy', $post->id) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="post-delete-btn btn btn-outline-danger">削除</button>
                            </form>
                        </div>
                        <div class="post-edit">
                            <a href="{{ route('post.edit', $post->id) }}" class="post-edit-btn btn btn-outline-primary">編集</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="user_posts">
                @foreach($user_posts as $user_post)
                   <div class='user-post-card'>
                     <a href="/posts/{{$user_post['id']}}" class="card-post-a">
                        <p class="user-post-card-img"><img src="{{ asset('storage/' . $user_post['image']) }}"></p>
                        <div class="user-post-card-body">
                          <div class="user-post-card-title">
                            <p>{{ $user_post['name'] }}</p>
                          </div>
                          <div class="user-post-card-name">
                            @if($post->user->profile_image)
                              <p><img src="{{ asset('storage/' . $post->user['profile_image']) }}" width="100" height="40" class="post-show-profile-img"></p>
                            @else
                              <p class="post-profile-no-img">No Image</p>
                            @endif
                            <div class="post-page-profile-name">
                                <p>{{ $user_post->user->name }}</p>
                            </div>
                          </div>
                        </div>
                      </a>
                    </div>
                @endforeach
            </div>
        @else
            <div class="post">
                <div class="post-head">
                    <div class="post-content">
                        <div class="post-user">
                            <a href="{{ route('user.show', $post->user_id) }}" class="post-user-name">
                            @if($post->user->profile_image)
                              <p><img src="{{ asset('storage/' . $post->user['profile_image']) }}" width="100" height="40" class="post-show-profile-img"></p>
                            @else
                              <p class="profile-no-img">No Image</p>
                            @endif
                            <h4>{{ $post->user->name }}</a></h4>
                        </div>
                        <div class="post-img">
                            <p><img src="{{ asset('storage/' . $post['image']) }}" width="300" class="post-show-img"></p>
                        </div>
                        <div class="post-audio">
                            <audio controlslist=”nodownload” controls src="{{ asset('storage/' . $post['audio']) }}"></audio>
                        </div>
                    </div>
                    <div class="post-article">
                        <div class="post-title">
                            <h3>{{ $post->name }}</h3>
                        </div>
                        <div class="post-detail">
                            <p style="white-space:pre-wrap;">{!! nl2br(e($post->detail)) !!}</p>
                            <div class="post-upload">
                                <p>アップロード日：{{ $post['created_at']->format('Y年m月d日') }}</p>
                            </div>
                        </div>
                        <div class="post-user-check">
                            @if($check)
                                <form onsubmit="return" action="{{ route('check.destroy', $check->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="post-check-delete-btn btn btn-outline-danger">チェック解除</button>
                                </form>
                            @else
                                <form action="{{ asset('checks') }}" method="POST" class="text-center mt-5">
                                    @csrf
                                    <input type="hidden" id="post_id" name="post_id" value="{{ $post->id }}" >
                                    <input type="hidden" id="check_id" name="check_id" value="{{ $post->user_id }}" >
                                    <input type="hidden" id="post_id" name="post_id" value="{{ $post->id }}" >
                                    <button type="submit" class="post-check-btn btn btn-outline-success">チェック登録</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="user_posts">
                @foreach($user_posts as $user_post)
                   <div class='user-post-card'>
                     <a href="/posts/{{$user_post['id']}}" class="card-post-a">
                        <p class="user-post-card-img"><img src="{{ asset('storage/' . $user_post['image']) }}"></p>
                        <div class="user-post-card-body">
                          <div class="user-post-card-title">
                            <p>{{ $user_post['name'] }}</p>
                          </div>
                          <div class="user-post-card-name">
                             @if($post->user->profile_image)
                              <p><img src="{{ asset('storage/' . $post->user['profile_image']) }}" width="100" height="40" class="post-show-profile-img"></p>
                            @else
                              <p class="post-profile-no-img">No Image</p>
                            @endif
                            <div class="post-page-profile-name">
                                <p>{{ $user_post->user->name }}</p>
                            </div>
                          </div>
                        </div>
                      </a>
                    </div>
                @endforeach
            </div>
        @endif
    @else
        <div class="post">
            <div class="post-head">
                <div class="post-content">
                    <div class="post-user">
                        <a href="{{ route('user.show', $post->user_id) }}" class="post-user-name">
                        @if($post->user->profile_image)
                          <p><img src="{{ asset('storage/' . $post->user['profile_image']) }}" width="100" height="40" class="post-show-profile-img"></p>
                        @else
                          <p class="profile-no-img">No Image</p>
                        @endif
                        <h4>{{ $post->user->name }}</a></h4>
                    </div>
                    <div class="post-img">
                        <p><img src="{{ asset('storage/' . $post['image']) }}" width="300" class="post-show-img"></p>
                    </div>
                    <div class="post-audio">
                        <audio controlslist=”nodownload” controls src="{{ asset('storage/' . $post['audio']) }}"></audio>
                    </div>
                </div>
                <div class="post-article">
                    <div class="post-title">
                            <h3>{{ $post->name }}</h3>
                        </div>
                    <div class="post-detail">
                        <p style="white-space:pre-wrap;">{!! nl2br(e($post->detail)) !!}</p>
                        <div class="post-upload">
                            <p>アップロード日：{{ $post['created_at']->format('Y年m月d日') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="user_posts">
            @foreach($user_posts as $user_post)
                <div class='user-post-card'>
                  <a href="/posts/{{$user_post['id']}}" class="card-post-a">
                    <p class="user-post-card-img"><img src="{{ asset('storage/' . $user_post['image']) }}"></p>
                    <div class="user-post-card-body">
                      <div class="user-post-card-title">
                        <p>{{ $user_post['name'] }}</p>
                      </div>
                      <div class="user-post-card-name">
                        @if($post->user->profile_image)
                          <p><img src="{{ asset('storage/' . $post->user['profile_image']) }}" width="100" height="40" class="post-show-profile-img"></p>
                        @else
                          <p class="post-profile-no-img">No Image</p>
                        @endif
                        <div class="post-page-profile-name">
                                <p>{{ $user_post->user->name }}</p>
                            </div>
                      </div>
                    </div>
                  </a>
                </div>
            @endforeach
        </div>
    @endauth
@endsection

