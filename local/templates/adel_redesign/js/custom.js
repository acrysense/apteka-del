var prevHash = ''; // запоминать предыдущий hashtag на случай, если одно окно открываем поверх другого


function OpenWin(id) {

    if ( $('#' + id).length > 0 ) {

        var w_h = $(window).height();
        //$('#' + id).css({height: w_h}).fadeIn(200).scrollTop(0);
        $('#' + id).fadeIn(200).scrollTop(0);


        //WinSize();

        window.location.hash = id;


        $('#' + id).addClass('opened');
        $('html').addClass('noScroll');

    }
    else {
        window.location.hash = '';
    }


}

function search_drop() {
    $('.extended-search .search-items').fadeIn(300);
}
function search_drop_close() {
    $('.extended-search .search-items').fadeOut(300);
}

function confirm_telephone() {
    if(!$('.form-order .telephone .confirm-telephone').length){
        $('.form-order .telephone').find('.confirm').before('<div class="confirm-telephone"><input type="text"><a href="#" class="btn">Подтвердить</a></div>');
        $('.form-order .telephone').find('.confirm').text('Код подтверждения выслан по SMS на указанный номер');
    }
    // $('.form-order .telephone').find('.confirm').before('<div class="confirm-telephone"><input type="text"><button class="btn">Подтвердить</button></div>');
    // $('.form-order .telephone').find('.confirm').text('Код подтверждения выслан по SMS на указанный номер');

}

function WinSize() {

    var w_w = $(window).width();
    var w_h = $(window).height();
    $('.win:visible').css({height: w_h});

}

function catalogItemCounter(field){

    var fieldCount = function(el) {

        var
            // Мин. значение
            min = el.data('min') || false,

            // Макс. значение
            max = el.data('max') || false,

            // Кнопка уменьшения кол-ва
            dec = el.prev('.dec'),



            // Кнопка увеличения кол-ва
            inc = el.next('.inc');

        function init(el) {
            if(!el.attr('disabled')){
                dec.click(decrement);
                inc.click(increment);
            }

            // Уменьшим значение
            function decrement() {
                var value = parseInt(el[0].value);
                value--;

                if(!min || value >= min) {
                    el[0].value = value;
                }

                console.info('dec');
                $(el).change();
            };

            // Увеличим значение
            function increment() {
                var value = parseInt(el[0].value);

                value++;

                if(!max || value <= max) {
                    el[0].value = value++;
                }

                console.info('inc');
                $(el).change();
            };

        }

        el.each(function() {
            init($(this));
        });
    };

    $(field).each(function(){
        fieldCount($(this));
    });
}

$(document).ready(function () {
    catalogItemCounter('.fieldCount');
    //ФУНКЦИЯ КЛИКА ВНЕ ОБЛАСТИ ВЫПАДАЛКИ
    jQuery(function ($) {
        $(document).on('mouseup touchstart', function (e) {
            var div = $(".search-block");
            if (!div.is(e.target) && div.has(e.target).length === 0 ) {
                div.find('.search-items').fadeOut();

            }
        });
    });

    jQuery(function ($) {
        $(document).on('mouseup touchstart', function (e) {
            var div = $("#search_product_input_container");
            if (!div.is(e.target) && div.has(e.target).length === 0 ) {
                div.find('.search-items').fadeOut();

            }
        });
    });

});

function CloseWin(id) {
    $('#' + id).fadeOut(300).removeClass('opened');
    $('html').removeClass('noScroll');

    prevHash = $('.win.opened').not('#' + id).attr('id');
    if (typeof(prevHash) == 'undefined') {prevHash = '';}
    // if (prevHash == '') {
    //     window.location.hash = '';
    // } else {
    //     window.location.hash = prevHash;
    // }
    history.pushState("", document.title, window.location.pathname
        + window.location.search);
    document.dispatchEvent(new CustomEvent("modal-hidden"))
}


$(window).on('resize load scroll', function SlideMenuHeight() {
    if ( document.body.clientWidth < 1024 ) {
        // $(".mainMenu").height($(window).height() - $('.header').height());
    }
});


$(document).ready ( function(){


    var header_top_height = $('.header .top').outerHeight();
    var header_height = $('.header').height();


    COORDS_OF_REGIONS = [
        {
            region: 5,
            name: 'Минская область',
            coords: {lat: 53.876505, lng: 27.619647}
        },
        {
            region: 1,
            name: 'Бресткая область',
            coords: {lat: 52.612552, lng: 25.148839}
        },
        {
            region: 3,
            name: 'Гомельская область',
            coords: {lat: 52.567802, lng: 29.771545}
        },
        {
            region: 4,
            name: 'Гродненская область',
            coords: {lat: 53.616562, lng: 24.847999}
        },
        {
            region: 2,
            name: 'Витебская область',
            coords: {lat: 55.232730, lng: 29.147167}
        },
        {
            region: 6,
            name: 'Могилевска область',
            coords: {lat: 53.779218, lng: 30.478673}
        }
    ]

    $('select:not(".select-vanila"), .styler').styler();

    var opt = {
        autoPlay: false,
        singleItem : true,
        transitionStyle : "fade",
        navigation : true,
        pagination: false,

        navigationText : ['<i class="icon-arrow-left"></i>','<i class="icon-arrow-right"></i>']
    }

    if($('#owl-carousel .owl-item').length>1){
        opt.autoPlay = 4000;
        //opt.autoPlay=true;
        // opt.autoPlayTimeout=6000;
        // opt.autoPlaySpeed=5000;
        // opt.autoPlayHoverPause=true;



    }
    $('#owl-carousel').owlCarousel(opt);


    var owl = $('.owl-carousel');
    owl.trigger('owl.play',3000);




    $('#owl-carousel-insurance').owlCarousel({
        navigation: true,
        pagination: false,
        slideSpeed : 1000,
        rewindNav: false,
        items: 3,
        itemsDesktopSmall : [1279,3],
        itemsTablet: [1023,3],
        itemsMobile: [767,1],
        navigationText : ['<i class="icon-arrow-left"></i>','<i class="icon-arrow-right"></i>'],

    });

    $('#owl-carousel-post').owlCarousel({
        navigation: true,
        pagination: false,
        singleItem:true,
        autoHeight : true,
        navigationText : ['<i class="icon-arrow-left"></i>','<i class="icon-arrow-right"></i>'],
        autoplay:true,
        autoplayTimeout:3000,
        autoplayHoverPause:true
    });

    $('#owl-best-buy').owlCarousel({
        navigation: true,
        pagination: false,
        slideSpeed: 1000,
        rewindNav: false,
        items: 4,
        // responsive:{
        //     479:{
        //         items:1
        //     },
        //     767:{
        //         items:2
        //     },
        //     1023:{
        //         items:3
        //     },
        //     1279:{
        //         items:3
        //     }
        // },
        itemsDesktopSmall: [1279, 3],
        itemsTablet: [1023, 3],
        itemsMobile: [767, 1],
        navigationText: ['<i class="icon-arrow-left"></i>', '<i class="icon-arrow-right"></i>']
    });

    $('#owl-best-buy-with').owlCarousel({
        navigation: true,
        pagination: false,
        slideSpeed: 1000,
        rewindNav: false,
        items: 4,
        itemsDesktopSmall: [1279, 3],
        itemsTablet: [1023, 3],
        itemsMobile: [767, 1],
        navigationText: ['<i class="icon-arrow-left"></i>', '<i class="icon-arrow-right"></i>']
    });
    $('#owl-slide').owlCarousel({
        navigation: true,
        pagination: false,
        slideSpeed: 1000,
        rewindNav: false,
        items: 4,
        itemsDesktopSmall: [1279, 4],
        itemsTablet: [1023, 4],
        itemsMobile: [767, 4],
        navigationText: ['<i class="icon-arrow-left"></i>', '<i class="icon-arrow-right"></i>']
    });


    const swiper_location = new Swiper('.swiper-location', {
        slidesPerView: 1,
        spaceBetween: 10,
        loop: true,
    });

    $('.swiper-btn-next').click(function() {
        swiper_location.slideNext();
    })

    $('.swiper-btn-prev').click(function() {
        swiper_location.slidePrev();
    })

    $('.js-show-prev').on('click', function (e) {
        e.preventDefault();
        const data = $(this).attr('data-text')
        const text = $(this).text()

        $(this).prev().slideToggle(300);
        if (data) {
            $(this).attr('data-text', text).text(data);
        }
    })

    $('.js-promo').on('click', function (e) {
        e.preventDefault();
        $(this).prev().removeClass('hidden');
        $(this).remove();
    })

    function errorMessage(text) {
        return `<span class="d-block cl-red fs-14 fw-medium fh-2 mt-5 mess-error">${text}</span>`;
    }

    function errorInput(input, errorText) {
        input.addClass('is-error')
        input.after(errorMessage(errorText))
    }

    function errorCheck(check, errorText) {
        check.parent().addClass('is-error')
        check.next().after(errorMessage(errorText))
    }

    function valid(el) {
        const form = el.parents('form')
        const name = form.find('.valid-name')
        const phone = form.find('.valid-phone')
        const check = form.find('.valid-check')

        form.find('.is-error').removeClass('is-error')
        form.find('.mess-error').remove()

        if(name.val().length === 0) {
            errorInput(name, 'Необходимо указать ФИО')
        }

        if (phone) {
            let valPhone = phone.val();
            valPhone = valPhone.replace(/[^0-9]/g, '');

            if(phone.val().length === 0 || valPhone.length <= 11) {
                errorInput(phone, 'Необходимо указать номер телефона')
            }
        }

        if (!check.is(':checked')) {
            errorCheck(check, 'Необходимо дать согласие на обработку данных')
        }
    }

    $('.js-order').on('click', function (e) {
        e.preventDefault();
        if ($(window).width() <= '767'){
            OpenWin('order-form');
            return
        }
        valid($(this));
    })

    $('.js-order-mobile').on('click', function (e) {
        e.preventDefault();
        valid($(this));
    })

    $('.js-promocod').on('click', function (e) {
        e.preventDefault();
        const parent = $(this).parents('.promo')
        const input = parent.find('.promo__input')

        if (input.val() === '111') {
            parent.after(`<div class="cl-green fs-14 fw-semibold mt-10">Купон применен</div>`)
            $(this).after('<span class="promo-btn promo-btn-ok"></span>')
            $(this).remove();
        } else {
            parent.after(`<div class="cl-red fs-14 fw-semibold mt-10">Купон не найден</div>`)
            $(this).after('<span class="promo-btn promo-btn-no"></span>')
            $(this).remove();
        }
    })

    $('.fieldCount').on('input', function() {
        $(this).val($(this).val().replace(/[A-Za-zА-Яа-яЁё]/, ''))
    });


    $('body').on('click', '.js-show-phone',  function (e) {
        e.preventDefault();
        const parent = $(this).parents('.item-pharmacy')
        parent.find('.item-pharmacy__contact').slideToggle(300)
    })

    $('.js-clear').on('click', function (e) {
        e.preventDefault();
        $(this).prev().val('');
    })

    $('.pharmacy-map__popup-close').on('click', function (e) {
        e.preventDefault();
        $(this).parent().remove();
    })

    // $('.js-map').on('click', function (e) {
    //     e.preventDefault();
    //
    //     if(!$(this).hasClass('is-active')){
    //         $('.pharmacy-map').show();
    //         $('.pharmacy-ls').hide();
    //         // new PMap();
    //     } else {
    //         $('.pharmacy-map').hide();
    //         $('.pharmacy-ls').show();
    //     }
    //     $(this).toggleClass('is-active');
    // })

    $(".jsMaskPhone").mask("+375(99)999-99-99", {autoclear: false});
    $(".jsMaskCard").mask("999-999-999-999-9", {autoclear: false});
    $(".jsMasDate").mask("99/99/9999", {autoclear: false});

    jQuery.validator.addMethod("jsMethodCheckMaskPhone", function(value) {
        return /\+\d{3}\(\d{2}\)\d{3}-\d{2}-\d{2}/g.test(value);
    });

    jQuery.validator.addMethod("jsMethodCheckMaskCard", function(value) {
        return /\d{3}-\d{3}-\d{3}-\d{3}-\d{1}/g.test(value);
    });

    $('#feedback').validate();
    $('.reger').validate();
    //$('#authorization').validate();
    //$('#profile').validate();
    $('#sender-subscribe form').validate();
    $('#order').validate();

    $( function() {
        if($('body .datepicker').length){
            $( ".datepicker" ).datepicker();
        }
    } );







    $(".give-more").on('click', ".give-next", function () {
        $(".catalog .block-symptomatology .item.display-none").removeClass('display-none');
        $(".give-more > .give").addClass('open-more').removeClass('give-next');
        $(".give-more .text").text('Скрыть');
        $(".give-more .icon-arrow-bottom").addClass('return');
    });
    $(".give-more").on('click', ".open-more", function () {
        $(".catalog .block-symptomatology .item[data-more]").addClass('display-none');
        $(".give-more .text").text('Показать ещё');
        $(".give-more > .give").removeClass('open-more');
        $(".give-more .icon-arrow-bottom").removeClass('return');
        $(".give-more > .give").addClass('give-next');
    });


    $(function () {
        var Accordion = function (el, multiple) {
            this.el = el || {};
            this.multiple = multiple || false;

            // Variables privadas
            var links = this.el.find('.link > .wrapper-ico');
            // Evento
            links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown);
        };

        Accordion.prototype.dropdown = function (e) {
            var $el = e.data.el;
            var $this = $(this);
            var $next = $this.parent().next();

            $next.slideToggle();
            $this.parent().parent().toggleClass('open');

            if (!e.data.multiple) {
                $el.find('.submenu').not($next).slideUp().parent().removeClass('open');
            }
        };

        $(document).find('.accordion').each(function() {
            var accordion = new Accordion($(this), false);

        });


    });

    $(function () {
        var Accordion = function (el, multiple) {
            this.el = el || {};
            this.multiple = multiple || false;

            // Variables privadas
            var links = this.el.find('.podmenu > .ico');
            // Evento
            links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown);
            // $('.current-catalog .accordion2 > li').each(function () {
            //     if($(this).hasClass('open')){
            //        $(this).parents('li').eq(0).addClass('open')
            //     }
            // });
        };

        Accordion.prototype.dropdown = function (e) {
            var $el = e.data.el;
            var $this = $(this);
            var $next = $this.parent().next();

            $next.slideToggle();
            $this.parent().parent().toggleClass('open');

            if (!e.data.multiple) {
                $el.find('.submenu').not($next).slideUp().parent().removeClass('open');
            }
        };

        $(document).find('.accordion2').each(function() {
            var accordion = new Accordion($(this), false);

        });
    });

    $(document).on('click', function(e) {
		var acc = $(e.target).closest(".accordion");
		var acc_submenu = acc.find('.submenu');
        if (!acc.length) {
            acc_submenu.slideUp(150, function () {
                $(this).closest('li').removeClass('open');
            });
        }
        //e.stopPropagation();
    });

    /*
        $(".accordion .item .wrapper-icon").click(function () {
            var all_sliderAll = $(this).closest('.accordion').find("item");
            var thisBlock = $(this).parent();
            if (all_sliderAll.hasClass('active')) {
                if (!thisBlock.hasClass('active')) {
                    $(".catalog .item.active .accordion").slideUp(300);
                    $(".catalog .item.active").removeClass('active');

                    thisBlock.addClass('active');
                    $(this).parent().find(".accordion").slideDown(300);
                    console.log('asd');
                } else {
                    thisBlock.find(".accordion").slideUp(300);
                    thisBlock.removeClass('active');
                }
            } else {
                thisBlock.addClass('active');
                thisBlock.find(".accordion").slideDown(300);
            }
        });
    */


    $(".sort-position").click(function () {
        if ($(".sort-position .item-sort").hasClass('active')) {
            if ($(this).find(".jq-selectbox__trigger-arrow").hasClass('active')) {
                $(".sort-position .item-sort").removeClass('active');
                $(".sort-position .no-rotate").removeClass('active green');
                $(".sort-position .rotate").removeClass('active green');
                $(this).find('.item-sort').addClass('active green');
                $(this).find(".rotate").addClass('green');
            } else {
                $(".sort-position .item-sort").removeClass('active green');
                $(".sort-position .no-rotate").removeClass('active green');
                $(".sort-position .rotate").removeClass('active green');
                $(this).find('.item-sort').addClass('active green');
                $(this).find(".no-rotate").addClass('active green');
            }
        } else {
            $(".sort-position .no-rotate").removeClass('active green');
            $(".sort-position .rotate").removeClass('active green');
            $(this).find('.item-sort').addClass('active green');
            $(this).find(".no-rotate").addClass('active green');
        }
    });


    $('.check-recept input').each(function () {
        $(this).on('change', function () {
            if($(this).prop('checked')){
                $(this).closest('.check-recept').find('input').not($(this)).prop('checked',false);
            }
        })

    });




    var put;
    $('.check-another .jq-selectbox__trigger-arrow').each(function () {
        if($(this).hasClass('green')){
            put = $(this).attr('data-name');
        }
        $('#form_sort').val(put).trigger('change')

    });

    $('.check-another .sort-position').on('click',function () {
        var dataAttr = $('.check-another').find('.jq-selectbox__trigger-arrow.green').attr('data-name');
        var xx = $('#form_sort').val(dataAttr);
        console.log(xx)
    });


    //Плавный сколл к блоку

    $(".catalog a.wrapper-icon").on("click", function (event) {
        //отменяем стандартную обработку нажатия по ссылке
        event.preventDefault();
        //забираем идентификатор бока с атрибута href
        var id = $(this).attr('href'),
            //узнаем высоту от начала страницы до блока на который ссылается якорь
            top = $(id).offset().top - 56;
        console.log(top);
        //анимируем переход на расстояние - top за 1500 мс
        $('body,html').animate({scrollTop: top}, 700);
    });

    $('.header li.dropdown .icon-bottom').on('click', function () {
      $(this).closest('.dropdown')
        .toggleClass('open')
        .siblings()
          .removeClass('open')
    });
    $('.header li.dropdown > a').on('click', function () {
      if ($(this).attr('href') !== undefined) return;
      $(this).closest('.dropdown')
        .toggleClass('open')
        .siblings()
          .removeClass('open')
    });

    $('.catalog .dropdown .icon-arrow-bottom').on('click', function () {
        $('.catalog .dropdown').not($(this).closest('.dropdown')).find('.dropdown-block').slideUp(200);
        $('.catalog .dropdown').not($(this).closest('.dropdown')).removeClass('open');

        $(this).closest('.dropdown').find('.dropdown-block').slideToggle(200);
        $(this).closest('.dropdown').toggleClass('open');
    });

    $('.catalog .dropdown .close').on('click', function () {
        $(this).closest('.dropdown').find('.dropdown-block').slideUp(200);
        $(this).closest('.dropdown').removeClass('open');
    });


    $('.header .controls .mobile-search').on('click',function () {
      $('body').addClass('is-search-show')
    });
    $('.header .controls .close-search').on('click',function () {
        $(this).closest('.controls').removeClass('open');
    });
    $('.form-order .sex').on('change', function () {
        $('.form-order .jq-selectbox__select-text').css('color', '#333333')
    });


    $(window).scroll(function() {


        if ( $(this).scrollTop() > 100 ) {
            $('.link-totop').fadeIn();
        }
        else {
            $('.link-totop').fadeOut();
        }

        /* -- LINK TO TOP -- */
        if ( $(this).scrollTop() > 100 ) {
            $('.link-totop').fadeIn();
        }
        else {
            $('.link-totop').fadeOut();
        }



        /* -- MAIN MENU */
        if ( $(this).scrollTop() > header_top_height ) {
            $('body').css('paddingTop', header_height);
            $('body').addClass('slideMenu');

        } else {
            $('body').css('paddingTop', 0);
            $('body').removeClass('slideMenu');
        }

        // SlideMenuHeight();


    });







    $('.link-totop').click ( function(){
        $('html, body').stop().animate({ scrollTop: 0 }, 300, 'linear');
    });

    if( document.querySelector('[data-tabs=tabs]') ) {
        document.querySelector('[data-tabs=tabs]').addEventListener('click',function(e){
            if ( e.target.nodeName === 'LI') {

                Array.prototype.forEach.call(this.children,function(item,i){
                    item.classList.remove('active')
                    //$(item).slideUp(500);
                });

                e.target.classList.add('active');
                //$(e).slideDown(500);

                var bookmarks = document.querySelector('[data-bookmarks=bookmarks]');

                var eq;
                Array.prototype.forEach.call( this.children, function(item,i){ if ( item === e.target ) eq=i});

                Array.prototype.forEach.call( bookmarks.children, function(item) {
                    item.classList.remove('active');
                    $(item).hide();
                });
                bookmarks.children[eq].classList.add('active');
                $(bookmarks.children[eq]).fadeIn(500);

            }
        });
    }

    $('.mobileBtn').on('click', function(e) {
        $(".popup-menu").stop().slideToggle();
        $('body').toggleClass('open-burger');
        $(this).toggleClass('is-open');
    });

    $(window).on('load', function () {
        $('.ellipsis').dotdotdot({
            watch: 'window'
        });
        if(window.location.hash) {

            prevHash = '';
            var hash = window.location.hash.substring(1);



            if (
                (hash != '') &&
                (typeof($('#' + hash)) != 'undefined') &&
                ($('#' + hash) != null) &&
                ($('#' + hash).hasClass('win'))
            ) {

                OpenWin(hash);
            }

            if ( !$('#' + hash).hasClass('win') ) {
                var top = $('#' + hash).offset().top;
                top = top - 50;
                console.log(hash);
                console.log(top);
                $('html, body').stop().animate({ scrollTop: top}, 800, 'swing');
                //console.log('scrollTop load: ' + hash + ', top = ' + top);
                //$.scrollTo($('#' + hash), 500, {offset:-100});
            }
        }
    });


    $('.open-sidebar').on('click',function () {
        $('.current-catalog .sidebar').addClass('open').animate({width: "+=300"}, 100);
        $('body').addClass('mobile-sidebar');
    });
    $('.open-filter').on('click',function () {
        $('.filter-popup').addClass('open');
        $('body').addClass('mobile-sidebar');
    });
    $('.close-filter').on('click',function () {
        $('.filter-popup').removeClass('open');
        $('body').removeClass('mobile-sidebar');
    });
    $('.current-catalog .wrapper .close-sidebar .return').on('click',function () {
        $('.current-catalog .sidebar')
          .removeClass('open')
          .css('width', 0);
        $('body').removeClass('mobile-sidebar');
    });


