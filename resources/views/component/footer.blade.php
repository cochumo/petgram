<footer>
    <div class="l-footerWrap">
        <div class="l-footer__list">
            <a href="{{ route('photos.create') }}" class="l-footer__left">
                <img src="{{ asset('img/icon-post.svg') }}" class="l-footer__post">
            </a>
            <a id="logo" class="" href="{{ route('photos.index') }}">
                <img src="{{ asset('img/logo-petgram.svg') }}" class="l-footer__logo">
            </a>
            <div id="slide_menu_btn" class="l-footer__right">
                <button>
                    <img src="{{ asset('img/icon-mypage.svg') }}" class="l-footer__mypage">
                </button>
            </div>
        </div>
    </div>
</footer>
