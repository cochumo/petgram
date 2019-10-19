@extends('layouts.auth')

@section('movie')
    <div class="c-movieWrap">
        <video autoplay loop muted name="media" class="c-movie js-movie">
            <source src="{{ asset('movie/dog.mp4') }}" type="video/mp4">
            <source src="{{ asset('movie/dog.webm') }}" type="video/webm">
        </video>
    </div>
@endsection

@section('content')
    <div class="c-form__authWrap">
        <div class="c-form__authWrapInner">
            <div class="u-textC">
                <h1 class="c-form__auth--title">Petgram</h1>
            </div>
            <form method="POST" action="{{ route('login') }}" class="c-form__authForm">
                @csrf
                <div class="c-form__authInput">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="ユーザーID (メールアドレス)">

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="c-form__authInput">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="パスワード">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="c-form__authInput">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        ログインしたままにする
                    </label>
                </div>
                <div class="u-textC">
                    <button type="submit" class="c-button--03">
                        ログイン
                    </button>
                </div>
            </form>
            <div class="u-textC">
                <p class="">アカウントをお持ちでない場合はこちらから</p>
                <a href="{{ route('register') }}" class="c-button--02">新規登録</a>
            </div>
        </div>
    </div>
@endsection
