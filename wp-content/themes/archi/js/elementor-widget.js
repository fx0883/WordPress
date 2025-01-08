( function( $ ) {
    'use strict';

    /* rtl check */
    function rtl_owl(){
    if ($('body').hasClass("rtl")) {
        return true;
    } else {
        return false;
    }};
    /* rtl for Isotop */
    function rtl_isotop(){
        if ($('body').hasClass("rtl")) {
            return false;
        } else {
            return true;
        }
    };

    /* OT Custom Nav Arrow Slider */
    var otNavText = [
        '<i class="fa fa-angle-left"></i>',
        '<i class="fa fa-angle-right"></i>'
    ];

    /* --------------------------------------------------
     * toggle search
     * --------------------------------------------------*/
    var otSearch = function($scope, $){
        $scope.find('.octf-search').each( function(){
            var selector = $(this);
            selector.find('.toggle_search').on("click", function(){
            $(this).toggleClass( "active" );
                selector.find('.h-search-form-field').toggleClass('show');
            if ($(this).find('i').hasClass( "fa fa-search" )) {
                $(this).find('i').removeClass( "fa fa-search" ).addClass("fa fa-close");
            }else{
                $(this).find('i').removeClass( "fa fa-close" ).addClass("fa fa-search");
            }
          });
        });
    };

    /* --------------------------------------------------
     * mobile menu
     * --------------------------------------------------*/
    var otMenuMobile  = function(){
        var element = $('#mmenu-toggle'),
            mmenu   = $('#mmenu-wrapper');

        function mmenu_handler() {
            var isActive = !element.hasClass('active');

            element.toggleClass('active', isActive);
            mmenu.toggleClass('mmenu-open', isActive);
            $('body').toggleClass('mmenu-active', isActive);
            return true;
        }

        $('#mmenu-toggle, .mmenu-close, .mmenu-overlay, .octf-menu-mobile a[href*="#"]:not([href="#"])').on('click', mmenu_handler);

        $('.mmenu-wrapper li:has(ul)').prepend('<span class="arrow"><i class="fa fa-angle-down"></i></span>');
        $(".mmenu-wrapper .mobile_mainmenu > li span.arrow").on('click',function() {
            $(this).parent().find("> ul").stop(true, true).slideToggle()
            $(this).toggleClass( "active" ); 
        });
    };

    /* --------------------------------------------------
    * Hamburger menu
    * --------------------------------------------------*/
    var hamburgerMenu = function($scope, $){
        $scope.find('.octf-menu-hamburger-area').each( function(){
            var selector         = $(this),
                btnToggle        = selector.find('.menu-hamburger-toggle'),
                menuHamburger    = selector.find('.octf-menu-hamburger'),
                menuOverlay      = selector.find('.menu-overlay'),
                btnClose         = menuHamburger.find('#menu-hamburger-close');

            function menu_hamburger_handler() {
                var isActive = !btnToggle.hasClass('active');
                btnToggle.toggleClass('active', isActive);
                menuHamburger.toggleClass('open-menu', isActive);
                $('body').toggleClass('side-menu-active', isActive);
                return false;
            }
            
            btnToggle.on('click', menu_hamburger_handler);
            btnClose.on('click', menu_hamburger_handler);
            menuOverlay.on('click', menu_hamburger_handler);
            document.addEventListener('keydown', function(event){
                if(event.key === "Escape" && $('body').hasClass('side-menu-active')){
                    menu_hamburger_handler();
                }
            });
        });
    };

    /* --------------------------------------------------
    * menu vertical
    * --------------------------------------------------*/
    var menuVertical = function($scope, $){
        if( $scope.find('.vertical-main-navigation').length ){
            $scope.find('.vertical-main-navigation').each( function(){
                var selector         = $(this),
                    itemHasChildren  = selector.find('> ul > li.menu-item-has-children'),
                    nItemHasChildren = selector.find('ul ul > li.menu-item-has-children');

                itemHasChildren.each( function(){
                    $(this).find('> a').append('<i class="fa fa-angle-down" aria-hidden="true"></i><i class="fa fa-angle-up" aria-hidden="true"></i>')
                    .on('click',function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        itemHasChildren.not($(this).parent()).find('>ul').stop(true, true).slideUp();
                        nItemHasChildren.find('> ul').stop(true, true).slideUp();
                        nItemHasChildren.find('> a').removeClass('active');
                        itemHasChildren.find('> a').not($(this)).removeClass('active');
                        $(this).parent().find('> ul').stop(true, true).slideToggle();
                        $(this).toggleClass( 'active' );
                    });
                });
                nItemHasChildren.each( function(){
                    $(this).find('> a').append('<i class="fa fa-angle-down" aria-hidden="true"></i><i class="fa fa-angle-up" aria-hidden="true"></i>')
                    .on('click',function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        $(this).parents('sub-menu').eq(0).find('li.menu-item-has-children').not($(this).parent().eq(0)).find('> ul').stop(true, true).slideUp();
                        $(this).parents('sub-menu').eq(0).find('li.menu-item-has-children').find('> a').not($(this)).removeClass('active');
                        $(this).parent().eq(0).find('> ul').stop(true, true).slideToggle();
                        $(this).toggleClass( 'active' );
                    });
                });
            });
        }
    };

    /* --------------------------------------------------
     * progress bars
     * --------------------------------------------------*/
    function progressBar() {
        $('.ot-progress > li:not([data-processed])').each(function() {

            var pos_y = $(this).offset().top +  $(this).height(),
                value = $(this).find(".ot-progress__bar").attr('data-value'),
                topOfWindow = $(document).scrollTop() + $(window).height();
            if (pos_y < topOfWindow ) {
                $(this).attr("data-processed", "true");
                $(this).find(".ot-progress__bar").animate({
                    'width': value + "%"
                }, "slow");
            }

        });
    };

    /* --------------------------------------------------
    * Accordions
    * --------------------------------------------------*/
    var otAccordions = function ($scope, $) {
        $scope.find('.ot-accordions-wrapper').each( function () {
            var selector = $(this),
                content = selector.find('.ot-acc-item__content'),
                header  = selector.find('.ot-acc-item__title');

            header.off("click");

            header.each(function(){
                if ($(this).data('default') == 'yes') {
                    $(this).next().addClass('active').slideDown(200);
                    $(this).parent().addClass('current');
                }
            });

            header.on('click', function(e){
                e.preventDefault();
                var $this = $(this);

                $this.next().toggleClass('active').slideToggle(200);
                $this.parent().toggleClass('current');
                if( !selector.hasClass('alway-open') ){
                    content.not($this.next()).slideUp(200);
                    header.not($this).parent().removeClass('current');
                }
            });
        });
    };

    /* --------------------------------------------------
    * Tabs
    * --------------------------------------------------*/
    var otTabs = function ($scope, $) {

        $scope.find('.ot-tabs').each(function() {
            var selector = $(this),
                tabs     = selector.find('.ot-tabs__heading .ot-tabs__item'),
                content  = selector.find('.ot-tabs__content');
            
            tabs.first().addClass('current');
            content.first().addClass('current').show();
            
            tabs.on( 'click', function(e){
                e.preventDefault();
                if( $(this).hasClass('current') ) return false;
                var tab_id = $(this).attr('data-tab');
                $(this).siblings().removeClass('current');
                $(this).parents('.ot-tabs').find('.ot-tabs__content').removeClass('current').hide();
                $(this).addClass('current');
                $("#"+tab_id).addClass('current').fadeIn(300);
            });
        });
    };

    /* --------------------------------------------------
    * Big Tabs
    * --------------------------------------------------*/
    var otBigTabs = function ($scope, $) {
        $scope.find('.ot-big-tabs').each( function () {
            var selector    = $(this),
                tabItem     = selector.find('.ot-tabs__heading .ot-tabs__item');

            tabItem.each(function() {
                var tab_id_each = $(this).attr('data-tab');
                $("#"+tab_id_each).hide();
            });
            tabItem.first().addClass('current');
            $("#"+tabItem.first().attr('data-tab')).show();

            tabItem.on( 'click', function(e){
                e.preventDefault();
                if( $(this).hasClass('current') ) return false;

                var tab_id_current = $(this).attr('data-tab');
                $(this).siblings().removeClass('current');
                tabItem.each(function() {
                    var tab_id_each = $(this).attr('data-tab');
                    $("#"+tab_id_each).hide();
                });
                $(this).addClass('current');
                $("#"+tab_id_current).fadeIn(300);
            });
        });
    }

    /* --------------------------------------------------
    * Process
    * --------------------------------------------------*/
    var processTabs = function ($scope, $) {
        $scope.find('.ot-process').each(function(){
            var selector = $(this);
            selector.find('.ot-process__nav li').first().addClass('current');
            selector.find('.ot-process__des .process-des-item').hide();
            selector.find('.ot-process__des .process-des-item').first().show();
            selector.find('.ot-process__nav .ot-process__title').on( 'click', function(){
                if( !$(this).parent().hasClass('current')){
                    $(this).parents('.ot-process__nav').find('li').removeClass('current');
                    $(this).parent().addClass('current');
                    $(this).parents('.ot-process').find('.ot-process__des .process-des-item').hide();
                    var index = $(this).parent().index();
                    $(this).parents('.ot-process').find('.ot-process__des .process-des-item:eq(' + index + ')').fadeIn(300);
                }
            });
        });
    };

    /* --------------------------------------------------
    * video popup
    * --------------------------------------------------*/
    var videoPopup = function ($scope, $) {
        $scope.find('.ot-video-popup').each( function(){
            var selector = $(this),
                videoItem = selector.find('.octf-btn-play');
            selector.lightGallery({
                selector: videoItem,
            });
        });
    };

    /* --------------------------------------------------
    * Image Before After
    * --------------------------------------------------*/
    var otBeforeAfter = function ( $scope , $ ) {
        $scope.find('.twentytwenty-container').each( function(){
            var $selector       = $(this),
                orientation     = $selector.data('orientation'),
                before          = $selector.data('before'),
                after           = $selector.data('after'),
                before_size     = $selector.data('bsize');      
            $selector.twentytwenty({        
                default_offset_pct: before_size, 
                orientation: orientation, 
                before_label: before, 
                after_label: after, 
                no_overlay: false, 
                move_slider_on_hover: false, 
                move_with_handle_only: true, 
                click_to_move: true,
            });     
        }); 
    };

    /* --------------------------------------------------
    * Portfolio filter isotope
    * --------------------------------------------------*/

    function otIsotope() {
        $('.projects-masonry').each(function () {
            var $isotopeWrap = $(this);
            var properties = {
                itemSelector : '.project-item',
                animationEngine : 'css',
                layoutMode: 'masonry',
                percentPosition: true,
                masonry: {
                    columnWidth: '.grid-sizer'
                },
                isOriginLeft: rtl_isotop(),
                transitionDuration: '0.4s'
            };
            $isotopeWrap.imagesLoaded(function() {
                $isotopeWrap.isotope(properties);
                $isotopeWrap.isotope("layout");
            });
            otIsotopeFilterHandler(this);
            otLightGallery(this);
        });
        
    }

    function otLightGallery(self) {
        if( $(self).hasClass('image-popup-gallery') ){

            $(self).find('.project-item').each(function () {
                $(this).find('.projects-thumbnail > a').removeAttr("href");
            });
            $(self).lightGallery({
                selector: '.image-popup-gallery .projects-thumbnail, .image-popup-gallery .link_detail, .ot-gallery__item > a',
                share: false,
                pager: false,
                thumbnail: false,
            }); 
           
        }
    }

    function otIsotopeFilterHandler(self){
        var filterBtn = $(self).closest('.projects-filter-wrapper').find('.isotope-filter .filter-item');

        /* Filter Handler */
        filterBtn.on('click', function (e) {
            e.preventDefault();

            var $this = $(this);
            if ( $this.hasClass('active') ) {
                return;
            }
            $this.addClass('active').parent().siblings().find('a').removeClass('active');

            var dataFilter  = $this.attr('data-filter'),
                isotopeWrap = $this.closest('.projects-filter-wrapper').find('.projects-masonry');
            isotopeWrap.isotope({ 
                filter: dataFilter 
            });
        });
    }

    /* --------------------------------------------------
     * Image Before After Slider
     * --------------------------------------------------*/
    var otBeforeAfterSlider = function ($scope, $) {
        $scope.find('.image__before-after.ot-carousel').each( function () {
            var selector     = $(this);
            selector.find('.owl-carousel').owlCarousel({
                rtl: rtl_owl(),
                loop: false,
                margin: 0,
                responsiveClass: true,
                dots: true,
                nav: false,
                mouseDrag: false,
                touchDrag: false,
                responsive : {
                    0 : {
                        items: 1,
                    },
                    992 : {
                        items: 1,
                    }
                }
            });
        });
    };

    /* --------------------------------------------------
     * Testimonial Slider
     * --------------------------------------------------*/
    var testimonialSlider = function ($scope, $) {
        $scope.find('.ot-testimonial-carousel').each( function () {
            var selector     = $(this),
                sliderSettings = selector.data('slider_options');
                
            selector.find('.owl-carousel').owlCarousel({
                rtl: rtl_owl(),
                autoplay: 'yes' === sliderSettings.autoplay,
                autoplayTimeout: parseInt(sliderSettings.autoplay_time_out),
                loop: 'yes' === sliderSettings.loop,
                animateOut: 'yes' === sliderSettings.fade ? 'fadeOut' : '',
                mouseDrag: 'yes' === sliderSettings.fade ? false : true,
                responsiveClass:true,
                dots: sliderSettings.dots,
                nav: sliderSettings.arrows,
                autoplayHoverPause: true,
                navText: otNavText,
                navContainerClass: 'owl-nav nav-outside',
                smartSpeed: 500,
                dotsSpeed: 350,
                responsive : {
                    0 : {
                        items: parseInt(sliderSettings.slides_show_mobile),
                        margin: parseInt(sliderSettings.margin_mobile),
                    },
                    576 : {
                        items: parseInt(sliderSettings.slides_show_mobile_extra),
                        margin: parseInt(sliderSettings.margin_mobile_extra),
                    },
                    768 : {
                        items: parseInt(sliderSettings.slides_show_tablet),
                        margin: parseInt(sliderSettings.margin_tablet),
                    },
                    992 : {
                        items: parseInt(sliderSettings.slides_show_tablet_extra),
                        margin: parseInt(sliderSettings.margin_tablet_extra),
                    },
                    1200 : {
                        items: parseInt(sliderSettings.slides_show_laptop),
                        margin: parseInt(sliderSettings.margin_laptop),
                    },
                    1400 : {
                        items: parseInt(sliderSettings.slides_show_desktop),
                        margin: parseInt(sliderSettings.margin_desktop),
                    }
                }
            });
        });
    };

    /* --------------------------------------------------
     * Team Slider
     * --------------------------------------------------*/
    var teamSlider = function ($scope, $) {
        $scope.find('.ot-team-carousel').each( function () {
            var selector     = $(this),
                sliderSettings = selector.data('slider_options');
                
            selector.find('.owl-carousel').owlCarousel({
                rtl: rtl_owl(),
                autoplay: 'yes' === sliderSettings.autoplay,
                autoplayTimeout: parseInt(sliderSettings.autoplay_time_out),
                loop: 'yes' === sliderSettings.loop,
                responsiveClass:true,
                dots: sliderSettings.dots,
                nav: sliderSettings.arrows,
                autoplayHoverPause: true,
                navText: otNavText,
                navContainerClass: 'owl-nav nav-outside',
                smartSpeed: 500,
                dotsSpeed: 350,
                responsive : {
                    0 : {
                        items: parseInt(sliderSettings.slides_show_mobile),
                        margin: parseInt(sliderSettings.margin_mobile),
                    },
                    576 : {
                        items: parseInt(sliderSettings.slides_show_mobile_extra),
                        margin: parseInt(sliderSettings.margin_mobile_extra),
                    },
                    768 : {
                        items: parseInt(sliderSettings.slides_show_tablet),
                        margin: parseInt(sliderSettings.margin_tablet),
                    },
                    992 : {
                        items: parseInt(sliderSettings.slides_show_tablet_extra),
                        margin: parseInt(sliderSettings.margin_tablet_extra),
                    },
                    1200 : {
                        items: parseInt(sliderSettings.slides_show_laptop),
                        margin: parseInt(sliderSettings.margin_laptop),
                    },
                    1400 : {
                        items: parseInt(sliderSettings.slides_show_desktop),
                        margin: parseInt(sliderSettings.margin_desktop),
                    }
                }
            });
        });
    };

    /* --------------------------------------------------
     * Team Slider
     * --------------------------------------------------*/
    var imageBoxSlider = function ($scope, $) {
        $scope.find('.ot-image-box-carousel').each( function () {
            var selector     = $(this),
                sliderSettings = selector.data('slider_options');
                
            selector.find('.owl-carousel').owlCarousel({
                rtl: rtl_owl(),
                autoplay: 'yes' === sliderSettings.autoplay,
                autoplayTimeout: parseInt(sliderSettings.autoplay_time_out),
                loop: 'yes' === sliderSettings.loop,
                center: 'yes' === sliderSettings.center,
                responsiveClass:true,
                dots: sliderSettings.dots,
                nav: sliderSettings.arrows,
                autoplayHoverPause: true,
                navText: otNavText,
                navContainerClass: 'owl-nav nav-outside',
                smartSpeed: 500,
                dotsSpeed: 350,
                responsive : {
                    0 : {
                        items: parseInt(sliderSettings.slides_show_mobile),
                        margin: parseInt(sliderSettings.margin_mobile),
                    },
                    576 : {
                        items: parseInt(sliderSettings.slides_show_mobile_extra),
                        margin: parseInt(sliderSettings.margin_mobile_extra),
                    },
                    768 : {
                        items: parseInt(sliderSettings.slides_show_tablet),
                        margin: parseInt(sliderSettings.margin_tablet),
                    },
                    992 : {
                        items: parseInt(sliderSettings.slides_show_tablet_extra),
                        margin: parseInt(sliderSettings.margin_tablet_extra),
                    },
                    1200 : {
                        items: parseInt(sliderSettings.slides_show_laptop),
                        margin: parseInt(sliderSettings.margin_laptop),
                    },
                    1400 : {
                        items: parseInt(sliderSettings.slides_show_desktop),
                        margin: parseInt(sliderSettings.margin_desktop),
                    }
                }
            });
        });
    };

    /* --------------------------------------------------
     * Image Slider
     * --------------------------------------------------*/
    var clientsSlider = function ($scope, $) {
        $scope.find('.ot-image-carousel').each( function () {
            var selector     = $(this),
                sliderSettings = selector.data('slider_options');
                
            selector.find('.owl-carousel').owlCarousel({
                rtl: rtl_owl(),
                autoplay: 'yes' === sliderSettings.autoplay,
                autoplayTimeout: parseInt(sliderSettings.autoplay_time_out),
                loop: 'yes' === sliderSettings.loop,
                responsiveClass:true,
                dots: sliderSettings.dots,
                nav: sliderSettings.arrows,
                autoplayHoverPause: true,
                navText: otNavText,
                navContainerClass: 'owl-nav nav-outside',
                smartSpeed: 500,
                dotsSpeed: 350,
                responsive : {
                    0 : {
                        items: parseInt(sliderSettings.slides_show_mobile),
                        margin: parseInt(sliderSettings.margin_mobile),
                    },
                    576 : {
                        items: parseInt(sliderSettings.slides_show_mobile_extra),
                        margin: parseInt(sliderSettings.margin_mobile_extra),
                    },
                    768 : {
                        items: parseInt(sliderSettings.slides_show_tablet),
                        margin: parseInt(sliderSettings.margin_tablet),
                    },
                    992 : {
                        items: parseInt(sliderSettings.slides_show_tablet_extra),
                        margin: parseInt(sliderSettings.margin_tablet_extra),
                    },
                    1200 : {
                        items: parseInt(sliderSettings.slides_show_laptop),
                        margin: parseInt(sliderSettings.margin_laptop),
                    },
                    1400 : {
                        items: parseInt(sliderSettings.slides_show_desktop),
                        margin: parseInt(sliderSettings.margin_desktop),
                    }
                }
            });
            otLightGallery(this);
        });
    };

    // function otImageLightGallery(self) {
    //     if( $(self).hasClass('image-popup-gallery') ){
    //         $(self).lightGallery({
    //             selector: '.image-popup-gallery .link_detail',
    //             share: false,
    //             pager: false,
    //             thumbnail: false,
    //         }); 
    //     }
    // }

    /* --------------------------------------------------
    * Latest Post Slider
    * --------------------------------------------------*/
    var otPostSlider = function ($scope, $) {
        $scope.find('.ot-post-carousel').each( function () {
            var selector     = $(this),
                sliderSettings = selector.data('slider_options');
            selector.find('.owl-carousel').owlCarousel({
                rtl: rtl_owl(),
                autoplay: 'yes' === sliderSettings.autoplay,
                autoplayTimeout: parseInt(sliderSettings.autoplay_time_out),
                loop: 'yes' === sliderSettings.loop,
                responsiveClass:true,
                dots: sliderSettings.dots,
                nav: sliderSettings.arrows,
                autoplayHoverPause: true,
                navText: otNavText,
                navContainerClass: 'owl-nav nav-outside',
                smartSpeed: 500,
                dotsSpeed: 350,
                responsive : {
                    0 : {
                        items: parseInt(sliderSettings.slides_show_mobile),
                        margin: parseInt(sliderSettings.margin_mobile),
                    },
                    576 : {
                        items: parseInt(sliderSettings.slides_show_mobile_extra),
                        margin: parseInt(sliderSettings.margin_mobile_extra),
                    },
                    768 : {
                        items: parseInt(sliderSettings.slides_show_tablet),
                        margin: parseInt(sliderSettings.margin_tablet),
                    },
                    992 : {
                        items: parseInt(sliderSettings.slides_show_tablet_extra),
                        margin: parseInt(sliderSettings.margin_tablet_extra),
                    },
                    1200 : {
                        items: parseInt(sliderSettings.slides_show_laptop),
                        margin: parseInt(sliderSettings.margin_laptop),
                    },
                    1400 : {
                        items: parseInt(sliderSettings.slides_show_desktop),
                        margin: parseInt(sliderSettings.margin_desktop),
                    }
                }
            });
        });
    };

    /* --------------------------------------------------
    * Projects Slider
    * --------------------------------------------------*/
    var projectsSlider = function ($scope, $) {
        $scope.find('.ot-project-carousel').each( function () {
            var selector     = $(this),
                sliderSettings = selector.data('slider_options');
            selector.find('.owl-carousel').owlCarousel({
                rtl: rtl_owl(),
                autoplay: 'yes' === sliderSettings.autoplay,
                autoplayTimeout: parseInt(sliderSettings.autoplay_time_out),
                loop: 'yes' === sliderSettings.loop,
                responsiveClass:true,
                dots: sliderSettings.dots,
                nav: sliderSettings.arrows,
                autoplayHoverPause: true,
                navText: otNavText,
                smartSpeed: 500,
                dotsSpeed: 350,
                responsive : {
                    0 : {
                        items: parseInt(sliderSettings.slides_show_mobile),
                        margin: parseInt(sliderSettings.margin_mobile),
                    },
                    576 : {
                        items: parseInt(sliderSettings.slides_show_mobile_extra),
                        margin: parseInt(sliderSettings.margin_mobile_extra),
                    },
                    768 : {
                        items: parseInt(sliderSettings.slides_show_tablet),
                        margin: parseInt(sliderSettings.margin_tablet),
                    },
                    992 : {
                        items: parseInt(sliderSettings.slides_show_tablet_extra),
                        margin: parseInt(sliderSettings.margin_tablet_extra),
                    },
                    1200 : {
                        items: parseInt(sliderSettings.slides_show_laptop),
                        margin: parseInt(sliderSettings.margin_laptop),
                    },
                    1400 : {
                        items: parseInt(sliderSettings.slides_show_desktop),
                        margin: parseInt(sliderSettings.margin_desktop),
                    }
                }
            });
            otLightGallery(this);
        });
    };

    /* --------------------------------------------------
     * counter
     * --------------------------------------------------*/
    var otCounter = function () {
        $('.ot-counter-wrapper[data-counter]').each( function () {
            var scrollTop   = $(document).scrollTop() + $(window).height();
            var counter     = $(this).find('span.ot-counter__num'),
                countTo     = counter.attr('data-to'),
                during      = parseInt( counter.attr('data-time') );

            if ( scrollTop > counter.offset().top + counter.height() ) {
                $(this).removeAttr('data-counter');
                $({
                    countNum: counter.text()
                }).animate({
                    countNum: countTo
                },
                {
                    duration: during,
                    easing: 'swing',
                    step: function() {
                        counter.text(Math.floor(this.countNum));
                    },
                    complete: function() {
                        counter.text(this.countNum);
                    }
                });
            }
        });
    };

    function otIsotope() {
        $('.projects-masonry').each(function () {
            var $isotopeWrap = $(this);
            var properties = {
                itemSelector : '.project-item',
                animationEngine : 'css',
                layoutMode: 'masonry',
                percentPosition: true,
                masonry: {
                    columnWidth: '.grid-sizer'
                },
                isOriginLeft: rtl_isotop(),
                transitionDuration: '0.4s'
            };
            $isotopeWrap.imagesLoaded(function() {
                $isotopeWrap.isotope(properties);
                $isotopeWrap.isotope("layout");
            });
            otIsotopeFilterHandler(this);
            otLightGallery(this);
        });
        
    }
    function otGallery() {
        $('.ot-gallery').each(function () {
            var $isotopeWrap = $(this);
            var properties = {
                itemSelector : '.ot-gallery__item',
                animationEngine : 'css',
                layoutMode: 'masonry',
                percentPosition: true,
                masonry: {
                    columnWidth: '.grid-sizer'
                },
                isOriginLeft: rtl_isotop(),
                transitionDuration: '0.4s'
            };
            $isotopeWrap.imagesLoaded(function() {
                $isotopeWrap.isotope(properties);
                $isotopeWrap.isotope("layout");
            });
            otLightGallery(this);
        });
    }

    /* --------------------------------------------------
     * Text Slider Marquee
     * --------------------------------------------------*/
    var textSliderMarquee = function ($scope, $) {
        $scope.find('.ot-text-marquee').each( function () {
            var swiperContainer  = $(this),
                sliderSettings = swiperContainer.data('slider_options');

            var config = {
                spaceBetween: 0,
                centeredSlides: true,
                speed: parseInt(sliderSettings.data_speed),
                autoplay: {
                    delay: 1,
                    disableOnInteraction: false,
                    reverseDirection: 'yes' === sliderSettings.data_reverse,
                    pauseOnMouseEnter: false
                },
                loop: true,
                slidesPerView:'auto',
                allowTouchMove: false,
                disableOnInteraction: true
            }

            /*Swiper Init*/
            OTInitSwiper( swiperContainer, config );
        });
    };

    /* --------------------------------------------------
     * Portfolio Creative Carousel
     * --------------------------------------------------*/
    var portfolioCreativeCarousel = function ($scope, $) {
        $scope.find('.ot-project-creative-carousel').each( function () {
            var swiperContainer  = $(this),
                sliderSettings = swiperContainer.data('slider_options'),
                itemID = swiperContainer.data('item-slider') ? '[data-slider="' + swiperContainer.data('item-slider') + '"]' : '';

            var config = {
                effect: sliderSettings.slide_type,
                grabCursor: true,
                centeredSlides: true,
                speed: Number(sliderSettings.data_speed),
                coverflowEffect: {
                    rotate: 0,
                    stretch: 0,
                    depth: 100,
                    modifier: 3,
                    slideShadows: true
                },
                autoplay: {
                    delay: Number(sliderSettings.autoplay_time_out),
                    disableOnInteraction: false,
                    reverseDirection: 'yes' === sliderSettings.data_reverse,
                    pauseOnMouseEnter: false
                },
                loop: 'yes' === sliderSettings.loop,
                pagination: {
                    el: '.octf-swiper-pagination' + itemID,
                    clickable: true
                },
                navigation: {
                    nextEl: '.octf-swiper-button-next' + itemID,
                    prevEl: '.octf-swiper-button-prev' + itemID,
                },
                breakpoints: {
                    0: {
                        slidesPerView: Number(sliderSettings.slides_show_mobile),
                        spaceBetween: Number(sliderSettings.margin_mobile)
                    },
                    576: {
                        slidesPerView: Number(sliderSettings.slides_show_mobile_extra),
                        spaceBetween: Number(sliderSettings.margin_mobile_extra)
                    },
                    768: {
                        slidesPerView: Number(sliderSettings.slides_show_tablet),
                        spaceBetween: Number(sliderSettings.margin_tablet)
                    },
                    992: {
                        slidesPerView: Number(sliderSettings.slides_show_tablet_extra),
                        spaceBetween: Number(sliderSettings.margin_tablet_extra)
                    },
                    1200: {
                        slidesPerView: Number(sliderSettings.slides_show_laptop),
                        spaceBetween: Number(sliderSettings.margin_laptop)
                    },
                    1400: {
                        slidesPerView: Number(sliderSettings.slides_show_desktop),
                        spaceBetween: Number(sliderSettings.margin_desktop)
                    }
                },
            }
            /*Swiper Init*/
            OTInitSwiper( swiperContainer, config );
            otLightGallery(this);
        });
    };

    function OTInitSwiper(swiperContainer, config, elementorFrontend = false) {
        if ( 'undefined' === typeof Swiper ) {
            const asyncSwiper = window.elementorFrontend.utils.swiper;
            new asyncSwiper( swiperContainer, config ).then( ( newSwiperInstance ) => {
                var mySwiper = newSwiperInstance;
            });
        } else {
            var mySwiper = new Swiper( swiperContainer, config );
        }
    }

    var bgServiceBoxImage = function ($scope, $) {
        $scope.find('.ot-service-box-image').each( function () {
            var selector    = $(this),
                bgImage     = selector.find('.bg-image'),
                bgImageValue = bgImage.data('bgimage');
            bgImage.css({
                'background-image' : bgImageValue
            });
        });
    };

    /* --------------------------------------------------
     * Typed String
     * --------------------------------------------------*/
    var otTyped = function () {
        $('.typed-wrap').each( function () {
            var selector    = $(this),
                typed       = selector.find('.typed'),
                typedString = selector.find('.typed-strings'),
                loop        = selector.data('loop'),
                speed       = selector.data('speed'),
                delay       = selector.data('delay');

            typed.typed({
                stringsElement: typedString,
                typeSpeed: speed,
                backDelay: delay,
                loop: loop,
                contentType: 'html', // or text
                // defaults to false for infinite loop
                loopCount: false,
                callback: function () { null; },
                resetCallback: function () { newTyped(); }
            });
        });
    };

    /* --------------------------------------------------
    * Countdown for coming soon
    * --------------------------------------------------*/
    var otCountDown = function($scope, $){
        $scope.find('.ot-countdown').each( function(){
            var selector = $(this),
                date     = selector.data('date'),
                zone     = selector.data('zone'),
                day      = selector.data('day'),
                days     = selector.data('days'),
                hour     = selector.data('hour'),
                hours    = selector.data('hours'),
                min      = selector.data('min'),
                mins     = selector.data('mins'),
                second   = selector.data('second'),
                seconds  = selector.data('seconds');
            selector.countdown({
                date: date,
                offset: zone,
                day: day,
                days: days,
                hour: hour,
                hours: hours,
                minute: min,
                minutes: mins,
                second: second,
                seconds: seconds
            }, function () {
                alert('Done!');
            });
        });
    };

    /* --------------------------------------------------
    * Button Popup
    * --------------------------------------------------*/
    var otButtonPopup = function($scope, $){
        $scope.find('.ot-btn-popup').each( function(){
            var selector        = $(this),
                btnUp           = selector.find('.octf-btn-popup-up'),
                btnDown         = selector.find('.octf-btn-popup-down'),
                popupContent    = selector.find('.hide-content');

            btnUp.on("click", function () {
                popupContent.fadeIn(600, function () {
                    btnUp.animate({ 'bottom': '-40px' }, "slow");
                    btnDown.animate({ 'top': '0px' }, "slow");
                    $('html').css({
                        'overflow' : 'hidden',
                    });
                });
            });

            btnDown.on("click", function () {
                popupContent.fadeOut("slow", function () {
                    btnUp.animate({ 'bottom': '0px' }, "slow");
                    btnDown.animate({ 'top': '-40px' }, "slow");
                    $('html').css({
                        'overflow' : 'initial',
                    });
                });
            });
        });
    };

    /* --------------------------------------------------
    * handle after scroll/load/resize
    * --------------------------------------------------*/
    $(window).on('scroll', function() {
        progressBar();
        otCounter();
    });
    $(window).on('load', function () {
        progressBar();
        otCounter();
        otIsotope();
        otGallery();
    });
    $(window).on('resize', function () {

    });

    /**
     * Elementor JS Hooks
     */
    $(window).on("elementor/frontend/init", function () {
        /*toggle search*/
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/ot-btn-popup.default",
            otButtonPopup
        );
        /*toggle search*/
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/ot-search.default",
            otSearch
        );
        /*mmenu*/
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/ot-menu-mobile.default",
            otMenuMobile
        );
        /*Video Popup*/
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/ot-video-popup.default",
            videoPopup
        );
        /*Progress bar*/
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/ot-progress-bars.default",
            progressBar
        );
        /* Accordions */
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/ot-accordions.default",
            otAccordions
        );
        /* Custom tabs */
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/ot-tabs.default",
            otTabs
        );
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/ot-big-tabs.default",
            otBigTabs
        );
        /*Process tabs*/
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/ot-process-tabs.default",
            processTabs
        );
        /*Image Before After*/
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/ot-before-after.default",
            otBeforeAfter
        );
        /*Image Before After Carousel*/
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/ot-before-after-carousel.default",
            otBeforeAfter
        );
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/ot-before-after-carousel.default",
            otBeforeAfterSlider
        );
        /* Testimonial carousel */
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/ot-testimonials-carousel.default",
            testimonialSlider
        );
        /* Testimonial carousel with title */
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/ot-testimonials-carousel-with-title.default",
            testimonialSlider
        );
        /* Testimonial carousel with rate */
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/ot-testimonials-with-rate-carousel.default",
            testimonialSlider
        );
        /* Clients carousel */
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/ot-image-slider.default",
            clientsSlider
        );
        /* Post carousel */
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/ot-posts-carousel.default",
            otPostSlider
        );
        /* Counter */
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/ot-counter.default",
            otCounter
        );
        /* Team carousel */
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/ot-team-slider.default",
            teamSlider
        );
        /* Image Box carousel */
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/ot-image-box-carousel.default",
            imageBoxSlider
        );
        /* Project carousel */
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/ot-portfolio-carousel.default",
            projectsSlider
        );
        /* Project creative carousel */
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/ot-portfolio-creative-carousel.default",
            portfolioCreativeCarousel
        );
        /* Text Marquee */
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/ot-text-slider-marquee.default",
            textSliderMarquee
        );
        /* Text Animation Typed */
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/ot-text-animation.default",
            otTyped
        );
        /* Countdown */
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/ot-countdown.default",
            otCountDown
        );
        /* Menu Hamburger*/
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/ot-menu-hamburger.default",
            hamburgerMenu
        );
        /*menu vertical*/
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/ot-menu.default",
            menuVertical
        );
        /*Service box Image*/
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/ot-service-box-image.default",
            bgServiceBoxImage
        );

        if ( window.elementorFrontend.isEditMode() ) {
            /* Portfolio filter isotop */
            window.elementorFrontend.hooks.addAction(
                "frontend/element_ready/ot-portfolio-filter.default",
                function () {
                    otIsotope();
                }
            );
            window.elementorFrontend.hooks.addAction(
                "frontend/element_ready/ot-portfolio-creative-filter.default",
                function () {
                    otIsotope();
                }
            );
            window.elementorFrontend.hooks.addAction(
                "frontend/element_ready/ot-image-gallery.default",
                function () {
                    otGallery();
                }
            );
        }
    });

} )( jQuery );