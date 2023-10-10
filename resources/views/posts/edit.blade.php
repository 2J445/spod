@extends('layouts.app')

@section('content')
@auth
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('ポッドキャストを編集') }}</div>

                <div class="card-body">
                    <div class="create-items">
                        <div class="form">
                          <form action="/post/update/{{ $post->post_id }}" method="POST" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            
                            <div class="input-form row mb-3">
                              <label for="name" class="col-md-4 col-form-label text-md-end">タイトル</label>
                              <input name="name" class="col-md-6" required value="{{ $post->name }}">
                            </div>
                            
                            <div class="input-form row mb-3">
                              <label for="detail" class="col-md-4 col-form-label text-md-end">詳細</label>
                              <textarea name="detail" rows="4" cols="40"  class="col-md-6"autocomplete="detail" autofocus>{{ $post->detail }}</textarea>
                            </div>
                            
                            <div class="input-form col-md-6 offset-md-4">
                              <input type="submit" value="保存"  class="upload-btn col-md-6 btn btn-outline-success">
                            </div>
                            
                          </form>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endauth
@endsection