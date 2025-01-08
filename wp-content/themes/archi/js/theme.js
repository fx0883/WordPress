( function( $ ) {
    'use strict';

    /* rtl check */
	function rtl_owl(){
	if ($('body').hasClass("rtl")) {
		return true;
	} else {
		return false;
	}};

	$(document).ready( function() {

		/* jPreloader */
		if( $("body:not(.elementor-editor-active)").hasClass("archi-jPreLoader") ){
			$(this).jpreLoader({
	            splashID: "#jSplash",
	        });
		}else{
	        $('body').css("display","block");
	    }
	    /*End of jPreloader script*/

		/* --------------------------------------------------
	    * init
	    * --------------------------------------------------*/
		function init_de() {

	        var $window = $(window);
	        $('div[data-type="background"]').each(function () {
	            var $bgobj = $(this);

	            $(window).scroll(function () {
	                enquire.register("screen and (min-width: 992px)", {
	                    match: function () {
	                        var yPos = -($window.scrollTop() / $bgobj.data('speed'));
	                        var coords = '50% ' + yPos + 'px';
	                        $bgobj.css({ backgroundPosition: coords });
	                    }
	                });
	            });
	        });        

	    }
	    init_de();

	    /* --------------------------------------------------
        * Function header bottom begin
        * --------------------------------------------------*/
        var headerBottom = $('.site-header.header-bottom');

        function otHeaderBottomLoad() {
            var mq = window.matchMedia("(min-width: 992px)"),
                $document = $(document),
                header_height = parseInt(headerBottom.height(), 10),
                screen_height = parseInt($(window).height(), 10),
                header_mt = screen_height - header_height;

            window.addEventListener('scroll', function(e){
                if (mq.matches) {
                    var $document = $(document),
                        header_height = parseInt(headerBottom.height(), 10),
                        screen_height = parseInt($(window).height(), 10),
                        header_mt = screen_height - header_height;

                    if ($document.scrollTop() >= header_mt) {
                        headerBottom.css("position", "fixed");
                        headerBottom.css("top", "0");
                    } else if ($document.scrollTop() <= header_mt) {
                        headerBottom.css("position", "absolute");
                        headerBottom.css("top", header_mt);
                    }
                }
            });
            if (mq.matches) {
                headerBottom.css('position', 'absolute');
                headerBottom.css('top', header_mt);
            }
        }

        function otHeaderBottomResize() {
            var mq = window.matchMedia("(max-width: 991px)");
            if (mq.matches) {
                headerBottom.css("position", "relative");
                headerBottom.css("top", "0");
            }
        }

        /* Function header bottom close */

        /* --------------------------------------------------
        * Function header autoshow begin
        * --------------------------------------------------*/
        var headerAutoshow = $('.site-header.header-autoshow');

	    function otHeaderAutoshow() {

	        var mq = window.matchMedia("(min-width: 992px)");

	        window.addEventListener('scroll', function (e) {

	            if (mq.matches) {

	                /* header autoshow on scroll begin */
	                var $document = $(document),
	                	vscroll = 0;

	                if ($document.scrollTop() >= 50 && vscroll == 0) {
	                    headerAutoshow.removeClass("scrollOff");
	                    headerAutoshow.addClass("scrollOn is-stuck");
	                    vscroll = 1;
	                } else {
	                    headerAutoshow.removeClass("scrollOn is-stuck");
	                    headerAutoshow.addClass("scrollOff");
	                    vscroll = 0;
	                }
	                /*header autoshow on scroll close*/
	                
	            }
	        });

	    }

	    function customBg() {
			$(".blog-grid.poster .d-image").css('background-image', function() {
				return $(this).data('bgimage');
			});
		}

	    var target = $('.center-y');
        var targetHeight = target.outerHeight();

	    /* Function header autoshow close */

	    $(window).on('load', function () {
	    	if( headerAutoshow.length > 0 ){
                otHeaderAutoshow();
            }
            if( headerBottom.length > 0 ){
                otHeaderBottomLoad();
            }
            $(".ot-jarallax").jarallax();
            $.letItSnow('.let-it-snow', {
	            stickyFlakes: 'lis-flake--js',
	            makeFlakes: true,
	            sticky: true
	        });
	        customBg();
	    });
	    $(window).on('resize', function () {
	    	if( headerAutoshow.length > 0 ){
                otHeaderAutoshow();
            }
	    	if( headerBottom.length > 0 ){
                otHeaderBottomResize();
            }
	    });

		/* --------------------------------------------------
	    * Window Scroll
	    * --------------------------------------------------*/
		$(window).on("scroll", function(){

			/* Sticky header */
			var site_header = $('#site-header').outerHeight() + 1;	
				
			if ($(window).scrollTop() >= site_header) {	    	
				$('.site-header.header-fixed').addClass('is-stuck');
			}else {
				$('.site-header.header-fixed').removeClass('is-stuck');
			}

			/* Scroll Fade Text */
			var scrollPercent = (targetHeight - window.scrollY) / targetHeight;
            if (scrollPercent >= 0) {
                target.css('opacity', scrollPercent);
            }
		});

	    /* --------------------------------------------------
	    * mobile menu
	    * --------------------------------------------------*/
	    $('.mmenu_wrapper li:has(ul)').prepend('<span class="arrow"><i class="fa fa-angle-down"></i></span>');
	    $(".mmenu_wrapper .mobile_mainmenu > li span.arrow").on('click',function() {
	        $(this).parent().find("> ul").stop(true, true).slideToggle()
	        $(this).toggleClass( "active" );
	    });
		
		$( "#mmenu_toggle" ).on('click', function() {
			$(this).toggleClass( "active" );
			$(this).parents('.header-mobile').toggleClass( "open" );
			if ($(this).hasClass( "active" )) {
				$('.mobile_nav').stop(true, true).slideDown(300);
			}else{
				$('.mobile_nav').stop(true, true).slideUp(150);
			}		
		});

		/* --------------------------------------------------
	    * gallery post
	    * --------------------------------------------------*/
		var galleryPost = $('.gallery-post');
		if (galleryPost.length > 0 ) {
			galleryPost.each( function () {
				var selector = $(this).find('.owl-carousel');
				selector.owlCarousel({
					rtl: rtl_owl(),
					autoplay:true,
					autoplayTimeout: 7000,
					loop:true,
					margin:0,
					responsiveClass:true,
					dots: true,
					nav: false,
	            	navText: ['<i class="ot-flaticon-right-arrows"></i>','<i class="ot-flaticon-right-arrows"></i>'],
					responsive : {
	                    0 : {
	                        items: 1,
	                    },
	                    768 : {
	                        items: 1,
	                    },
	                    1024 : {
	                        items: 1,
	                    }
	                }
				});
			});
		}

		/* --------------------------------------------------
		 * Related Slider posts
		 * --------------------------------------------------*/
	  	$('.related-posts .slide-posts').each( function () {
	    	var selector = $(this);
	    	selector.owlCarousel({
		      	rtl: rtl_owl(),
		      	autoplay:true,
				autoplayTimeout: 7000,
		      	loop: false,
		      	margin: 30,
		      	responsiveClass: true,
		      	dots: true,
		      	nav: false,
		      	responsive : {
			        0 : {
			          	items: 1,
			        },
			        992 : {
			          	items: 2,
			        }
	      		}
	    	});
		});

		/* --------------------------------------------------
	    * Related Slider projects
	    * --------------------------------------------------*/
	    $('.project-related-posts').each( function () {
	        var selector = $(this);
	        selector.find('.owl-carousel').owlCarousel({
	            rtl: rtl_owl(),
	            autoplay:true,
				autoplayTimeout: 7000,
	            loop: false,
	            margin: 30,
	            navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
	            navContainerClass: 'owl-nav nav-outside',
	            dots: true,
	            nav: false,
	            responsive : {
	                0 : {
			          	items: 1,
			        },
			        992 : {
			          	items: 3,
			        }
	            }
	        });
	    });
		
	   	/*Popup Video*/
	    var video_popup = $('.video-popup');
	    if (video_popup.length > 0 ) {
	        video_popup.each( function(){
	            $(this).lightGallery({
	                selector: '.video-popup > a',
	            });
	        } )
	    }

	    /* --------------------------------------------------
	    * back to top
	    * --------------------------------------------------*/
	    if ($('#back-to-top').length) {
		    var scrollTrigger = 500,
		        backToTop = function () {
		            var scrollTop = $(window).scrollTop();
		            if (scrollTop > scrollTrigger) {
		                $('#back-to-top').addClass('show');
		            } else {
		                $('#back-to-top').removeClass('show');
		            }
		        };
		    backToTop();
		    $(window).on('scroll', function () {
		        backToTop();
		    });
		    $('#back-to-top').on('click', function (e) {
		        e.preventDefault();
		        $('html,body').animate({
		            scrollTop: 0
		        }, 700);
		    });	
		}
	});

} )( jQuery );
