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

});
