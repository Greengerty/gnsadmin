$(document).ready(function() {


    /* delete br */
    $('br').replaceWith(' ');

    if ($("#header")[0]) {
        var $header = $("#header");
        var headerLogo = $('#logo img').attr('src');
        var headerLogoFixed = $('#logo-fixed').val();
        $(window).scroll(function() {
            if ($(this).scrollTop() > 180 && $header.hasClass("default")) {
                $header.removeClass("default").addClass("fixed");
                $("#header #logo img").attr('src', headerLogoFixed);
            } else if ($(this).scrollTop() <= 80 && $header.hasClass("fixed")) {
                $header.removeClass("fixed").addClass("default");
                $("#header #logo img").attr('src', headerLogo);
            }
            $('.search-block').css({'display': 'none'});
            $('.search-function span').removeClass('close-search').addClass('open-search');
            $('.open_select_course').removeClass('active');
        });//scroll
        $('.search-block').css({'display': 'none'});
        $('.search-function span').removeClass('close-search').addClass('open-search');
        /*
         * search block header
         */
        $('.search-function span').bind('click', function() {
            if ($(this).hasClass('close-search')) {
                $('.search-block').css({'display': 'none'});
                $('.search-function span').removeClass('close-search').addClass('open-search');
            }
            else if ($(this).hasClass('open-search')) {
                $('.search-block').css({'display': 'block'});
                $('.search-function span').removeClass('open-search').addClass('close-search');
            }
        });
    }//#header

    if ($('.open_select_course')[0]) {
        $('.open_select_course').bind('click', function() {
            if ($(this).hasClass('active'))
            {
                $(this).removeClass('active');
            }
            else
            {
                $(this).addClass('active');
            }
        });
    }//.open_select_course

    /*
     * select course index page
     */
    if ($('.open-hidden-block')[0]) {
        $('.open-hidden-block').bind('click', function() {
            if ($(this).hasClass('active')) {
                $(this).removeClass('active');
            }
            else {
                $(this).addClass('active');
            }
        });
        $('#full-time').css({'display': 'block'});
        $('#full-time-link').mouseover(function() {
            $('#full-time').css({'display': 'block'});
            $(this).addClass('active');
            $('#evening-link').mouseover(function() {
                $('#full-time').css({'display': 'none'});
                $('#full-time-link').removeClass('active');
            });
        });
        $('#evening-link').mouseover(function() {
            $('#evening').css({'display': 'block'});
            $(this).addClass('active');
            $('#full-time-link').mouseover(function() {
                $('#evening').css({'display': 'none'});
                $('#evening-link').removeClass('active');
            });
        });
    }//.open-hidden-block

    /*
     * fotorama
     */
    if ($('.fotorama')[0]) {
        moveRed($('.fotorama__nav__frame--dot.fotorama__active').index());
        $('.fotorama').fotorama({
            autoplay: 'true',
            array: 'always',
            loop: 'true'
                    //transition:'crossfade'//'dissolve',
        });
        $('#menu').appendTo('.fotorama__nav');
        $('#menu li#1').addClass('act');
        var ind;
        $('.fotorama__arr').bind('click', function() {
            $('#menu li').removeClass('act');
            ind = $('.fotorama__nav__frame--dot.fotorama__active').index();
            $('#menu li#' + ind).addClass('act');
        });

        $('.fotorama__nav__shaft').css({'display': 'none'});
        $('div').on('mouseover', '.slide-info', function() {
            $('.fotorama__arr--prev').addClass('hover');
        });
        $('div').on('mouseleave', '.slide-info', function() {
            $('.fotorama__arr--prev').removeClass('hover');
        });

        $('div').on('mouseover', '.slides img', function() {
            $('.fotorama__arr--next').addClass('hover');
        });
        $('div').on('mouseleave', '.slides img', function() {
            $('.fotorama__arr--next').removeClass('hover');
        });
    }//.fotorama


    if ($('.sertificate')[0]) {
        $('.sertificate_title').bind('click', function() {
            location.href = $(this).parent().find('.sertificate_text p a').attr('href');
        });
        $('.sertificate img').bind('click', function() {
            location.href = $(this).next().find('.sertificate_text p a').attr('href');
        });
    }//.sertificate

    /*fotogalery*/
    if ($('#flb-lightbox-content')[0]) {
        $('#flb-lightbox-content img').css({
            'max-width': '400px',
            'max-height': '300px'
        });

        $('.gallery-item').css({'margin': '0'});
    }//#flb-lightbox-content

    /*
     * fixed name_course in table
     */
    if ($('.tabs_section')[0]) {
        $(".name_cource .fixed_block_name").pin({containerSelector: ".name_fixed"});
        $('.tabs_section .tabs_box').css({'display': 'none'});
        $('.tabs_section .tabs_box.visible').css({'display': 'block'});
        $(".tabs_box:not(.visible)").css({'display': 'none'});
    }


    if ($('.desc-course-full-time')[0]) {
        $(".desc-course-full-time .fixed-courses-block-full-time")
                .pin2({containerSelector: ".full-desc-course-full-time", minWidth: 280, minHeight: 1000});
    }//.desc-course-full-time

    /*
     * search value
     */
    if ($('input#searchsubmit')[0]) {
        $('input#searchsubmit').val(" ");
    }//input#searchsubmit

    $('.link_wrap').click(function(event) {
        return false;
    });

    /*
     *  calendar
     */
    if ($('.date-rent-order')[0]) {
        $('.date-rent-order').click(function() {
            if (!$(this).hasClass('active')) {
                $(this).addClass('active');
                $('#calendar-rent-order').css({"display": "block"});
                $('#calendar-rent-order').datepicker({
                    firstDay: 1, altField: '#dateBron', altFormat: 'yy-mm-dd',
                    hightlight: {
                        format: "yy-mm-dd",
                        values: [],
                        settings: {}
                    }
                });
            }
            else
            {
                $(this).removeClass('active');
                $('#calendar-rent-order').css({"display": "none"});
            }
        });
    }//.date-rent-order

    if ($('.form_order')[0]) {
        $('.form_order label span strong').parent().next().focusout(function() {
            if ($(this).val() == '')
                $(this).css({'border-color': '#cc0000'});
            else if ($(this).val() != '')
                $(this).css({'border-color': '#167A38'});
            else
            {
                $(this).css({'border-color': '#D3D3D3'});
                $(this).focus(function() {
                    $(this).css({'border-color': '#00A1AB'});
                });
            }
        });
        $(".form_order input[value='']").css({'color': '#aaa'});
        $(".form_order input[type='text'],.form_order input[type='email'],.form_order input[type='tel']").keypress(function() {
            $(this).css({'color': '#222'});
        });
    }//.form_order

    if ($('.children_course')[0]) {
        $('.children_course').parent().siblings('.course_list').css({'display': 'none', 'width': '100%'});
        $('.children_course').click(function() {
            if ($(this).hasClass('active')) {
                $(this).find('.cost_skype_block').css({'display': 'none', 'width': '100%'});
                $(this).parent().siblings('.course_list').css({'display': 'none'});
            } else {
                $(this).parent().siblings('.course_list').css({'display': 'table'});
                $(this).next('.hidden-block').find('.cost_skype_block').css({'display': 'block', 'width': '100%'});
            }
        });
    }//.children_course

    if ($('.profi-course')[0]) {
        $('.profi-course')
                .parent('.skype-block-left')
                .parent('.skype-block')
                .parent('.cost_skype_block')
                .parent('.hidden-block').parent('.tabs-course').find('.children_course').empty();//.css({'border':'4px solid #cc0000'});
        $('.profi-course')
                .parent('.skype-block-left')
                .parent('.skype-block')
                .parent('.cost_skype_block')
                .parent('.hidden-block').empty();
    }//.profi-course

    if ($(".name-course")[0]) {
        $(".name-course")
                .next('.hidden-block')
                .find('.skype-block-left')
                .find(".lector")
                .appendTo(
                        $(".name-course.active")
                        .next('.hidden-block')
                        .find('.lector-course')
                        );

        $('.name-course').click(function() {
            if ($(this).hasClass('active')) {
                $(this).removeClass('active');
                $(this).find('.plus-icon').removeClass('active');
                $(this).find('.right').text('Развернуть');
                $(this).parent().removeClass('active');
                $(this).parent().find('.hidden-block').slideUp(500);
                $('html, body').animate({scrollTop: $('table').offset().top + 100}, 1000);
            } else {
                $(this).find('.plus-icon').addClass('active');
                $(this).find('.right').text('Свернуть');
                $(this).addClass('active');
                $(this).parent().addClass('active');
                $(this).next('.hidden-block').slideDown(500);
                $('html, body').animate({scrollTop: $('table').offset().top + 50}, 1000);
            }
        });
        $(".lector").css({'display': 'none'});
    }//.name-course
    if ($('.okoverf')[0]) {
        $('.okoverf').addClass('overlay');
    }
    if ($('#okoverf2')[0]) {
        $('#okoverf').addClass('overlay');
    }

    $('body').flipLightBox();

    if ($('.ico-course-evening')[0]) {
        $('.ico-course-evening').hover(function() {
            $(this).find('img').attr('src', $(this).find($('.ico-course-link-active')).text());
        }, function() {
            $(this).find('img').attr('src', $(this).find($('.path-ico-img')).text());
        });
    }//.ico-course-evening

    if ($('#broadcrumbs-evening')[0]) {
        $('#broadcrumbs-evening span:nth-of-type(5)').css({'display': 'none'}).next().css({'display': 'none'});
        $('#broadcrumbs-evening span:nth-of-type(3)').css({'display': 'none'}).next().css({'display': 'none'});
    }

    if ($('.broadcrumbs_course')[0]) {
        $('.broadcrumbs_course span:nth-of-type(3)').css({'display': 'none'}).next().css({'display': 'none'});
    }
});

function moveRed(i) {
    i = $('.fotorama__nav__frame--dot.fotorama__active').index();

    $('#menu li').removeClass('act');
    $('#menu li#' + i).addClass('act');
    setTimeout(moveRed, 1);
    i++;
}
$(document).keydown(function(e) {
    if (e.keyCode === 27) {
        $('.search-function span').click();
        return false;
    }
});

