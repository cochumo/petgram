$(function(){

    // 現在のルート
    const routeName = $('body').attr('data-route');

    // サイドバー
    const menu = $('#slide_menu');
    const closeBtn = $('#close');
    const menuBtn = $('#slide_menu_btn');
    const body = $(document.body);
    const menuWidth = menu.outerWidth();

    menuBtn.on('click', function(){
        sidebarToggle();
    });

    closeBtn.on('click', function(){
        sidebarToggle();
    });

    // リサイズ処理
    $(window).resize(function() {
        if (body.hasClass('open')) {
            $('#slide_menu').css('height', window.innerHeight);
        }
        console.log('リサイズしたよ');
        console.log('有効画面高: ' + screen.availHeight);
        console.log('表示領域高: ' + window.innerHeight);
        console.log('ウィンドウ高: ' + window.outerHeight);
    });

    console.log('有効画面高: ' + screen.availHeight);
    console.log('表示領域高: ' + window.innerHeight);
    console.log('ウィンドウ高: ' + window.outerHeight);

    // footer全般
    $(window).on("touchmove", function(){
        // console.log($(window).scrollTop());
        $("footer").stop();
        $("footer").css('display', 'none').delay(500).fadeIn('fast');
    });

    // formの2重submit対策
    $('form button[type="submit"]').click(function (event) {
        var TIMEOUT = 10000;
        var target  = event.target;
        var $form   = $(target).closest('form');
        var $submit = $form.find('button[type="submit"]');

        // clickしたsubmitの値をhiddenに保存
        var $hidden = $('<input/>', {
            type: 'hidden',
            name: target.name,
            value: target.value
        }).appendTo($form);

        event.preventDefault();
        event.stopPropagation();

        // 全てのsubmitを無効化
        $submit.prop('disabled', true);

        // 時間経過でsubmitの無効化を解除
        setTimeout(function () {
            $hidden.remove();
            $submit.prop('disabled', false);
        }, TIMEOUT);

        $form.submit();
    });

    /**
     * 背景動画
     * https://qiita.com/drasky1132/items/93ab71742175914e61cb
     * $(function(){})の中には.on()は書けないので個別で書く
     */
    $(window).on('load',function(){
        var getWindowMovieHeight = function() {
            // ここでブラウザの縦横のサイズを取得します。
            var windowSizeHeight = $(window).outerHeight();
            var windowSizeWidth = $(window).outerWidth();

            // メディアの縦横比に合わせて数値は変更して下さい。(メディアのサイズが width < heightの場合で書いています。逆の場合は演算子を逆にしてください。)
            var windowMovieSizeWidth = windowSizeHeight * 1.76388889;
            var windowMovieSizeHeight = windowSizeWidth / 1.76388889;
            var windowMovieSizeWidthLeftMargin = (windowMovieSizeWidth - windowSizeWidth) / 2;

            if (windowMovieSizeHeight < windowSizeHeight) {
                // 横幅のほうが大きくなってしまう場合にだけ反応するようにしています。
                $(".js-movie").css({left: -windowMovieSizeWidthLeftMargin});
            }
        };
        getWindowMovieHeight();
    });
    $(window).on('resize', function(){
        var getWindowMovieHeight = function() {
            // ここでブラウザの縦横のサイズを取得します。
            var windowSizeHeight = $(window).outerHeight();
            var windowSizeWidth = $(window).outerWidth();

            // メディアの縦横比に合わせて数値は変更して下さい。(メディアのサイズが width < heightの場合で書いています。逆の場合は演算子を逆にしてください。)
            var windowMovieSizeWidth = windowSizeHeight * 1.76388889;
            var windowMovieSizeHeight = windowSizeWidth / 1.76388889;
            var windowMovieSizeWidthLeftMargin = (windowMovieSizeWidth - windowSizeWidth) / 2;

            if (windowMovieSizeHeight < windowSizeHeight) {
                // 横幅のほうが大きくなってしまう場合にだけ反応するようにしています。
                $(".js-movie").css({left: -windowMovieSizeWidthLeftMargin});
            }
        };
        getWindowMovieHeight();
    });

    /**
     * function
     */

    // 画像のプレビューを表示
    function file_preview(){
        // $('.c-buttonWrap--file').after('<span class="c-form__preview"></span>');
        $('input[type=file]').after('<span class="c-form__preview"></span>');

        $('input[type=file]').change(function () {
            var file = $(this).prop('files')[0];

            if (!file.type.match('image.*')) {
                $(this).val('');
                return;
            }

            var reader = new FileReader();
            reader.onload = function () {
                var img_src = $('<img>').attr('src', reader.result);
                $('.c-form__preview').html(img_src);
            }
            reader.readAsDataURL(file);

            // $('.c-button__file').css('display', 'none');
            $('.c-button__file').css('background-color', 'transparent');
            $('.c-form__preview').css('background-color', '#fff');
        });
    }

    // サイドバー 出し入れ
    function sidebarToggle() {
        $('#slide_menu').css('height', window.innerHeight);
        body.toggleClass('open');
        if(body.hasClass('open')){
            body.animate({'right' : menuWidth }, 300);
            menu.animate({'right' : 0 }, 300);
        } else {
            menu.animate({'right' : -menuWidth }, 300);
            body.animate({'right' : 0 }, 300);
        }
    }


    /**
     * ページ固有の処理
     */

    // 投稿ページ
    if (routeName == 'photos.create') {
        file_preview();
    }

});
