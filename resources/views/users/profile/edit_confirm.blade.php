@extends('layouts.layout')

@section('content')
    <main class="c-form__authWrap">
        <div class="c-form__authWrapInner--register">
            <div class="">
                <h1 class="c-form__authTtl">変更情報の確認</h1>
                <form method="POST" action="{{ route('profile.update', [ auth()->user()->id ]) }}" class="c-form__authForm">
                    @csrf
                    <div class="c-form__authInput">
                        <h3 class="c-form__confirmTtl">アカウント名</h3>
                        <p class="c-form__confirmTxt">{{ $data['name'] }}</p>
                    </div>
                    <div class="c-form__authInput">
                        <h3 class="c-form__confirmTtl">プロフィール</h3>
                        <p class="c-form__confirmTxt @if($data['profile'] == "")u-mT2 @endif">{{ $data['profile'] }}</p>
                    </div>
                    <div class="c-form__confirmBtnWrap">
                        <button type="submit" name="action" value="back" class="c-button--04">修正する</button>
                        <button type="submit" name="action" value="submit" class="c-button--02">変更する</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection

