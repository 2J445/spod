@extends('layouts.app')

@section('content')
<div class="contact-confirm">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <form method="POST" action="{{ route('contact.send') }}">
                        @csrf
                        
                        <div class="input-contact-confirm mb-3">
                             <label>メールアドレス</label></br>
                             <div class="contact-email-confirm">
                                 {{ $inputs['email'] }}
                                <input
                                    name="email"
                                    value="{{ $inputs['email'] }}"
                                    type="hidden">
                             </div>
                        </div>
                       <div class="input-contact-confirm mb-3">
                           <label>タイトル</label></br>
                           <div class="contact-title-confirm">
                               {{ $inputs['title'] }}
                                <input
                                    name="title"
                                    value="{{ $inputs['title'] }}"
                                    type="hidden">
                           </div>
                        </div>
                        
                    
                        <div class="input-contact-confirm mb-3">
                             <label>お問い合わせ内容</label></br>
                             <div class="contact-body-confirm">
                                 {!! nl2br(e($inputs['body'])) !!}
                                <input
                                    name="body"
                                    value="{{ $inputs['body'] }}"
                                    type="hidden">
                             </div>
                        </div>
                        
                        <div class="input-contact-confirm-btn mb-3">
                            <button class="btn btn-outline-success" type="submit" name="action" value="submit">
                                送信
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection