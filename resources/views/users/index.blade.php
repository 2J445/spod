@extends('layouts.app')

@section('content')
    @auth
      @if($user->admin == true)
        <div class="admin-user-index">
          <div class="users-list-title">
            <h3>ユーザーリスト</h3>
            <p>※理由も無くユーザーを削除しないでください。</p></br>
            <p>※理由も無くユーザーの利用制限を掛けないでください</p></br>
          </div>
          <div class="users-list">
            @foreach($users as $user)
              <div class="users-list-card">
                  <div class="user-list-header-card">
                    <div class="user-list-card-profile-img">
                      
                      @if($user->profile_image)
                          <p><img src="{{ asset('storage/' . $user['profile_image']) }}" width="80" height="30" class="user-list-show-profile-img"></p>
                      @else
                          <p class="user-list-profile-no-img">No Image</p>
                      @endif
                    </div>
                    <div class="user-list-card-name">
                      <a href="{{ route('user.show', $user->id) }}" class="post-user-name">
                        <h3>({{ $user->id }}){{ $user->name }}</h3>
                      </a>
                    </div>
                  </div>
                  <div class="user-list-regulation-btn">
                    @if($user->is_use == false)
                      <form onsubmit="return confirm('利用規制させますか？')" action="{{ route('user.regulation', $user->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="user-list-warning-btn btn btn-outline-warning">利用規制</button>
                      </form>
                    @else
                      <form onsubmit="return confirm('利用規制を解除させますか？')" action="{{ route('user.cancell_regulation', $user->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="user-list-warning-btn btn btn-outline-warning">利用規制解除</button>
                      </form>
                    @endif
                  </div>
                  <div class="user-list-delete-btn">
                    <form onsubmit="return confirm('強制退会させますか？')" action="{{ route('user.destroy', $user->id) }}" method="POST">
                      @csrf
                      @method('delete')
                      <button type="submit" class="user-list-destroy-btn btn btn-outline-danger">強制退会</button>
                    </form>
                  </div>
                  <div class="user-list-card-body">
                    <div class="user-list-card-self-introducition">
                      <p>{!! nl2br(e($user->self_introduction)) !!}</p>
                    </div>
                  </div>
              </div>
            @endforeach
          </div>
          <div class="search-post-paginate">
            {{ $users->links('pagination::bootstrap-4') }}
          </div>
        </div>
      @else
        <div class="no-admin-user-index">
          @if($current_user == $user->id)
            <div class="user-list">
              <div class="user-list-title">
                <h3>チェッカーリスト</h3>
              </div>
              @if($checks)
                <div class="no-checks-list">
                  <h5>チェックしているチャンネルはありません</h5>
                </div>
              @endif
              @foreach($checks as $check)
                <div class="user-list-card">
                  <a href="{{ route('user.show', $check->check_id) }}" class="post-user-name">
                    <div class="user-list-header-card">
                      <div class="user-list-card-profile-img">
                        @if($check->check->profile_image)
                            <p><img src="{{ asset('storage/' . $check->check['profile_image']) }}" width="80" height="30" class="user-list-show-profile-img"></p>
                        @else
                            <p class="user-list-profile-no-img">No Image</p>
                        @endif
                      </div>
                      <div class="user-list-card-name">
                        <h3>{{ $check->check->name }}</h3>
                      </div>
                    </div>
                    <div class="user-list-card-body">
                      <div class="user-list-card-self-introducition">
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
        </div>
      @endif
    @endauth
@endsection
