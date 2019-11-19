@extends('layouts.layout')

@section('content')
    <main class="c-form__authWrap">
        <div class="c-form__authWrapInner--register">
            <div class="">
                <h1 class="c-form__authTtl">プロフィールの変更</h1>
                <a href="{{ route('thumbnail.edit') }}" class="c-form__userThumbnail">
                    <div class="c-form__userThumbnail__img">
                        @if(auth()->user()->thumbnail == "")
                            <img src="{{ asset('/img/default_thumbnail.svg') }}" alt="" class="">
                        @else
                            <img src="{{ asset('/storage/thumbnail/'.auth()->user()->thumbnail) }}" alt="" class="l-main__thumbnailImg">
                        @endif
                    </div>
                    <div class="c-form__userThumbnail__txt">
                        プロフィール画像の変更
                    </div>
                </a>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('profile.confirm', [ auth()->user()->id ]) }}" class="c-form__authForm">
                    @csrf
                    <div class="c-form__authInput">
                        <p class="c-form__itemTtl">アカウント名</p>
                        @empty((old('name')))
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus placeholder="">
                        @endempty
                        @empty(!(old('name')))
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="">
                        @endempty
                    </div>
                    <div class="c-form__authInput">
                        <p class="c-form__itemTtl">プロフィール</p>
                        @empty((old('profile')))
                            <textarea class="form-control" name="profile" id="profile" rows="4" placeholder="">{{ $user->profile }}</textarea>
                        @endempty
                        @empty(!(old('profile')))
                            <textarea class="form-control" name="profile" id="profile" rows="4" placeholder="">{{ $user->profile }}</textarea>
                        @endempty
                    </div>
                    <div class="c-form__confirmBtnWrap">
                        <button type="submit" class="c-button--02">確認へ進む</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection

