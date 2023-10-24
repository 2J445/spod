@extends('layouts.app')

@section('content')
    @auth
      @if($current_user == $user->id)
        <div class="mypage container">
            <div class="row justify-content-center">
              
                <div class="mypage-body">
                  <div class="mypage-header">
                    <div class="mypage-name">
                      @if($user->profile_image)
                        <p><img src="{{ asset('storage/' . $user['profile_image']) }}" width="100" height="40" class="user-show-profile-img"></p>
                      @else
                        <p class="profile-no-img">No Image</p>
                      @endif
                      <h2>{{ $user->name }}</h2>
                    </div>
                    <div class="mypage-user-edit">
                      <a href="{{ route('user.edit', $user->id) }}" class="mypage-user-edit-btn btn btn-outline-success">設定</a>
                    </div>
                  </div>
                    <div class="mypage-introducition">
                        <div class="mypage-introduction-title">
                            <h5>詳細</h5>
                        </div>
                        <div class="mypage-introduction-content">
                            <p>{!! nl2br(e($user->self_introduction)) !!}</p>
                        </div>
                    </div>
                    </div>
                    
                    <div class="mypage-myposts">
                        <div class="mypage-mypost-title">
                            <h3>ポッドキャスト</h3>
                        </div>
                        @if($posts->isEmpty())
                          <p class="post-null">投稿はありません</p>
                        @endif
                        <div class="user-page-post">
                          @foreach($posts as $post)
                            <div class='user-post-card'>
                              <a href="/posts/{{$post['id']}}" class="user-post-a">
                                <p class="user-card-img"><img src="{{ asset('storage/' . $post['image']) }}"></p>
                                <div class="user-card-body">
                                  <div class="user-card-title">
                                    <p>{{ $post['name'] }}</p>
                                  </div>
                                  <div class="user-card-name">
                                    @if($user->profile_image)
                                      <p><img src="{{ asset('storage/' . $user['profile_image']) }}" width="100" height="40" class="user-show-profile-img"></p>
                                    @else
                                      <p class="profile-no-img">No Image</p>
                                    @endif
                                    <p>{{ $post->user->name }}</p>
                                  </div>
                                </div>
                              </a>
                            </div>
                          @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
      @else
        <div class="mypage container">
            <div class="row justify-content-center">
                <div class="mypage-body">
                  <div class="mypage-header">
                    <div class="mypage-name">
                      @if($user->profile_image)
                        <p><img src="{{ asset('storage/' . $user['profile_image']) }}" width="100" height="40" class="user-show-profile-img"></p>
                      @else
                        <p class="profile-no-img">No Image</p>
                      @endif
                      <h2>{{ $user->name }}</h2>
                    </div>
                    <div class="user-check">
                            @if($check)
                                <form onsubmit="return" action="{{ route('check.destroy', $check->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="user-check-delete-btn btn btn-outline-danger">チェック解除</button>
                                </form>
                            @else
                                <form action="{{ asset('checks') }}" method="POST" class="text-center mt-5">
                                    @csrf
                                    <input type="hidden" id="check_id" name="check_id" value="{{ $user->id }}" >
                                    <button type="submit" class="user-check-btn btn btn-outline-success">チェック登録</button>
                                </form>
                            @endif
                        </div>
                  </div>
                    <div class="mypage-introducition">
                        <div class="mypage-introduction-title">
                            <h5>詳細</h5>
                        </div>
                        <div class="mypage-introduction-content">
                            <p>{!! nl2br(e($user->self_introduction)) !!}</p>
                        </div>
                    </div>
                    </div>
                    
                    <div class="mypage-myposts">
                        <div class="mypage-mypost-title">
                            <h3>ポッドキャスト</h3>
                        </div>
                        @if($other_posts->isEmpty())
                          <p class="post-null">投稿はありません</p>
                        @endif
                        <div class="user-page-post">
                          @foreach($other_posts as $post)
                            <div class='user-post-card'>
                              <a href="/posts/{{$post['id']}}" class="user-post-a">
                                <p class="user-card-img"><img src="{{ asset('storage/' . $post['image']) }}"></p>
                                <div class="user-card-body">
                                  <div class="user-card-title">
                                    <p>{{ $post['name'] }}</p>
                                  </div>
                                  <div class="user-card-name">
                                    @if($user->profile_image)
                                      <p><img src="{{ asset('storage/' . $user['profile_image']) }}" width="100" height="40" class="user-show-profile-img"></p>
                                    @else
                                      <p class="profile-no-img">No Image</p>
                                    @endif
                                    <p>{{ $post->user->name }}</p>
                                  </div>
                                </div>
                              </a>
                            </div>
                          @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
      @endif
    @else
      <div class="mypage container">
          <div class="row justify-content-center">
              <div class="mypage-body">
                <div class="mypage-header">
                  <div class="mypage-name">
                    @if($user->profile_image)
                      <p><img src="{{ asset('storage/' . $user['profile_image']) }}" width="100" height="40" class="user-show-profile-img"></p>
                    @else
                      <p class="profile-no-img">No Image</p>
                    @endif
                    <h2>{{ $user->name }}</h2>
                  </div>
                  <div class="mypage-user-edit">
                    <a href="{{ route('user.edit', $user->id) }}" class="mypage-user-edit-btn btn btn-outline-success">設定</a>
                  </div>
                </div>
                  <div class="mypage-introducition">
                      <div class="mypage-introduction-title">
                          <h5>詳細</h5>
                      </div>
                      <div class="mypage-introduction-content">
                          <p>{!! nl2br(e($user->self_introduction)) !!}</p>
                      </div>
                  </div>
                  </div>
                  
                  <div class="mypage-myposts">
                      <div class="mypage-mypost-title">
                          <h3>ポッドキャスト</h3>
                      </div>
                      @if($other_posts->isEmpty())
                        <p class="post-null">投稿はありません</p>
                      @endif
                      <div class="user-page-post">
                        @foreach($other_posts as $post)
                          <div class='user-post-card'>
                            <a href="/posts/{{$post['id']}}" class="user-post-a">
                              <p class="user-card-img"><img src="{{ asset('storage/' . $post['image']) }}"></p>
                              <div class="user-card-body">
                                <div class="user-card-title">
                                  <p>{{ $post['name'] }}</p>
                                </div>
                                <div class="user-card-name">
                                  @if($user->profile_image)
                                    <p><img src="{{ asset('storage/' . $user['profile_image']) }}" width="100" height="40" class="user-show-profile-img"></p>
                                  @else
                                    <p class="profile-no-img">No Image</p>
                                  @endif
                                  <p>{{ $post->user->name }}</p>
                                </div>
                              </div>
                            </a>
                          </div>
                        @endforeach
                      </div>
                  </div>
              </div>
          </div>
      </div>
    @endauth
@endsection
