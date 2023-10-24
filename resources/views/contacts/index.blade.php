@extends('layouts.app')
 
@section('content')
<div class="containe contact-formr">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-contact-form">
                    <div class="card-header">{{ __('お問い合わせ') }}</div>
                    <form method="POST" action="{{ route('contact.confirm') }}">
                        @csrf
                        
                        <div class="contact-input-form mb-3">
                            <label>メールアドレス</label>
                            <input
                                name="email"
                                value="{{ old('email') }}"
                                type="text">
                            @if ($errors->has('email'))
                                <p class="error-message">{{ $errors->first('email') }}</p>
                            @endif
                        </div>
                        
                        <div class="contact-input-form mb-3">
                            <label>タイトル</label>
                            <input
                                name="title"
                                value="{{ old('title') }}"
                                type="text">
                            @if ($errors->has('title'))
                                <p class="error-message">{{ $errors->first('title') }}</p>
                            @endif
                        </div>
                        
                    
                        <div class="contact-input-form mb-3">
                            <label>お問い合わせ内容</label>
                            <textarea name="body">{{ old('body') }}</textarea>
                            @if ($errors->has('body'))
                                <p class="error-message">{{ $errors->first('body') }}</p>
                            @endif
                        </div>
                        
                        <div class="contact-input-form col-md-6 offset-md-4">
                            <button type="submit" class="contact-form-btn btn btn-outline-success">
                                入力内容確認
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection