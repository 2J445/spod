@extends('layouts.app')

@section('content')
<div class="search-list">
    <div class="search-card-list">
      @forelse ($posts as $post)
        <div class="search-card">
          <a href="/posts/{{$post['id']}}" class="card-post-a">
            <div class="search-post-content">
              <div class="search-post-img">
                <p class="home-card-img"><img src="{{ asset('storage/' . $post['image']) }}"></p>
              </div>
              <div class="search-post-body">
                <div class="search-post-title">
                  <h3>{{ $post->name }}</h3>
                </div>
                <div class="search-post-created">
                  <p>アップロード日：{{ $post['created_at']->format('Y年m月d日') }}</p>
                </div>
                <div class="search-post-user">
                  <h5>配信局：{{ $post->user->name }}</h5>
                </div>
                <div class="search-post-detail">
                  <p>{{ $post->detail }}</p>
                </div>
              </div>
            </div>
          </a>
        </div>
      @empty
        <div class="no-search-post">
          <h4>お探しの配信は見つかりませんでした</h4>
        </div>
      @endforelse
      <div class="search-post-paginate">
        {{ $posts->links('pagination::bootstrap-4') }}
      </div>
    </div>
</div>
@endsection
