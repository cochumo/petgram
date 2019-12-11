@extends('layouts.layout')

@section('content')
    <main class="c-form__authWrap">
        <div class="c-form__authWrapInner--register">
            <div class="c-form__authWrapInner--content">
                <h1 class="c-form__authTtl">アカウント情報の変更</h1>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('users.confirm', [ auth()->user()->id ]) }}" class="c-form__authForm">
                    @csrf
                    <div class="c-form__authInput">
                        <p class="c-form__itemTtl">ユーザーID（メールアドレス）</p>
                        @empty((old('email')))
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email" placeholder="">
                        @endempty
                        @empty(!(old('email')))
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="">
                        @endempty

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="c-form__authInput">
                        <p class="c-form__itemTtl">現在のパスワード</p>
                        <input id="current-password" type="password" class="form-control @error('password') is-invalid @enderror" name="current_password" required autocomplete="new-password" placeholder="">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="c-form__authInput">
                        <p class="c-form__itemTtl">新しいパスワード</p>
                        <input id="new-password" type="password" class="form-control @error('password') is-invalid @enderror" name="new_password" required autocomplete="new-password" placeholder="">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="c-form__authInput">
                        <p class="c-form__itemTtl">新しいパスワードの確認</p>
                        <input id="new-password-confirm" type="password" class="form-control" name="new_password_confirmation" required autocomplete="new-password" placeholder="">
                    </div>
                    <div class="c-form__confirmBtnWrap">
                        <button type="submit" class="c-button--02">確認へ進む</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection

