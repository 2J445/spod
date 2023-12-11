@extends('layouts.app')

@section('content')
    @if(is_null($user))
        <div class="mypage container">
            <div class="row justify-content-center">
              
                <div class="mypage-body">
                  <div class="mypage-header">
                    <div class="mypage-name">
                      @if($user->profile_image)
                        <p><img src="{{ asset('storage/' . $user['profile_image']) }}" width="100" height="40" class="user-show-profile-img"></p>
                      @else
                        <p class="user-profile-header-no-img">No Image</p>
                      @endif
                      <div class="user-page-show-name">
                        <h2>{{ $user->name }}</h2>
                      </div>
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
                                      <p class="user-profile-no-img">No Image</p>
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
                    </div>
                </div>
            </div>
        </div>
      
    @else
    @endif
@endsection
