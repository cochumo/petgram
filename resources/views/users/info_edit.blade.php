@extends('layouts.layout')

@section('content')
    <main class="c-form__authWrap">
        <div class="c-form__authWrapInner--register">
            <div class="">

                <h1 class="c-form__authTtl">登録情報の編集</h1>
                <form method="POST" action="edit_confirm" class="c-form__authForm">
                    @csrf
                    <div class="c-form__authInput">
                        @empty((old('name')))
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus placeholder="アカウント名">
                        @endempty
                        @empty(!(old('name')))
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="アカウント名">
                        @endempty
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="c-form__authInput">
                        @empty((old('email')))
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email" placeholder="ユーザーID（メールアドレス）">
                        @endempty
                        @empty(!(old('email')))
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="ユーザーID（メールアドレス）">
                        @endempty

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
            </div>
        </div>
    </main>
@endsection

