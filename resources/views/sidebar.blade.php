<div id="slide_menu" class="l-sidebarWrap">
    <div class="l-sidebar__list">
        <a class="l-sidebar__btn" href="{{ route('logout') }}"
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
