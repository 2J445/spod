@extends('layouts.app')

@section('content')
@auth
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('ポッドキャストをアップロード') }}</div>

                <div class="card-body">
                    <div class="create-items">
                        <div class="form">
                          <form action="/posts" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="input-form row mb-3">
                              <label for="audio" class="col-md-4 col-form-label text-md-end">音声(ポッドキャスト音源)</label>
                              <input type="file" name="audio"  class="col-md-6" required>
                              @error('audio')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                              @enderror
                            </div>
                            
                            <div class="input-form row mb-3">
                              <label for="name" class="col-md-4 col-form-label text-md-end">タイトル</label>
                              <input name="name" class="col-md-6" required>
                              @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                              @enderror
                            </div>
                            
                            <div class="input-form row mb-3">
                              <label for="image" class="col-md-4 col-form-label text-md-end">イメージ(推奨：300px×200px)</label>
                              <input type="file" name="image"  class="col-md-6" required>
                              @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                              @enderror
                            </div>
                            
                            <div class="input-form row mb-3">
                              <label for="detail" class="col-md-4 col-form-label text-md-end">詳細</label>
                              <textarea name="detail" rows="4" cols="40"  class="col-md-6"></textarea>
                              @error('detail')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                              @enderror
                            </div>
                            
                            <div class="input-form col-md-6 offset-md-4">
                              <input type="submit" value="アップロード"  class="upload-btn col-md-6 btn btn-outline-success">
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