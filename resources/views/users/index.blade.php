@extends('layouts.app')

@section('content')
    @auth
      @if($current_user == $user->id)
        <div class="checker-list">
          <div class="checker-list-title">
            <h3>チェッカーリスト</h3>
          </div>
          @if($checks)
            <div class="no-checks-list">
              <h5>チェックしているチャンネルはありません</h5>
            </div>
          @endif
          @foreach($checks as $check)
            <div class="checker-card">
              <a href="{{ route('user.show', $check->check_id) }}" class="post-user-name">
                <div class="checker-header-card">
                  <div class="checker-card-profile-img">
                    @if($check->check->profile_image)
                        <p><img src="{{ asset('storage/' . $check->check['profile_image']) }}" width="80" height="30" class="checker-show-profile-img"></p>
                    @else
                        <p class="checker-profile-no-img">No Image</p>
                    @endif
                  </div>
                  <div class="checker-card-name">
                    <h3>{{ $check->check->name }}</h3>
                  </div>
                </div>
                <div class="checker-card-body">
                  <div class="checker-card-self-introducition">
                    <p>{!! nl2br(e($check->check->self_introduction)) !!}</p>
                  </div>
                </div>
              </a>
            </div>
          @endforeach
        </div>
      @endif
      <div class="search-post-paginate">
        {{ $checks->links('pagination::bootstrap-4') }}
      </div>
    @endauth
@endsection
