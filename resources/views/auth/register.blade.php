@extends('layouts.auth')

@section('content')
    <header class="c-form__logoWrap">
        <img src="/img/logo-petgram.svg" alt="Petgram" class="c-form__logo">
    </header>
    <main class="c-form__authWrap">
        <div class="c-form__authWrapInner">
            <h1 class="c-form__authTtl">Petgramアカウントの新規登録</h1>
            <form method="POST" action="{{ route('register') }}" class="c-form__authForm">
                @csrf
                <div class="c-form__authInput">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="アカウント名">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="c-form__authInput">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="ユーザーID（メールアドレス）">

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
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="パスワードの確認">
                </div>
                <div class="c-form__confirmBtnWrap">
                    <button type="submit" class="c-button--02">確認へ進む</button>
                </div>
            </form>
            <div class="u-textC">
                <p class="">アカウントをお持ちの場合はこちらから</p>
                <a href="{{ route('login') }}" class="c-button--03">ログインページ</a>
            </div>
        </div>
    </main>
@endsection
