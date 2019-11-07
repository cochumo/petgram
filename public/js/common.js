/**
 * ready function
 */
$(function(){

    // 現在のルート
    const routeName = $('body').attr('data-route');

    // サイドバー
    const menu = $('#slide_menu');
    const body = $(document.body);
    const menuWidth = menu.outerWidth();
    $('#slide_menu').css('height', window.innerHeight);

    $('#slide_menu_btn, #close').on('click', function(){
        sidebarToggle();
    });

    // footer全般
    $(window).on("touchmove", function(){
        // console.log($(window).scrollTop());
        $("footer").stop();
        $("footer").css('display', 'none').delay(500).fadeIn('fast');
    });

    // formの2重submit対策
    $('form button[type="submit"]').click(function (event) {
        let TIMEOUT = 10000;
        let target  = event.target;
        let $form   = $(target).closest('form');
        let $submit = $form.find('button[type="submit"]');

        // clickしたsubmitの値をhiddenに保存
        let $hidden = $('<input/>', {
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
     * load function
     */
    $(window).on('load',function(){
        // 現在のルート
        const routeName = $('body').attr('data-route');

        //ログイン画面かどうか検査
        if (routeName == 'login') {
            backgroundMovie();
        }
    });

    /**
     * resize function
     */

    $(window).on('resize', function(){
        // ログイン画面かどうか検査
        if (routeName == 'login') {
            backgroundMovie();
        }

        // サイドバーが開いているか検査
        if (body.hasClass('open')) {
            $('#slide_menu').css('height', window.innerHeight);
        }
    });

    /**
     * function
     */

    // 画像のプレビューを表示
    function file_preview(){
        // $('.c-buttonWrap--file').after('<span class="c-form__preview"></span>');
        $('input[type=file]').after('<span class="c-form__preview"></span>');

        $('input[type=file]').change(function () {
            let file = $(this).prop('files')[0];

            if (!file.type.match('image.*')) {
                $(this).val('');
                return;
            }

            let reader = new FileReader();
            reader.onload = function () {
                let img_src = $('<img>').attr('src', reader.result);
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

    // サクセスメッセージの通知
    function successNotification() {
        $('#success').slideDown();
        setTimeout(function(){
            $('#success').slideUp();
        },5000);
    }

    // 背景動画
    function backgroundMovie() {
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
    }

    // 離脱確認
    function leavePages() {
        let submitFlg = false;
        // サイドバーのログアウトボタンを押せないようにする
        $('#logout_btn').css('pointer-events', 'none');

        // 投稿ボタンフラグを立てる
        $("input[type=submit]").click(function() {
            submitFlg = true;
        });

        // 離脱確認ポップアップ表示
        $('a:not(#finished_confirmation), #sidebar__logout').click(function (event) {
            let localName = $(this).prop('localName').toLowerCase();
            if (localName == 'a') {
                let transition_page = $(this).prop('href');
                $('#finished_confirmation').attr('href', transition_page);
            } else if (localName == 'div') {
                $('#finished_confirmation').attr('href', 'logout');
            }
            event.preventDefault();
            $('#leave-pages').css('display', 'block');
            $('#leave-pages').addClass('modal-open');
        });

        $('#finished_confirmation').click(function (event) {
            if ($(this).attr('href') == 'logout') {
                event.preventDefault();
                document.getElementById('logout-form').submit();
            }
        });

        // モーダルを閉じる
        $('.c-modal__close').click(function () {
            $('#leave-pages').css('display', 'none');
        });
    }

    // 投稿操作メニュー出し入れ
    function operationMenu() {
        // 投稿操作メニュー出し
        $('#menu_opan_btn').on('click', function(){
            $('#header_menu_wrap').css('display', 'block');
            $('#header_menu_btn_wrap').slideDown();
        });
        // 投稿操作メニュー入れ
        $('#menu_close_btn').on('click', function(){
            $('#header_menu_btn_wrap').slideUp(function () {
                $('#header_menu_wrap').css('display', 'none');
            });
        });
        // 投稿操作メニュー入れて削除モーダル表示
        $('#post_delete').on('click', function(){
            $('#header_menu_btn_wrap').slideUp(function () {
                $('#header_menu_wrap').css('display', 'none');

                // 削除確認ポップアップ表示
                $('#photo_delete').css('display', 'block');
                $('#photo_delete').addClass('modal-open');

                $('#finished_confirmation').click(function () {
                    document.getElementById('delete-form').submit();
                });

                // モーダルを閉じる
                $('.c-modal__close').click(function () {
                    $('#photo_delete').css('display', 'none');
                });

            });
        });
    }

    /**
     * ページ固有の処理
     */

    // 一覧ページ
    if (routeName == 'photos.index') {
        // サクセスメッセージ
        if ($('#success').length) {
            successNotification();
        }
        // welcomeメッセージ
        if ($('#welcome').length) {
            if (!(window.performance.navigation.type === 1)) {
                $('#welcome').css('display', 'block');
                $('#advance').click(function () {
                    $('#welcome').remove();
                });
            }
        }
    }

    // 投稿ページ
    if (routeName == 'photos.create') {
        file_preview();
    }

    // 投稿確認ページ
    if (routeName == 'photos.confirm') {
        leavePages();
    }

    // 投稿詳細ページ
    if (routeName == 'photos.show') {
        operationMenu();
    }


});
