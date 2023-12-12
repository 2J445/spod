@extends('layouts.app')

@section('content')
<div class="user-form">
    <form method="POST" action="/user/update/{{ $user->user_id }}" enctype="multipart/form-data">
        @method('put')
         @csrf
        <div class="row mb-3">
            <label for="profile_image" class="col-md-4 col-form-label text-md-end">{{ __('プロフィール画像') }}</label>

            <div class="col-md-6">
                <input id="profile_image" type="file" class="form-control" name="profile_image" value="{{ $user->profile_image }}" autocomplete="profile_image" autofocus>
                    @error('profile_image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        
        <div class="row mb-3">
            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('アカウント名/チャンネル名') }}</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" autocomplete="name" required autofocus>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        
        <div class="row mb-3">
            <label for="self_introduction" class="col-md-4 col-form-label text-md-end">{{ __('自己紹介') }}</label>

            <div class="col-md-6">
                <textarea id="self_introduction" type="text" class="form-control" name="self_introduction"  autocomplete="self_introduction" autofocus>{{ $user->self_introduction }}</textarea>
                    @error('self_introduction')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('メールアドレス') }}</label>
            <div class="col-md-6">
                <input id="email" type="email" class="form-control" name="email" value="{{$user->email }}"  required autocomplete="email">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('パスワード') }}</label>
            <div class="col-md-6">
                <input id="password" type="password" class="form-control" name="password" autocomplete="new-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('パスワード再確認') }}</label>

            <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
            </div>
        </div>

        <div class="row mb-0 update-btn">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="edit-btn btn btn-outline-success">
                    {{ __('更新') }}
                </button>
            </div>
        </div>
    </form>
    <div class="row mb-0">
        <div class="col-md-6 offset-md-4">
            <form onsubmit="return confirm('本当に退会しますか？')" action="{{ route('user.destroy', $user->id) }}" method="POST">
                @csrf
                @method('delete')
                <button type="submit" class="destroy-btn btn btn-outline-danger">退会</button>
            </form>
        </div>
    </div>
</div>
@endsection
