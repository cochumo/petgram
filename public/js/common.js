$(function(){

    // サイドバー
    var menu = $('#slide_menu');
    var closeBtn = $('#close');
    var menuBtn = $('#slide_menu_btn');
    var body = $(document.body);
    var menuWidth = menu.outerWidth();

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

    // 画像のプレビューを表示
    function file_preview(){
        $('.c-buttonWrap--file').after('<span class="c-form__preview"></span>');

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

            $('.c-button__file').css('display', 'none');
        });

    }

    if ($('input[type=file]').length || $('.c-form__preview').length) {
        file_preview();
    }

});

