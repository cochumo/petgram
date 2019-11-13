<div id="slide_menu" class="l-sidebarWrap">
    <div class="l-sidebar__userInfo">
        <div class="l-sidebar__userInfo__img">
            @if(auth()->user()->thumbnail == "")
                <img src="{{ asset('/img/default_thumbnail.svg') }}" alt="" class="">
            @else
                <img src="{{ asset('/storage/thumbnail/'.auth()->user()->thumbnail) }}" alt="" class="l-main__thumbnailImg">
            @endif
        </div>
        <div class="l-sidebar__userInfo__txt">
            <p class="">{{ auth()->user()->name }}</p>
        </div>
    </div>
    <div class="l-sidebar__list">
        <a href="{{ route('profile.edit') }}" class="l-sidebar__btn">プロフィール編集</a>
    </div>
    <div class="l-sidebar__list">
        <a href="{{ route('users.edit') }}" class="l-sidebar__btn">アカウント設定</a>
    </div>
    <div id="sidebar__logout" class="l-sidebar__list">
        <a id="logout_btn" class="l-sidebar__btn" href="{{ route('logout') }}"
           onclick="event.preventDefault();document.getElementById('logout-form').submit();">
            ログアウト
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
    <div class="l-sidebar__footer">
        <button id="close">とじる</button>
    </div>
</div>
