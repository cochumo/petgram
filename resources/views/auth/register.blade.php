@extends('layouts.auth')

@section('content')
    <div class="c-form__authWrap">
        <div class="c-form__authWrapInner">
            <div class="u-textC">
                <h1 class="c-form__auth--title">Petgram</h1>
            </div>
            <form method="POST" action="{{ route('register') }}" class="c-form__authForm">
                @csrf
                <div class="c-form__authInput">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="お名前">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="c-form__authInput">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="メールアドレス">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="c-form__authInput">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="パスワード">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="c-form__authInput">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="パスワード（確認）">
                </div>
                <div class="u-textC">
                    <button type="submit" class="c-button--03">
                        会員登録
                    </button>
                </div>
            </form>
            <div class="u-textC">
                <p class="">アカウントをお持ちの場合はこちらから</p>
                <a href="{{ route('login') }}" class="c-button--02">ログインページ</a>
            </div>
        </div>
    </div>
@endsection
