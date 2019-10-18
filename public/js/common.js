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
        body.toggleClass('open');
        if(body.hasClass('open')){
            body.animate({'right' : menuWidth }, 300);
            menu.animate({'right' : 0 }, 300);
        } else {
            menu.animate({'right' : -menuWidth }, 300);
            body.animate({'right' : 0 }, 300);
        }
    });

    closeBtn.on('click', function(){
        body.toggleClass('open');
        if(body.hasClass('open')){
            body.animate({'right' : menuWidth }, 300);
            menu.animate({'right' : 0 }, 300);
        } else {
            menu.animate({'right' : -menuWidth }, 300);
            body.animate({'right' : 0 }, 300);
        }
    });

    // footer全般
    $(window).resize(function() {
        console.log('リサイズしたよ')
    });

    $(window).on("touchmove", function(){
        console.log($(window).scrollTop());
        $("footer").stop();
        $("footer").css('display', 'none').delay(500).fadeIn('fast');
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

    /**
     * ページ固有の処理
     */

    // 投稿ページ
    if (routeName == 'photos.create') {
        file_preview();
    }

});

