var $ = jQuery;

$(function () {
    "use strict";
    $('.toggle_nav').on('click', function (e) {
    $(this).parents('.toggle_nav').next('ul').slideToggle();
    })
    // var fixedTable = fixTable(document.getElementById('seip_statistics'));


    $('.slideNav').on('click', function (e) {
        e.stopPropagation();
    })

    $('.slideNav-trigger,.btn-close').on('click', function (e) {
        $('body').toggleClass('slideNav-open');
        $('.slideNav').toggleClass('shadow');
        e.stopPropagation();
    })

    $(document).on('click', function (e) {
        $('body').removeClass('slideNav-open');
        $('.slideNav').removeClass('shadow');
        e.stopPropagation();
    })


    $('[data-toggle="tooltip"]').tooltip()

    if ($('.pScroll').length) {
        $('.pScroll,.main-nav .sub-menu').each(function () {
            var pScroll = this;
            const pscr = new PerfectScrollbar(pScroll, {
                wheelSpeed: .5,
                suppressScrollX: false,
                wheelPropagation: true
            });

            $('.nav-link,.select_tranche button').on("click", function () {
                pScroll.scrollTop = 0;
            });

        })
    }

    // $('.sidebar-nav a[href^="/' + location.pathname.split("/")[1] + '"]').addClass('active');

    $('.slideNav a[href="' + window.location.href + '"]').addClass('active').parents('li.menu-item-has-children').addClass('current-menu-parent');
    $('.sidebar-nav a[href="' + window.location.href + '"]').addClass('active').parents('li.menu-item-has-children').addClass('current-menu-parent');
    $('.main-nav a[href="' + window.location.href + '"]').addClass('active').parents('li.menu-item-has-children').addClass('current-menu-parent');

    $('.main-nav li.menu-item-has-children').each(function () {
        if ($(this).hasClass('current-menu-ancestor')) {
            $(this).append('<span class="fa fa-caret-down nav-arrow"></span>');
        } else {
            $(this).append('<span class="fa fa-caret-down nav-arrow"></span>');
        }
    })

    $('.slideNav li.menu-item-has-children').each(function () {
        if ($(this).hasClass('current-menu-ancestor')) {
            $(this).append('<span class="fa fa-caret-down nav-arrow"></span>');
        } else {
            $(this).append('<span class="fa fa-caret-right nav-arrow"></span>');
        }
    })
    $('.sidebar-nav li.menu-item-has-children').each(function () {
        $(this).append('<span class="fa fa-caret-right nav-arrow"></span>');
    })


    $('.slideNav .menu-item-has-children > a').off('click').on('click', function (e) {
        e.preventDefault();
        $(this).parents('.menu-item-has-children').find('ul.sub-menu').slideToggle();
        $(this).siblings('span.fa').toggleClass('fa-caret-down').toggleClass('fa-caret-right');
    })

    if ($('.slider').length) {
        $('.slider').bxSlider({
            pause: 20000,
            controls: false,
            pager: false,
            auto: true,
            onSliderLoad: function () {
                setTimeout(function () {
                    $('.slider > div').eq(1).find('.banner-content .text-slide-1').addClass('show animated fadeInDown');
                }, 20);
                setTimeout(function () {
                    $('.slider > div').eq(1).find('.banner-content .text-slide-1').removeClass('show animated fadeInDown');
                    $('.slider > div').eq(1).find('.banner-content .text-slide-2').addClass('show animated fadeInUp');
                }, 8000);
            },
            onSlideBefore: function () {
                $('.slider .banner-content div').removeClass('show animated fadeInDown');
                $('.slider .banner-content div').removeClass('show animated fadeInUp');
            },
            onSlideNext: function () {
                setTimeout(function () {
                    $('.slider .banner-content .text-slide-1').addClass('show animated fadeInDown');
                }, 20);
                setTimeout(function () {
                    $('.slider .banner-content .text-slide-1').removeClass('show animated fadeInDown');
                    $('.slider .banner-content .text-slide-2').addClass('show animated fadeInUp');
                }, 8000);
            },
            onSlidePrev: function () {
                setTimeout(function () {
                    $('.slider .banner-content .text-slide-1').addClass('show animated fadeInDown');
                }, 20);
                setTimeout(function () {
                    $('.slider .banner-content .text-slide-1').removeClass('show animated fadeInDown');
                    $('.slider .banner-content .text-slide-2').addClass('show animated fadeInUp');
                }, 8000);
            },

        });
    }


    $('.search-wrap span').click(function (e) {
        e.stopPropagation();
        $(this).parents('.search-wrap').toggleClass('show');
        setTimeout(function () {
            $('.search-wrap input').focus();
        }, 100);
    });

    $('.search-wrap input').click(function (e) {
        e.stopPropagation();
    });

    $(document).on('click', function (e) {
        $('.search-wrap').removeClass('show');
    })

    /*if ($('select').length) {
        $('select').select2({
            width: '100%'
        });
    }*/


    $(window).scroll(function () {
        var scroll = $(window).scrollTop();
        if (scroll >= 100) {
            $('body').addClass('sticky')
        } else {
            $('body').removeClass('sticky')
        }
    });
    console.log('custom-script loaded...')

})