// jQuery for page scrolling feature

    $("a[href|='#']").click(function(e) {
        //console.log('scrollTop click');
        var anc = $(this);
        var hash = $(this).substring(1);
        //if ($($anchor.attr('href'))) {
        var top = $('#' + hash).offset().top - 300;
        $('html, body').stop().animate({ scrollTop: top}, 500, 'linear');
        e.preventDefault();
        //console.log('scrollTop click: ' + hash + ', top = ' + top);

        //}
    });



    $("table").wrap("<div class='table-div'></div>");


    $('.read-more').click(function() {
        var height_all = 0;
        var text = $(this).closest(".wrapper-read-more").prev('.text');
        text.children().each(function () {
            height_all += $(this).outerHeight();
            //console.log(height_all);
        });
        var arr = $(this).find(".ico-arrow");
        if (arr.hasClass('open')) {
            text.animate({height: '78px'}, 300);
            arr.removeClass("open")
        } else {
            text.animate({height: height_all}, 300);
            arr.addClass("open")
        }
    });


    /* ========= ПРОВЕРКА БОНУСНЫХ БАЛЛОВ =========== */
    $('#points-submit').click(function () {
        var input = $('.jsMaskCard');

        input.removeClass('error');

        if (input.val().length > 0) {
            var inputVal = input.val().split('-');

            var test_number=inputVal.join('');

            console.info(test_number);

            $.each(inputVal, function (idx, val) {
                inputVal[idx] = val.replace('_', '');
            });

            if (inputVal[1].length < 3 || inputVal[2].length < 3 || inputVal[4].length < 1) {
                input.addClass('error');
            } else {
                var number = inputVal[1] + inputVal[2];
                console.info(number);
                $.ajax({
                    method: "POST",
                    url: '/ajax/get_points.php',
                    data: {
                        card_number: number
                    },
                    success: function (data) {
                        var responce = JSON.parse(data);
                        if (responce.success && $.isNumeric(responce.points)) {
                            input.val('');
                            $('.b-modal-points__form').hide();
                            $('#points-submit').hide();
                            $('.b-modal-points__back').show();
                            $('.b-modal-points__success').show();
                            $('.b-modal-points__points').text(responce.points);
                        } else {
                            input.val('');
                            $('.b-modal-points__form').hide();
                            $('#points-submit').hide();
                            $('.b-modal-points__back').show();
                            $('.b-modal-points__error').show();
                        }
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });


                /*
                $.ajax({
                    url: "/ajax/get_points.php",
                    type: "POST",
                    data: {card_number: number},
                    dataType: 'json',
                    cache: false,
                    success: function(data)
                    {

                        var responce = JSON.parse(data);

                        if (responce.success) {
                            input.val('');
                            $('.b-modal-points__form').hide();
                            $('#points-submit').hide();
                            $('.b-modal-points__back').show();
                            $('.b-modal-points__success').show();
                            $('.b-modal-points__points').text(responce.points);

                        } else {
                            input.val('');
                            $('.b-modal-points__form').hide();
                            $('#points-submit').hide();
                            $('.b-modal-points__back').show();
                            $('.b-modal-points__error').show();
                        }
                    },
                    error: function (request, status, error) {
                        console.log('Error: ' + error);
                        console.log('Status: ' + status);

                    }
                });

                */


            }
        }
    });

    $('.b-modal-points__back').click(function () {
        $(this).hide();
        $('.b-modal-points__success').hide();
        $('.b-modal-points__error').hide();
        $('.b-modal-points__form').show();
        $('#points-submit').show();
    });

    /* ========= END OF ПРОВЕРКА БОНУСНЫХ БАЛЛОВ =========== */

});


$(function () {
    if ($("#datepicker").length) {

		$("#datepicker").datepicker({
	        changeMonth: true,
    	    changeYear: true,
        	yearRange: "1930:2017",
	        monthNamesShort: ["Янв", "Фев", "Мар", "Апр", "Май", "Июн", "Июл", "Авг", "Сен", "Окт", "Ноя", "Дек"],
    	    dayNamesMin: ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"]
	    });

	}
});
// $('.number-card').inputmask('+375 99 999-99-99');

$('.header .controls .mobile-search').on('click',function () {
  $('body').addClass('is-search-show')
});
$('.js-search-close').on('click', function () {
  $('body').removeClass('is-search-show')
});
$('.title-search-result').width($('.search-block-wide').width());
$('.title-search-result').css('left', $('.search-block-wide')[0].getBoundingClientRect().x);
$('.js-search-block').on('click', function () {
  $('body').addClass('is-search-show');
  $('.search-block-wide form')[0].reset();
  setTimeout(function () {
    $('.bx-form-control').focus();
  }, 500)
});
$('.search-block-wide button[type="reset"]').on('click', function () {
  if($('.bx-form-control').val() == '') {
    $('body').removeClass('is-search-show');
  }
});

// Close modal City
$('.js-modal-city').on('click',function () {
    $('.modal-city').remove();
});

$('.popup-select-city__radio').on('click', 'input[name="select-city"]', function () {
    var id = $(this).attr('id');
    var cityName = $('label[for="' + id + '"]').text();

    console.log('NAME: ' + cityName);

    document.cookie = "selectedCity=" + encodeURIComponent(cityName) + "; path=/; domain=.apteka-adel.by; max-age=3600000; secure"; //для теста test.apteka-adel.by, для основы догадайся
});

$('.popup-select-city__input').on('input', function () {

    if ($(this).val().length > 2) {
        $.ajax({
            method: "POST",
            url: '/ajax/get_cities.php',
            data: {
                string: $(this).val()
            },
            success: function (data) {
                console.log(data);
                var container = $('.popup-select-city__radio');
                container.html('');
                var responce = JSON.parse(data);
                responce.forEach(function (value, index) {
                    var elem = '<li class="field-radio"><input type="radio" name="select-city" id="city' + index + '" ><label for="city' + index + '">' + value['NAME_RU'] + '</label>';
                    container.append(elem);
                });
            },
            error: function (data) {
                console.log(data);
            }
        });

        $('.popup-select-city__list').removeClass('is-visible');
        $('.popup-select-city__radio').addClass('is-visible');
    } else {
        $('.popup-select-city__list').addClass('is-visible');
        $('.popup-select-city__radio').removeClass('is-visible');
    }
})

$(document).on('click', function(e){
  //console.log(e.target)
  var container = $('.search-block-wide');
  var searchLink = $('.js-search-block');
  var searchMobileLink = $('.header .controls .mobile-search');
  if(!searchMobileLink.is(e.target) && !searchLink.is(e.target) && !container.is(e.target) && container.has(e.target).length === 0){
    $('body').removeClass('is-search-show')
  }
});

$('.closeIcon').click( function(){
    CloseWin( $(this).closest('.win').attr('id') );
});
