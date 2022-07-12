/**
 * General.js
 *
 * contains the theme functionalities 
 */

jQuery.noConflict();
var get_scroll = 0;

function zozo_InitJs() {
    zozo_ParallaxScroll();
	jQuery(document).trigger("zozo_InitJs");
}

window.zozoParallaxSkroll = false;
"function" != typeof window.zozo_ParallaxScroll && ( window.zozo_ParallaxScroll = function() {
	function ZozoParallaxTitleBar() {
		var zozoSkrollrOptions, zozocallSkrollInit = false;
		
		if( window.zozoParallaxSkroll ) {
			window.zozoParallaxSkroll.destroy();
		}
		$( '.zozo_parallax-inner' ).remove();
		
		$( '[data-zozo-parallax]' ).each( function () {
			var skrollrSpeed,
				skrollrSize,
				skrollrStart,
				skrollrEnd,
				$parallaxElement,
				parallaxImage,
				parallaxPos;
				
			zozocallSkrollInit = true; // Enable skrollinit;

			skrollrSize = $( this ).data( 'zozoParallax' ) * 100;
			$parallaxElement = $( '<div />' ).addClass( 'zozo_parallax-inner' ).appendTo( $( this ) );
			$parallaxElement.css( 'height', skrollrSize + '%' );

			parallaxImage = $( this ).data( 'zozoParallaxImage' );
			parallaxPos = $( this ).data( 'zozoParallaxPosition' );
			
			if ( 'undefined' !== typeof(parallaxImage) ) {
				$parallaxElement.css( 'background-image', 'url(' + parallaxImage + ')' );
			}

			skrollrSpeed = skrollrSize - 100;
			skrollrStart = - skrollrSpeed;
			skrollrEnd = 0;
			
			if( parallaxPos == 'left top' || parallaxPos == 'right top' || parallaxPos == 'center top' || parallaxPos == 'left center' || parallaxPos == 'right center' ) {
				$parallaxElement.css( 'bottom', '0px' );
				$parallaxElement.attr( 'data-center', 'top: 0%;' );
				$parallaxElement.attr( 'data-bottom-top', 'top: ' + skrollrEnd + '%;' ).attr( 'data-top-bottom', 'top: ' + skrollrStart + '%;' );
			} 
			else if( parallaxPos == 'center bottom' || parallaxPos == 'left bottom' || parallaxPos == 'right bottom' ) {
				$parallaxElement.css( 'bottom', '0px' );
				$parallaxElement.attr( 'data-center', 'bottom: 0%;' );
				$parallaxElement.attr( 'data-bottom-top', 'bottom: ' + skrollrEnd + '%;' ).attr( 'data-top-bottom', 'bottom: ' + skrollrStart + '%;' );
			}
			else if( parallaxPos == 'center center' ) {
				$parallaxElement.css( 'top', '0px' );
				$parallaxElement.attr( 'data-bottom-top', 'top: ' + skrollrStart + '%;' ).attr( 'data-top-bottom', 'top: ' + skrollrEnd + '%;' );
			}
		} );
		
		if( ! $('body').find('[data-vc-parallax]').hasClass('vc_parallax') ) {
			if( zozocallSkrollInit && window.skrollr ) {
				zozoSkrollrOptions = {
					forceHeight: false,
					smoothScrolling: false,
					mobileCheck: function () {
						return false;
					}
				};
				window.zozoParallaxSkroll = skrollr.init( zozoSkrollrOptions );
				return window.zozoParallaxSkroll;
			}
			return false;
		}
		return false;
	}
	
	var $ = window.jQuery;
	ZozoParallaxTitleBar();
});

jQuery(window).scroll(function() {
	"use strict";
	
	get_scroll = jQuery(window).scrollTop();
});

jQuery(window).load(function() {	
	
	jQuery('body').find(".pageloader").delay(1000).fadeOut("slow");
	
	/* ======================================
	Scroll to Section if Hash exists
	====================================== */
	if( window.location.hash ) {
		setTimeout ( function () {
			jQuery.scrollTo( window.location.hash, 2000, { easing: 'easeInOutExpo', offset: 0, "axis":"y" } );
		}, 400 );
	}	
	
	if( jQuery(".header-section").hasClass( 'type-header-9' ) ) {
		jQuery(".header-section.type-header-9 .header-toggle-section").mCustomScrollbar({
			setHeight: false,
			scrollButtons: {enable:true},
			theme: "minimal",
			scrollbarPosition: "inside",
			mouseWheel:{ scrollAmount: 500 }
		});
	}
	
	zozo_initBlogInfiniteScroll();
	
});

jQuery(window).resize(function() {
	zozo_MegaMenuHeight();
	zozo_SideMegaMenu();
	zozo_CircleRSliderInit();
	zozo_FooterHeight();	
});

jQuery(document).ready(function($) {
								
	window.zozo_InitJs();
	
	$('.zo-tooltip').tooltip({
		animation: true
	});
	
	/* =============================
	Active Scrollspy Navigation
	============================= */
	(function($) {
		"use strict";
				
		$('.main-nav, .main-right-nav').each(function() {
			$(this).find('a[href]').each(function(i,a){
				var $a = $(a);
				var href = $a.attr('href');
				var target;
				
				// Get Splitted ID from page's URI in href tag
				target = href.substring(href.indexOf('#') + 1); 
				
				// update anchors TARGET with new one
				if(target.indexOf('section-') == 0) {  
					$a.attr('data-target', '#' + target);
				} else {
					$a.addClass('external-link');
				}
							
			});
		});
		
		if( $('body').hasClass('header-is-sticky') ) {
			if( $(".header-section").hasClass( 'type-header-4' ) || $(".header-section").hasClass( 'type-header-5' ) || $(".header-section").hasClass( 'type-header-6' ) || $(".header-section").hasClass( 'type-header-11' ) ) {
				var sticky_height = zozo_js_vars.zozo_sticky_height_alt;
			} else {
				var sticky_height = zozo_js_vars.zozo_sticky_height;
			}
			
			var scroll_offset = sticky_height.match(/\d+/);
			
			if( scroll_offset !== null && scroll_offset != 0 ) {
				scroll_offset = scroll_offset - 2;
			}
		} else {
			var scroll_offset = -2;
		}
		
		if(Modernizr.mq('only screen and (max-width: 767px)')) {
			if( $('body').hasClass('header-mobile-un-sticky') ) {
				var scroll_offset = -2;
			}
		}
		
		$('.main-nav, .main-right-nav').onePageNav({
			currentClass: 'active',
			filter: ':not(.external-link)',
			scrollSpeed: 1100,
			scrollOffset: scroll_offset,
			scrollThreshold: 0.1,
			easing: 'easeInOutExpo',
		});
		
		$('.hidden-xs .main-nav').each(function() {
			$(this).find('ul.navbar-nav > li.menu-item-language').each(function() {
				if( $(this).find('ul.sub-menu').hasClass('submenu-languages') ) {
					$(this).addClass('dropdown');
					$(this).find('> a').addClass('dropdown-toggle');
					$(this).find('ul.sub-menu').addClass('dropdown-menu');
				}
			});
		});
			
		$('.visible-xs .main-nav').each(function() {
			$(this).find('ul.navbar-nav > li.menu-item-language').each(function() {
				var target_class = 'collapse-icl-languages';
				if( $(this).find('ul.sub-menu').hasClass('submenu-languages') ) {
					$(this).find('ul.sub-menu').addClass('mobile-sub-menu collapse ' + target_class);
					
					var toggler_data = '<span data-target=".'+ target_class +'" data-toggle="collapse" class="menu-toggler"><i class="fa fa-angle-down"></i></span>';
					$(this).find('ul.sub-menu.submenu-languages').before( toggler_data );
				}
			});
		});
		
		$( '.smoothscroll, .smoothscroll > a' ).on('click', function() {
			$('html, body').animate({
				scrollTop: $( $(this).attr('href') ).offset().top - scroll_offset
			}, 1100);
			return false;
		});
		
		$( '.zozo-fit-video' ).fitVids();
		
	})(jQuery);
	
	(function($) {
		"use strict";		
		$('.vc-normal-section').each(function() {
			if( $(this).hasClass('vc-match-height-row') ) {				
				if( ! ( $(this).find('.wpb_column.vc_main_column.vc_column_container').hasClass( 'vc-match-height-content' ) ) ) {
					$(this).find('.wpb_column.vc_main_column.vc_column_container').addClass( 'vc-match-height-content' );
				}
			}
		});
		
		$('.vc-inner-row-section').each(function() {
			if( $(this).hasClass('vc-match-height-inner-row') ) {
				if( ! ( $(this).find('.wpb_column.vc_column_inner.vc_column_container').hasClass( 'vc-inner-match-height-content' ) ) ) {
					$(this).find('.wpb_column.vc_column_inner.vc_column_container').addClass( 'vc-inner-match-height-content' );
				}
			}
		});
		
		/* ======================== Match Height ======================== */
		if(Modernizr.mq('only screen and (min-width: 768px)')) { 
			$('.vc-match-height-row').each(function() {
				$(this).find( '.vc-match-height-content' ).matchHeight({ byRow: true });
				if( $(this).find( '.vc-match-height-content' ).hasClass( 'vc-zozo-video-wrapper' ) ) {
					var height = $(this).find( '.vc-match-height-content' ).height();
					$(this).find( '.vc-match-height-content .video-bg' ).css({ height: height + 'px' });
					$(this).find( '.vc-match-height-content .video-bg .zozo-yt-player' ).css({ height: height + 'px' });
				}
			});
			
			$('.vc-match-height-inner-row').each(function() {
				$(this).find( '.vc-inner-match-height-content' ).matchHeight({ byRow: true });
			});
		}
		
		if(Modernizr.mq('only screen and (max-width: 767px)')) {
			$('.vc-match-height-row').each(function() {
				$(this).find( '.vc-match-height-content' ).matchHeight({ byRow: false });
				if( $(this).find( '.vc-match-height-content' ).hasClass( 'vc-zozo-video-wrapper' ) ) {
					var height = $(this).find( '.vc-match-height-content' ).height();
					$(this).find( '.vc-match-height-content .video-bg' ).css({ height: height + 'px' });
					$(this).find( '.vc-match-height-content .video-bg .zozo-yt-player' ).css({ height: height + 'px' });
				}
			});
			
			$('.vc-match-height-inner-row').each(function() {
				$(this).find( '.vc-inner-match-height-content' ).matchHeight({ byRow: false });
			});
		}
		
	})(jQuery);
	
	// Megamenu
	zozo_MegaMenuHeight();
	zozo_SideMegaMenu();
	// Secondary Menu
	zozo_initSecondaryMenu();
	// Portfolio Grid
	zozo_initPortfolioGrid();
	// Blog Grid
	zozo_initBlogGrid();
	zozo_initBlogSlider();
	// Tweets Widget Slider
	zozo_Tweets_Slider();
	// Circle Counter
	zozo_CircleRSliderInit();
	zozo_initCircleCounter();
	// Woocommerce Ajax Cart
	zozo_initCartAjaxRemoveItem();
	zozo_FooterHeight();	
	
	(function($) {
		"use strict";
		
		/* =======================
		Sliding Navigation
		======================= */
		$(".header-section.type-header-9 .header-side-wrapper #nav-side-menu").on('click', function(e) {
			e.preventDefault();
			$(this).parents('.header-section.type-header-9').find(".header-toggle-section.header-position-right").animate({ right: '0px' }, "slow");
			$(this).parents('.header-section.type-header-9').find(".header-toggle-section.header-position-left").animate({ left: '0px' }, "slow");
			return false;
		});
		
		$(".header-section.type-header-9 .header-toggle-section #nav-close-menu").on('click', function(e) {
			e.preventDefault();
			var side_wrapper_width = $(this).parents('.header-section.type-header-9').find(".header-toggle-section").width();
			$(this).parents('.header-section.type-header-9').find(".header-toggle-section.header-position-right").animate({ right: '-' + side_wrapper_width + 'px' }, "slow");
			$(this).parents('.header-section.type-header-9').find(".header-toggle-section.header-position-left").animate({ left: '-' + side_wrapper_width + 'px' }, "slow");
			return false;
		});
		
		/* =======================
		Sticky Header
		======================= */
		
		if( $('body').hasClass('header-is-sticky') ) {
			$("#header-main").sticky({
				topSpacing:0,
				wrapperClassName: 'header-sticky'
			});
			
			if( $(".header-section").hasClass( 'type-header-4' ) || $(".header-section").hasClass( 'type-header-5' ) || $(".header-section").hasClass( 'type-header-6' ) || $(".header-section").hasClass( 'type-header-11' ) ) {
				$('#header-main').on('sticky-start', function() {
					var sticky_height = zozo_js_vars.zozo_sticky_height_alt;
					$('#header-main').parent('.header-sticky').css({ "min-height": sticky_height, "height": "auto" });
				});
			} else {
				$('#header-main').on('sticky-start', function() {
					var sticky_height = zozo_js_vars.zozo_sticky_height;
					$('#header-main').parent('.header-sticky').css({ "min-height": sticky_height, "height": "auto" });
				});
			}
		}
		
		if(Modernizr.mq('only screen and (max-width: 767px)')) {
			if( $('body').hasClass('header-mobile-un-sticky') ) {
				$("#header-main").unstick();
			}
		}
		
		/* Add active class for Toggle in menu */
		$('.nav.navbar-nav li span.menu-toggler').on('click', function() {
			$(this).parent('.dropdown').toggleClass('toggle-open');
		});
		
		// Responsive Auto Close Menu
		$('.main-nav .nav.navbar-nav li a:not(.external-link), .main-right-nav .nav.navbar-nav li a:not(.external-link)').on('click', function() {
			$(this).parents('.zozo-header-main-bar.navbar-collapse').removeClass('in');
		});
		
		var sliding_bar_state = 0;
		
		// Sliding Bar
		$( '.slidingbar-nav' ).on('click', function(e) {
			e.preventDefault();
			var $slidingbar = $(this).parents('#slidingbar-section').children('.slidingbar-inner');
			
			if( sliding_bar_state === 0 ) {
				$slidingbar.slideDown( 240, 'easeOutQuad' );
				$( '.slidingbar-nav' ).addClass( 'sb-open' );
				sliding_bar_state = 1;
			} else if( sliding_bar_state == 1 ) {
				$slidingbar.slideUp(240,'easeOutQuad');
				jQuery( '.slidingbar-nav' ).removeClass( 'sb-open' );
				sliding_bar_state = 0;
			}
			return false;
		});
		
		if( $('body').find('.rev_slider_wrapper .rev_slider').length ) {
			$('body').addClass('rev_slider-active');
		}
		
	})(jQuery);
	
	(function($) {
		"use strict";
		
		/* Nav Search Bar */
		$('.header-main-right-search .btn-trigger').on('click', function() {
			var search_form_ele = $(this).parent('.header-main-right-search').find('.search-form');
			$(search_form_ele).fadeToggle("slow");
			$(search_form_ele).find("input.form-control").focus();
			$(this).toggleClass('fa-times');
		});
		
		/* Toggle Search, Phone, Email */	
		$('.contact-phone .phone-trigger').on('click', function() {
			$(this).parents('.zozo-header-main-bar').find('#header-contact-phone').fadeToggle("fast");
			$(this).parents('#header-main').addClass("header-toggle-visible");
		});
		
		$('.contact-email .email-trigger').on('click', function() {
			$(this).parents('.zozo-header-main-bar').find('#header-contact-email').fadeToggle("fast");
			$(this).parents('#header-main').addClass("header-toggle-visible");
		});
		
		$('.search-toggle .search-trigger').on('click', function() {
			$(this).parents('.zozo-header-main-bar').find('#header-toggle-search').fadeToggle("fast");
			$(this).parents('.zozo-header-main-bar').find('#header-toggle-search input.form-control').focus();
			$(this).parents('#header-main').addClass("header-toggle-visible");
		});
		
		$('.social-toggle .social-trigger').on('click', function() {
			$(this).parents('.zozo-header-main-bar').find('#header-toggle-social').fadeToggle("fast");
			$(this).parents('#header-main').addClass("header-toggle-visible");
		});
		
		$('.btn-toggle-close').on('click', function() {
			$(this).parent('.header-toggle-content').fadeToggle("fast");
			$(this).parents('#header-main').removeClass("header-toggle-visible");
		});		
	
		// PrettyPhoto	
		$("a[rel^='prettyPhoto'], a[data-rel^='prettyPhoto']").prettyPhoto({hook: 'data-rel', social_tools: false, deeplinking: false});
		
	})(jQuery);
	
	/* =============================
	Back To Top
	============================= */
	$(document).on( 'click', '#zozo-back-to-top a', function( event ) {
		var $anchor = $(this);
		$('html, body').stop().animate({
			scrollTop: $($anchor.attr('href')).offset().top
		}, 1500, 'easeInOutExpo');
		event.preventDefault();
	});	
	
	/* =============================
	Shortcodes
	============================= */	
	$(".zozo-tooltip").tooltip();	
	$(".zozo-popover").popover();
	
	/* ============================= Progress Bar ============================= */
	var bar = $('.progress-bar');
	$(bar).appear(function() {
		bar_width = $(this).attr('aria-valuenow');
		$(this).width(bar_width + '%');
		$(this).find('span').fadeIn(4000);
	});
	
	/* ============================= Append Modal Outside all Containers ============================= */
	$(".zozo-modal").each( function() {
		$(".wrapper-class").append( $(this) );
	});
		
	/* ============================= Counter Section ============================= */
	if( typeof $.fn.waypoint !== 'undefined' ) {
		var counted = false;
		$('.zozo-counter-wrapper').waypoint(function(){
			$(this).find(".zozo-count-number").each(function(index){
				if( ! counted ) {
					setTimeout( function () {
						init_Counter( ".zozo-count-number" );
						counted = true;
					}, 200*index );
				}
			});
		},{offset:"85%"});
	}
	else if( typeof $.fn.appear !== 'undefined' ) {
		$(".zozo-count-number").appear(function() {
			init_Counter( this );
		});
	}
	else {
		init_Counter( ".zozo-count-number" );
	}
	
	$(".zozo-testimonial.slide").find(".item:first").addClass("active");
	$(".zozo-testimonial.slide").find(".carousel-indicators li:first").addClass("active");
		
	$('.widget_categories').find("ul:not(.children)").each(function() {
		$(this).addClass("categories");
	});	
	
	var cat_item = 1;	
	$('.sidebar .widget_categories').find("ul.categories > li").each(function() {
		if( cat_item == 5 ) {
			cat_item = 1;
		}
		$(this).addClass("category-item-" + cat_item);
		cat_item++;
		
		if( ! $(this).hasClass( "current-cat-parent" ) ) {
			if( $(this).find("ul.children > li").hasClass( "current-cat" ) ) {
				$(this).addClass( "current-parent" );
			}
		}
	});
			
	/* Animation */	
	$('.animated').appear(function() {
		var elem = $(this);
		var animation = elem.data('animation');		
		if ( !elem.hasClass('visible') ) {
			var animationDelay = elem.data('animation-delay');
			if ( animationDelay ) {
	
				setTimeout(function(){
					elem.addClass( animation + " visible" );					
				}, animationDelay);			
	
			} else {
				elem.addClass( animation + " visible" );
			}
		}		
	});
	
	/* ===================
	Video Script
	=================== */
	$('.wrapper-class').find(".zozo-yt-player").each(function() {
		 if (typeof $.fn.mb_YTPlayer != 'undefined' && $.isFunction($.fn.mb_YTPlayer)) {
			var m = false;
			if (/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test( navigator.userAgent)) {
				m = true;
			}
			var v = $(this);
			if (m == false) {
				v.mb_YTPlayer();
				v.parent().find('.zozo-video-controls a').each(function() {
					var t = $(this);
                    t.on('click', (function(e) {
						e.preventDefault();
						if (t.hasClass('fa-volume-off')) {
							t.removeClass('fa-volume-off').addClass('fa-volume-down');
							v.unmuteYTPVolume();
							return false;
						}
                        if (t.hasClass('fa-volume-down')) {
                        	t.removeClass('fa-volume-down').addClass('fa-volume-off');
                            v.muteYTPVolume();
                            return false;
                        }
                        if (t.hasClass('fa-pause')) {
                        	t.removeClass('fa-pause').addClass('fa-play');
							v.pauseYTP();
							return false;
						}
						if (t.hasClass('fa-play')) {
							t.removeClass('fa-play').addClass('fa-pause');
							v.playYTP();
							return false;
						}
					}));
				});
				v.parent().find('.zozo-video-controls').show();
			}
		 }
	});
		
	// Contact Form
	$('.zozo-contact-form').each(function(){
		$(this).bootstrapValidator({
			container: 'tooltip',
			message: 'This value is not valid',
			feedbackIcons: {
				valid: 'glyphicon glyphicon-ok',
				invalid: 'glyphicon glyphicon-remove',
				validating: 'glyphicon glyphicon-refresh'
			},
			fields: {
				contact_name: {                
					validators: {
						notEmpty: {
							message: $(this).data('name_not_empty')
						}
					}
				},
				contact_email: {
					validators: {
						notEmpty: {
							message: $(this).data('email_not_empty')
						},
						emailAddress: {
							message: $(this).data('email_valid')
						}
					}
				},
				contact_phone: {
					validators: {					
						digits: {
							message: $(this).data('phone_valid')
						}
					}
				},
				contact_message: {
					validators: {
						notEmpty: {
							message: $(this).data('msg_not_empty')
						}                    
					}
				}
			}
		}).on('success.form.bv', function(e) {
											
			e.preventDefault();
			
			var $form        = $(e.target),
				validator    = $form.data('bootstrapValidator'),
				submitButton = validator.getSubmitButton();
			
			$form.addClass('ajax-loader');
				
			var getid = $form.attr('id');
			
			var data = $('#' + getid).serialize();
			
			$.ajax({
					url: zozo_js_vars.zozo_ajax_url,
					type: "POST",
					dataType: 'json',
					data: data + '&action=zozo_sendmail',
					success: function (msg) {
						$('.zozo-contact-form').removeClass('ajax-loader');
						if( msg.status == 'true' ) {
							$('.zozo-form-success').html( '<i class="glyphicon glyphicon-ok"></i>' + msg.data );
							$('.zozo-form-success').show();
							submitButton.removeAttr("disabled");
							resetForm( $('#' + getid) );
						} else if( msg.status == 'false' ) {
							$('.zozo-form-error').html( '<i class="glyphicon glyphicon-remove"></i>' + msg.data );
							$('.zozo-form-error').show();
							submitButton.removeAttr("disabled");
							resetForm( $('#' + getid) );
						}
					},
					error: function(msg) {}
					
				});
			
			return false;        
		});
	});	
	
	// Mailchimp Form
	$('.zozo-mailchimp-form').each(function(){
		$(this).bootstrapValidator({
			container: 'tooltip',
			message: 'This value is not valid',
			feedbackIcons: {
				valid: 'glyphicon glyphicon-ok',
				invalid: 'glyphicon glyphicon-remove',
				validating: 'glyphicon glyphicon-refresh'
			},
			fields: {
				subscribe_email: {
					validators: {
						notEmpty: {
							message: 'The email address is required'
						},
						emailAddress: {
							message: 'The input is not a valid email address'
						},
						regexp: {
                            regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                            message: 'The value is not a valid email address'
                        }
					}
				},
			}
		}).on('success.form.bv', function(e) {
											
			e.preventDefault();
			
			var $form        = $(e.target),
				validator    = $form.data('bootstrapValidator'),
				submitButton = validator.getSubmitButton();
			
			$('.zozo-mailchimp-form').addClass('ajax-loader');
			var getid = $('.zozo-mailchimp-form').attr('id');
			var data = $('#' + getid).serialize();
			
			$.ajax({
					url: zozo_js_vars.zozo_ajax_url,
					type: "POST",
					dataType: 'json',
					data: data + '&action=zozo_mailchimp_subscribe',
					success: function (msg) {
						$('.zozo-mailchimp-form').removeClass('ajax-loader');
						if( msg.data !== '' ) {
							$('#' + getid).parent().find('.zozo-form-success').html( msg.data );
							$('#' + getid).parent().find('.zozo-form-success').show();
							submitButton.removeAttr("disabled");
							resetForm( $('#' + getid) );
						}
					},
					error: function(msg) {}
					
				});
			
			return false;        
		});
	});	
	
	function resetForm($form) {
		$form.find('input:text, input:password, input, input:file, select, textarea').val('');
		$form.find('input:radio, input:checkbox').removeAttr('checked').removeAttr('selected');		
		$form.find('input:text, input:password, input, input:file, select, textarea, input:radio, input:checkbox').parent().find('.form-control-feedback').hide();
	}
		
	/* ======================== Counter ======================== */
	function init_Counter( counter_item ) {
		$( counter_item ).each(function(){
			var datacount = $(this).attr('data-count');
			$(this).find('.counter').delay(3000).countTo({
				from: 10,
				to: datacount,
				speed: 4000,
				refreshInterval: 50,
			});
		});	
	}
	
	/* ======================== Day Counter ======================== */
	(function($) { 
		"use strict";
		$('.zozo-daycounter').each(function(){
			var counter_id = $(this).attr('id');
			var counter_type = $(this).data('counter');
			var year = $(this).data('year');
			var month = $(this).data('month');
			var date = $(this).data('date');
			
			var countDay = new Date();
			countDay = new Date(year, month - 1, date);
			
			if( counter_type == "down" ) {
				$("#"+counter_id).countdown({
					labels: [zozo_js_vars.zozo_CounterYears, zozo_js_vars.zozo_CounterMonths, zozo_js_vars.zozo_CounterWeeks, zozo_js_vars.zozo_CounterDays, zozo_js_vars.zozo_CounterHours, zozo_js_vars.zozo_CounterMins, zozo_js_vars.zozo_CounterSecs],
					labels1: [zozo_js_vars.zozo_CounterYear, zozo_js_vars.zozo_CounterMonth, zozo_js_vars.zozo_CounterWeek, zozo_js_vars.zozo_CounterDay, zozo_js_vars.zozo_CounterHour, zozo_js_vars.zozo_CounterMin, zozo_js_vars.zozo_CounterSec],
					until: countDay
				});
			} else if( counter_type == "up" ) {
				$("#"+counter_id).countdown({
					labels: [zozo_js_vars.zozo_CounterYears, zozo_js_vars.zozo_CounterMonths, zozo_js_vars.zozo_CounterWeeks, zozo_js_vars.zozo_CounterDays, zozo_js_vars.zozo_CounterHours, zozo_js_vars.zozo_CounterMins, zozo_js_vars.zozo_CounterSecs],
					labels1: [zozo_js_vars.zozo_CounterYear, zozo_js_vars.zozo_CounterMonth, zozo_js_vars.zozo_CounterWeek, zozo_js_vars.zozo_CounterDay, zozo_js_vars.zozo_CounterHour, zozo_js_vars.zozo_CounterMin, zozo_js_vars.zozo_CounterSec],
					since: countDay
				});
			}
			
		});
	})(jQuery);	
	
	/* ======================== EPL Listing Plugin ======================== */
	(function($) { 
		"use strict";
		/* switch views : grid & list on property archive pages */
		$('.epl-switch-view ul li').on('click', function() {
			var view = $(this).data('view');
			
			if( view == 'grid' ){
				$('.epl-property-blog').parents('.zozo-epl-listings-wrapper').addClass('zozo-epl-listing-grid-view');
			} else {
				$('.epl-property-blog').parents('.zozo-epl-listings-wrapper').removeClass('zozo-epl-listing-grid-view');
			}
		});
		$('.zozo-epl-listings-wrapper').each(function(){
			if( $(this).find('.epl-property-blog').hasClass('epl-listing-grid-view') ) {
				$(this).addClass('zozo-epl-listing-grid-view');
			} else {
				$(this).removeClass('zozo-epl-listing-grid-view');
			}
		});
		
		$('.zozo-epl-button-wrapper .share-btn.zozo-epl-button').on('click', function() {
			$(this).parent().find('.epl-share-icons-wrapper').toggleClass('active');
		});
	})(jQuery);

}); //End document ready function

function zozo_FooterHeight(){
	"use strict";
	
	if(Modernizr.mq('only screen and (min-width: 768px)')) {
		if( jQuery('body').hasClass('footer-hidden') ) {
			var footer_height = jQuery('.footer-section.footer-style-hidden').innerHeight();
			jQuery('.footer-section.footer-style-hidden').css({ height: footer_height + 'px' });
			jQuery('.footer-hidden .wrapper-inner').css({ 'margin-bottom': footer_height + 'px' });
		}
		if( jQuery('body').hasClass('footer-sticky') ) {
			var copyright_height = jQuery('.footer-section.footer-style-sticky .footer-copyright-section').innerHeight();
			jQuery('.footer-section.footer-style-sticky .footer-widgets-section').css({ 'margin-bottom': copyright_height + 'px' });
		}
	}
}

var get_current_scroll;
function zozo_initSecondaryMenu(){
	"use strict";

	jQuery('.side-menu a.secondary_menu_button, a.secondary_menu_close').on('click', function(event) {
		event.preventDefault();
		if( !jQuery('.side-menu a.secondary_menu_button' ).hasClass('active')){			
			if( jQuery('.secondary_menu').hasClass('right') ) {
				jQuery('body').addClass('side_right_menu_active');
				var right_menu_width = jQuery('.secondary_menu.right').width();
				jQuery('.side_right_menu_active .wrapper-class').animate({ left: "-" + right_menu_width + 'px' }, "slow");
			}
			else if( jQuery('.secondary_menu').hasClass('left') ) {
				jQuery('body').addClass('side_left_menu_active');
				jQuery('.side_left_menu_active').css({ 'overflow-x':'hidden' });
				var left_menu_width = jQuery('.secondary_menu.left').width();
				jQuery('.side_left_menu_active .wrapper-class').animate({ left: left_menu_width + 'px' }, "slow");
			}
			
			jQuery('.secondary_menu').css({opacity: 1.0}).animate({width: 'toggle'}, "slow");
			jQuery(this).addClass('active');
			
		} else {			
			if( jQuery('.secondary_menu').hasClass('right') ) {
				jQuery('.side_right_menu_active .wrapper-class').animate({ left: '0px' }, "slow");
				jQuery('body').removeClass('side_right_menu_active');
			}
			else if( jQuery('.secondary_menu').hasClass('left') ) {
				jQuery('.side_left_menu_active .wrapper-class').animate({ left: '0px' }, "slow");
				jQuery('body').removeClass('side_left_menu_active');
			}
			
			jQuery('.secondary_menu').animate({width: 'toggle', opacity: '0.0'}, "slow");
			jQuery('.side-menu a.secondary_menu_button').removeClass('active');
		}
	});
}

function zozo_MegaMenuHeight() {
	if( ! jQuery('.header-section').find('#header-side-nav').length ) {
		if( jQuery('.header-section').find( '.main-megamenu' ).length ) {
			jQuery('.header-section').find('.main-megamenu .zozo-main-nav > li').each(function(){
				var li_item = jQuery( this ),
				megamenu_wrapper = li_item.find( '.zozo-megamenu-wrapper' );
								
				if( megamenu_wrapper.length ) {
					megamenu_wrapper.removeAttr( 'style' );
					
					var megamenu_wrapper_top = megamenu_wrapper.offset().top,
					megamenu_new_height = jQuery( window ).height() - megamenu_wrapper_top - 20;
				
					if( megamenu_wrapper.height() > jQuery( window ).height() ) {
						megamenu_wrapper.css({ 'max-height': megamenu_new_height, 'overflow-y': 'auto' });
						jQuery(".header-section .zozo-megamenu-wrapper").mCustomScrollbar({
							setHeight: false,
							scrollButtons: {enable:true},
							theme: "minimal",
							scrollbarPosition: "inside",
							mouseWheel:{ scrollAmount: 500 }
						});
					}
				}
			});
		}
	}
}

function zozo_SideMegaMenu() {
	if( jQuery('.header-section').find('#header-side-nav').length ) {
		if( jQuery('#header-side-nav').find( '.main-megamenu' ).length ) {

			var main_nav_container = jQuery('.main-megamenu'),
				main_nav_container_width = main_nav_container.width();
				
			var main_wrapper = jQuery('.wrapper-class'),
				main_wrapper_width = main_wrapper.width();
				
			jQuery('#header-side-nav').find('.main-megamenu .zozo-main-nav > li').each(function(){
				var li_item = jQuery( this ),
				megamenu_wrapper = li_item.find( '.zozo-megamenu-wrapper' );
								
				if( megamenu_wrapper.length ) {
					megamenu_wrapper.removeAttr( 'style' );
					
					megamenu_wrapper.css( 'width', main_wrapper_width );
					
					if( megamenu_wrapper.height() > jQuery( window ).height() ) {
						megamenu_wrapper.css({ 'max-height': jQuery( window ).height(), 'overflow-y': 'auto' });
						jQuery("#header-side-nav .zozo-megamenu-wrapper").mCustomScrollbar({
							setHeight: false,
							scrollButtons: {enable:true},
							theme: "minimal",
							scrollbarPosition: "inside",
							mouseWheel:{ scrollAmount: 500 }
						});
					}
					
					var megamenu_wrapper_left = jQuery( '#header-side-nav' ).outerWidth() - 1,
						megamenu_wrapper_right = ( -1 ) * megamenu_wrapper.outerWidth(),
						megamenu_wrapper_top = megamenu_wrapper.offset().top,
						megamenu_wrapper_height = megamenu_wrapper.height(),
						megamenu_bottom_edge = megamenu_wrapper_top + megamenu_wrapper_height,
						admin_bar_height = ( jQuery( '#wpadminbar' ).length ) ? jQuery( '#wpadminbar' ).height() : 0,
						side_header_top = jQuery( '#header-side-nav' ).offset().top - admin_bar_height,
						browser_bottom_edge = jQuery( window ).height();
					
					if( jQuery('#header-side-nav').hasClass( 'header-position-left') ) {
						megamenu_wrapper.css( 'left', megamenu_wrapper_left );
					}
					
					if( jQuery('#header-side-nav').hasClass( 'header-position-right') ) {
						megamenu_wrapper.css( 'left', megamenu_wrapper_right );
					}
					
					if( megamenu_bottom_edge > side_header_top + browser_bottom_edge && jQuery( '.header-side-wrapper' ).height() >= jQuery( window ).height() ) {
						if( megamenu_wrapper_height < browser_bottom_edge ) {
							var megamenu_wrapper_new_top_pos = ( -1 ) * ( megamenu_bottom_edge - side_header_top - browser_bottom_edge );
						} else {
							var megamenu_wrapper_new_top_pos = ( -1 ) * ( megamenu_wrapper_top - admin_bar_height );
						}
	
						megamenu_wrapper.css( 'top', megamenu_wrapper_new_top_pos );
					}
					
				}
			});
				
		}
	}
}

function zozo_initPortfolioGrid(){
	jQuery('.portfolio-inner').each(function(){
			
		var $port_container_id = jQuery(this).closest('.zozo-portfolio').attr('id');			
		var $port_container = jQuery('#' + $port_container_id).find('.portfolio-inner');		
		$containerProxy = $port_container.clone().empty().css({ visibility: 'hidden' });
		$port_container.after( $containerProxy ); 
		var $item = $port_container.find('.portfolio-item').eq(0);
		
		var columns = Math.floor( $port_container.closest('.zozo-portfolio').attr('data-columns') );
		var gutterSize = Math.floor( $port_container.closest('.zozo-portfolio').attr('data-gutter') );		
		var selector = $port_container.parent().find('.portfolio-tabs a.active').data('filter');
		
		if(Modernizr.mq('only screen and (min-width: 1025px)')) {
			
			$port_container.imagesLoaded(function(){
				if( columns == 2 ) {
					var masonryGutter = gutterSize / columns;					
				} else if( columns == 3 ) {
					var colValue = gutterSize / 2;
					var masonryGutter = colValue + ( colValue / 3 );					
				} else if( columns == 4 ) {
					var colValue = gutterSize / 2;
					var masonryGutter = colValue + ( colValue / 2 );					
				}
				
				// calculate columnWidth
				var colWidth = Math.floor( $containerProxy.width() / columns );
				var masonryWidth = Math.floor( colWidth - masonryGutter );
				
				$port_container.find('.portfolio-item').css('width', masonryWidth);
				$port_container.find('.portfolio-item').css('margin-bottom', gutterSize);
				
				$port_container.isotope({
					resizable: false,
					filter: selector,
					animationEngine: "css",
					masonry: {
						columnWidth: masonryWidth,
						gutter: gutterSize
					},
					isOriginLeft: zozo_js_vars.isOriginLeft
				});
				
				jQuery( window ).bind( 'load resize', function() {
					var colWidth = Math.floor( $containerProxy.width() / columns );
					var masonryWidth = Math.floor( colWidth - masonryGutter );
					$port_container.find('.portfolio-item').css('width', masonryWidth);
					
					$port_container.isotope({
						masonry: {
							columnWidth: masonryWidth,
							gutter: gutterSize
						},
						isOriginLeft: zozo_js_vars.isOriginLeft
					});
					
					$port_container.isotope( "layout" );
				});
			});					
		}
		
		if(Modernizr.mq('only screen and (max-width: 1024px) and (min-width: 992px)')) {
			
			$port_container.imagesLoaded(function(){				
				if( columns == 4 ) {
					columns = 3;
				}
				
				if( columns == 2 ) {
					var masonryGutter = gutterSize / columns;					
				} else if( columns == 3 || columns == 4 ) {
					var colValue = gutterSize / 2;
					var masonryGutter = colValue + ( colValue / 3 );					
				}
				
				// calculate columnWidth
				var colWidth = Math.floor( $containerProxy.width() / columns );		
				var masonryWidth = Math.floor( colWidth - masonryGutter );
				
				$port_container.find('.portfolio-item').css('width', masonryWidth);
				$port_container.find('.portfolio-item').css('margin-bottom', gutterSize);
				
				$port_container.isotope({
					resizable: false,
					filter: selector,
					animationEngine: "css",
					masonry: {
						columnWidth: masonryWidth,
						gutter: gutterSize
					},
					isOriginLeft: zozo_js_vars.isOriginLeft
				});
				jQuery( window ).bind( 'load resize', function() {
					$port_container.isotope( "layout" );
				});
			});					
		}
		
		if(Modernizr.mq('only screen and (max-width: 991px) and (min-width: 768px)')) {
			
			$port_container.imagesLoaded(function(){				
				if( columns == 3 || columns == 4 ) {
					columns = 2;
				}
				
				if( columns == 2 ) {
					var masonryGutter = gutterSize / columns;					
				}
				
				// calculate columnWidth
				var colWidth = Math.floor( $containerProxy.width() / columns );		
				var masonryWidth = Math.floor( colWidth - masonryGutter );
				
				$port_container.find('.portfolio-item').css('width', masonryWidth);
				$port_container.find('.portfolio-item').css('margin-bottom', gutterSize);
				
				$port_container.isotope({
					resizable: false,
					filter: selector,
					animationEngine: "css",
					masonry: {
						columnWidth: masonryWidth,
						gutter: gutterSize
					},
					isOriginLeft: zozo_js_vars.isOriginLeft
				});
			});
			jQuery( window ).bind( 'load resize', function() {
				$port_container.isotope( "layout" );
			});
		}
	
		if(Modernizr.mq('only screen and (max-width: 767px)')) {
			$port_container.imagesLoaded(function(){
				var gutterSize = Math.floor( $port_container.closest('.zozo-portfolio').attr('data-gutter') );
							
				$port_container.find('.portfolio-item').css('width', '100%');
				$port_container.find('.portfolio-item').css('margin-bottom', gutterSize);
				
				var selector = $port_container.parent().find('.portfolio-tabs a.active').data('filter');
				
				$port_container.isotope({
					resizable: false,
					filter: selector,
				 	animationEngine: "css",
					masonry: {
						columnWidth: '.portfolio-item',
						gutter: 0
					},
					isOriginLeft: zozo_js_vars.isOriginLeft
				});
				
				jQuery( window ).bind( 'load resize', function() {
					$port_container.isotope( "layout" );
				});
			});
		}
	 
		// Portfolio Filter Items
		jQuery('.portfolio-tabs a').on('click', function() {
			
			jQuery(this).parent().parent().find('a.active').removeClass('active');				
			jQuery(this).addClass('active');
			var selector = jQuery(this).parent().parent().find('a.active').attr('data-filter');		
			jQuery(this).parent().parent().parent().find('.portfolio-inner').isotope({ 
				filter: selector, 
				animationEngine : "css" 
			});
			
			return false; 
		});
	});
}

function zozo_initBlogSlider() {
	var isRTL = jQuery('body').hasClass( 'rtl' ) ? true : false;
	jQuery(".blog-carousel-slider").each(function() {
		var $carousel = jQuery(this);
		$carousel.owlCarousel({
			rtl				: isRTL,
			dots            : false,
			items           : 1,
			slideBy         : 1,
			center          : false,
			loop            : true,
			margin          : 0,
			nav             : true,
			autoplay        : $carousel.data( "autoplay" ),
			autoplayTimeout : $carousel.data( "autoplay-timeout" ),
			navText         : [ '<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>' ],
			responsiveClass : true,
			responsive      : {
				0: {
					items   : 1
				},
				480: {
					 items  : 1
				},
				768: {
					items   : 1
				},
				980: {
					items   : 1
				}
			}
		});
	});
}

function zozo_initBlogGrid() {	
	
	if(Modernizr.mq('only screen and (min-width: 1025px)')) {
		jQuery('.grid-layout.grid-col-2').imagesLoaded( function() {
			var gridwidth = Math.floor( jQuery('.grid-layout.grid-col-2').width() / 2 );
			var masonryWidth = Math.floor( gridwidth - 15 );
			jQuery('.grid-layout.grid-col-2 .grid-posts').css('width', masonryWidth);
		
			jQuery('.grid-layout.grid-col-2').masonry({
				itemSelector: '.grid-posts',
				columnWidth: masonryWidth,
				gutter: 30,
				isOriginLeft: zozo_js_vars.isOriginLeft
			});
		});	
		
		jQuery('.grid-layout.grid-col-3').imagesLoaded( function() {
			var gridwidth = Math.floor( jQuery('.grid-layout.grid-col-3').width() / 3 );
			var masonryWidth = Math.floor( gridwidth - 20 );	
			jQuery('.grid-layout.grid-col-3 .grid-posts').css('width', masonryWidth);
			
			jQuery('.grid-layout.grid-col-3').masonry({
				itemSelector: '.grid-posts',
				columnWidth: masonryWidth,
				gutter: 30,
				isOriginLeft: zozo_js_vars.isOriginLeft
			});
		});
		
		jQuery('.grid-layout.grid-col-4').imagesLoaded( function() {
			var gridwidth = Math.floor( jQuery('.grid-layout.grid-col-4').width() / 4 );
			var masonryWidth = Math.floor( gridwidth - 22 );
			jQuery('.grid-layout.grid-col-4 .grid-posts').css('width', masonryWidth);	
		
			jQuery('.grid-layout.grid-col-4').masonry({
				itemSelector: '.grid-posts',
				columnWidth: masonryWidth,
				gutter: 30,
				isOriginLeft: zozo_js_vars.isOriginLeft
			});
		});
	}
	
	if(Modernizr.mq('only screen and (max-width: 1024px) and (min-width: 768px)')) {
		if( jQuery('body').hasClass( 'three-col-middle' ) || jQuery('body').hasClass( 'three-col-right' ) || jQuery('body').hasClass( 'three-col-left' ) ) {
			jQuery('.three-col-middle .grid-layout.grid-col-2 .grid-posts, .three-col-right .grid-layout.grid-col-2 .grid-posts, .three-col-left .grid-layout.grid-col-2 .grid-posts, .three-col-middle .grid-layout.grid-col-3 .grid-posts, .three-col-right .grid-layout.grid-col-3 .grid-posts, .three-col-left .grid-layout.grid-col-3 .grid-posts, .three-col-middle .grid-layout.grid-col-4 .grid-posts, .three-col-right .grid-layout.grid-col-4 .grid-posts, .three-col-left .grid-layout.grid-col-4 .grid-posts').imagesLoaded( function() {
				jQuery('.three-col-middle .grid-layout.grid-col-2 .grid-posts, .three-col-right .grid-layout.grid-col-2 .grid-posts, .three-col-left .grid-layout.grid-col-2 .grid-posts, .three-col-middle .grid-layout.grid-col-3 .grid-posts, .three-col-right .grid-layout.grid-col-3 .grid-posts, .three-col-left .grid-layout.grid-col-3 .grid-posts, .three-col-middle .grid-layout.grid-col-4 .grid-posts, .three-col-right .grid-layout.grid-col-4 .grid-posts, .three-col-left .grid-layout.grid-col-4 .grid-posts').css('width', '100%');
				jQuery('.three-col-middle .grid-layout.grid-col-2, .three-col-right .grid-layout.grid-col-2, .three-col-left .grid-layout.grid-col-2, .three-col-middle .grid-layout.grid-col-3, .three-col-right .grid-layout.grid-col-3, .three-col-left .grid-layout.grid-col-3, .three-col-middle .grid-layout.grid-col-4, .three-col-right .grid-layout.grid-col-4, .three-col-left .grid-layout.grid-col-4').masonry({
					itemSelector: '.grid-posts',
					columnWidth: '.grid-posts',
					gutter: 0,
					isOriginLeft: zozo_js_vars.isOriginLeft
				});
			});
		} else {
			
			jQuery('.grid-layout.grid-col-2 .grid-layout.grid-posts, .grid-layout.grid-col-3 .grid-posts, .grid-layout.grid-col-4 .grid-posts').imagesLoaded( function() {
				var gridwidth = Math.floor( jQuery('.grid-layout.grid-col-2, .grid-layout.grid-col-3, .grid-layout.grid-col-4').width() / 2 );
				var masonryWidth = Math.floor( gridwidth - 15 );
				
				jQuery('.grid-layout.grid-col-2 .grid-posts, .grid-layout.grid-col-3 .grid-posts, .grid-layout.grid-col-4 .grid-posts').css('width', masonryWidth);
				jQuery('.grid-layout.grid-col-2, .grid-layout.grid-col-3, .grid-layout.grid-col-4').masonry({
					itemSelector: '.grid-posts',
					columnWidth: masonryWidth,
					gutter: 30,
					isOriginLeft: zozo_js_vars.isOriginLeft
				});
			});
			
		}
	}	
	
	if(Modernizr.mq('only screen and (max-width: 767px)')) {
		jQuery('.grid-layout.grid-col-2 .grid-posts, .grid-layout.grid-col-3 .grid-posts, .grid-layout.grid-col-4 .grid-posts').imagesLoaded( function() {
			jQuery('.grid-layout.grid-col-2 .grid-posts, .grid-layout.grid-col-3 .grid-posts, .grid-layout.grid-col-4 .grid-posts').css('width', '100%');
			jQuery('.grid-layout.grid-col-2, .grid-layout.grid-col-3, .grid-layout.grid-col-4').masonry({
				itemSelector: '.grid-posts',
				columnWidth: '.grid-posts',
				gutter: 0,
				isOriginLeft: zozo_js_vars.isOriginLeft
			});
		});
	}
}

function zozo_initBlogInfiniteScroll() {
	
	var curPage = 1;
	var pagesNum = jQuery('ul.pagination').find("a.page-numbers:not('.current, .next, .prev'):last").text();
	
	jQuery('.zozo-posts-container.scroll-infinite').each(function() {
		var $infinite_container = jQuery(this);
		
		jQuery( $infinite_container ).infinitescroll({
			navSelector  : "ul.pagination",	
			nextSelector : "ul.pagination li a.next",
			itemSelector : "article.post",
			loading	  	 : {
							finishedMsg: '<span class="all-loaded">All Posts displayed</span>',
							msg: null,
							img: zozo_js_vars.zozo_template_uri + "/images/ajax-loader.gif",
							msgText: "",
			},
			errorCallback: function() {
				jQuery( $infinite_container ).masonry();
			}
		}, function( newPosts ) {
			
			var $newPosts = jQuery( newPosts );
			
			curPage++;

			if(curPage == pagesNum) {
				jQuery(window).unbind('.infscr');
			}
			
			$newPosts.hide();
			$newPosts.imagesLoaded(function() {
				$newPosts.fadeIn();
				
				// Relayout Masonry
				if( $infinite_container.hasClass('grid-layout') ) {
					$infinite_container.masonry('appended', $newPosts);
				}
			});
			
			// Relayout Masonry Columns
			if(Modernizr.mq('only screen and (min-width: 1025px)')) {
				var gridwidth = ( jQuery('.grid-layout.grid-col-2').width() / 2 ) - 15;
				jQuery('.grid-layout.grid-col-2 .grid-posts').css('width', gridwidth);
	
				var gridwidth = ( jQuery('.grid-layout.grid-col-3').width() / 3 ) - 20;
				jQuery('.grid-layout.grid-col-3 .grid-posts').css('width', gridwidth);
	
				var gridwidth = ( jQuery('.grid-layout.grid-col-4').width() / 4 ) - 22;
				jQuery('.grid-layout.grid-col-4 .grid-posts').css('width', gridwidth);
			}
			
			if(Modernizr.mq('only screen and (max-width: 1024px) and (min-width: 768px)')) {
				if( jQuery('body').hasClass( 'three-col-middle' ) || jQuery('body').hasClass( 'three-col-right' ) || jQuery('body').hasClass( 'three-col-left' ) ) {
					
					jQuery('.three-col-middle .grid-layout.grid-col-2 .grid-posts, .three-col-right .grid-layout.grid-col-2 .grid-posts, .three-col-left .grid-layout.grid-col-2 .grid-posts, .three-col-middle .grid-layout.grid-col-3 .grid-posts, .three-col-right .grid-layout.grid-col-3 .grid-posts, .three-col-left .grid-layout.grid-col-3 .grid-posts, .three-col-middle .grid-layout.grid-col-4 .grid-posts, .three-col-right .grid-layout.grid-col-4 .grid-posts, .three-col-left .grid-layout.grid-col-4 .grid-posts').css('width', '100%');
				} else {			
					var gridwidth = ( jQuery('.grid-col-2, .grid-col-3, .grid-col-4').width() / 2 ) - 15;
					jQuery('.grid-layout.grid-col-2 .grid-posts, .grid-layout.grid-col-3 .grid-posts, .grid-layout.grid-col-4 .grid-posts').css('width', gridwidth);						
				}
			}
			
			if(Modernizr.mq('only screen and (max-width: 767px)')) {
				jQuery('.grid-layout.grid-col-2 .grid-posts, .grid-layout.grid-col-3 .grid-posts, .grid-layout.grid-col-4 .grid-posts').css('width', '100%');
			}
			
			if( typeof jQuery.fn.mediaelementplayer !== 'undefined' && jQuery.isFunction( jQuery.fn.mediaelementplayer ) ) {
				$newPosts.find('audio, video').mediaelementplayer();
			}
			
			$newPosts.find("a[rel^='prettyPhoto'], a[data-rel^='prettyPhoto']").prettyPhoto({hook: 'data-rel', social_tools: false, deeplinking: false});
			
			// Initialize Owl Carousel for Post Slider
			var isRTL = jQuery('body').hasClass( 'rtl' ) ? true : false;
			$newPosts.find('.blog-carousel-slider').each(function() {
				var $carousel = jQuery(this);				
				$carousel.owlCarousel({
					rtl				: isRTL,
					dots            : false,
					items           : 1,
					slideBy         : 1,
					center          : false,
					loop            : false,
					margin          : 0,
					nav             : true,
					autoplay        : $carousel.data( "autoplay" ),
					autoplayTimeout : $carousel.data( "autoplay-timeout" ),
					navText         : [ '<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>' ],
					responsiveClass : true,
					responsive      : {
						0: {
							items   : 1
						},
						480: {
							 items  : 1
						},
						768: {
							items   : 1
						},
						980: {
							items   : 1
						}
					}
				});
				
				$carousel.trigger('initialize.owl.carousel');
			});
		});	
	});
	
}

function zozo_Tweets_Slider() {
	jQuery('.zozo-twitter-slide').each(function() {
		var visible = jQuery(this).data('visible');
		jQuery('.zozo-twitter-slide').easyTicker({
			direction: 'up',
			speed: 'slow',
			interval: 3000,
			height: 'auto',
			visible: visible,
			mousePause: 0,
		});	
	});
}

/* ======================== Circle Counter Responsive Carousel Slider ======================== */

function zozo_CircleRSliderInit() {
	
	jQuery('.zozo-circle-counter-wrapper').each( function() {
		var slider_id = jQuery(this).find('.owl-carousel').attr('id');
		
		if(Modernizr.mq('only screen and (max-width: 991px)')) {
			if( slider_id == null || slider_id == undefined ) {
				jQuery(this).find('.zozo-circle-counter.circle-no-slider').owlCarousel({
					dots            : false,
					items           : 1,
					slideBy         : 1,
					loop            : false,				
					nav             : true,
					autoplay        : true,
					autoplayTimeout : 5000,
					navText         : [ '<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>' ],
					responsiveClass : true,
					responsive      : {
						0: {
							items   : 1
						},
						480: {
							 items  : 1
						},
						768: {
							items   : 1
						},
						992: {
							items   : 1
						}
					}
				});
			}		
		} else {
			if( slider_id == null || slider_id == undefined ) {
				if( typeof jQuery(this).find('.zozo-circle-counter.circle-no-slider').data('owlCarousel') != 'undefined' ) {
					jQuery(this).find('.zozo-circle-counter.circle-no-slider').data('owlCarousel').destroy();
					jQuery(this).find('.zozo-circle-counter.circle-no-slider').removeClass('owl-carousel');
				}
			}
		}
	
	});
}


/* ======================== Circle Counter ======================== */

var rart = rart || {};
	
var isMobile = function() {
	var check = false;
	(function(a){if(/(android|ipad|playbook|silk|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4)))check = true})(navigator.userAgent||navigator.vendor||window.opera);
	return check;
};

function zozo_initCircleCounter(barcolor) {	
	
	function zozo_Piechart(target, barcolor){
		if(target === undefined) {
			target = jQuery('.zozo-piechart');
		}
		
		if( target.length != 0 && jQuery().easyPieChart ) {
			
			if(barcolor === undefined) {
				var barcolor = target.data('barcolor');
			}
			
			var trackcolor = target.data('trackcolor');
			if(trackcolor === undefined) {
				var trackcolor = false;
			}
			
			var size = target.parents('.zozo-circle-counter').data('circle');
			if(size === undefined) {
				var size = 152;
			}
			var linewidth = target.parents('.zozo-circle-counter').data('linewidth');
			if(linewidth === undefined) {
				var linewidth = 6;
			}
			
			target.easyPieChart({
				animate: 3000,
				barColor: barcolor,
				trackColor: trackcolor,
				easing: 'easeOutBounce',
				size: size,
				lineWidth: linewidth,
				lineCap: 'round', // rectAngle or round
				scaleColor: false,
				onStep: function(from, to, percent) {
					jQuery(this.el).find('span').text(Math.round(percent));
				}
			});
		}	
	}
	
	if( !isMobile() && jQuery().appear )
	{
		jQuery('.zozo-piechart').appear(function() {
			zozo_Piechart(jQuery(this), barcolor);
		});
	}
	else{
		jQuery('.zozo-piechart').appear(function() {
			zozo_Piechart(jQuery(this), barcolor, '');
		});
	}	
}

jQuery(document).ajaxComplete(function(event, xhr, settings) {
	zozo_ajax_complete();
});

function zozo_ajax_complete() {	
	zozo_initCartAjaxRemoveItem();
}

/* ======================== Woocommerce Ajax Mini Cart Remove ======================== */

function zozo_initCartAjaxRemoveItem() {
	jQuery('.woo-cart-item .remove-cart-item').unbind('click').on('click', function() {
		var $this = jQuery(this);
		var cart_id = $this.data("cart_id");
		$this.parent().find('.ajax-loading').show();

		jQuery.ajax({
			type: 'POST',
			dataType: 'json',
			url: zozo_js_vars.zozo_ajax_url,
			data: { action: "zozo_product_remove",
				cart_id: cart_id
			},success: function( response ) {
				var fragments = response.fragments;
				var cart_hash = response.cart_hash;

				if ( fragments ) {
					jQuery.each(fragments, function(key, value) {
						jQuery(key).replaceWith(value);
					});
				}
			}
		});
		return false;
	});
}
	
/* ======================== Google Map ======================== */
window.onload = MapLoadScript;
var google;
function GmapInit() {
	  Gmap = jQuery('.gmap_canvas');
	  Gmap.each(function() {		
		var $this           = jQuery(this),
			zoom            = 12,
			scrollwheel     = false,
			zoomcontrol 	= true,
			draggable       = true,
			mapType         = google.maps.MapTypeId.ROADMAP,
			title           = '',
			contentString   = '',
			dataAddress     = $this.data('address'),
			dataZoom        = $this.data('zoom'),
			dataType        = $this.data('type'),
			dataScrollwheel = $this.data('scrollwheel'),
			dataZoomcontrol = $this.data('zoomcontrol'),
			dataHue         = $this.data('hue'),
			dataSaturation  = $this.data('saturation'),
			dataLightness   = $this.data('lightness');
			
		var latlngArray = dataAddress.split(',');
		var lat = parseFloat(latlngArray[0]);
		var lng = parseFloat(latlngArray[1]);
				
		if( dataZoom !== undefined && dataZoom !== false ) {
			zoom = parseFloat(dataZoom);
		}
		if( dataScrollwheel !== undefined && dataScrollwheel !== null ) {
			scrollwheel = dataScrollwheel;
		}
		if( dataZoomcontrol !== undefined && dataZoomcontrol !== null ) {
			zoomcontrol = dataZoomcontrol;
		}
		if( dataType !== undefined && dataType !== false ) {
			if( dataType == 'satellite' ) {
				mapType = google.maps.MapTypeId.SATELLITE;
			} else if( dataType == 'hybrid' ) {
				mapType = google.maps.MapTypeId.HYBRID;
			} else if( dataType == 'terrain' ) {
				mapType = google.maps.MapTypeId.TERRAIN;
			}		  	
		}
		
		if( navigator.userAgent.match(/iPad|iPhone|Android/i) ) {
			draggable = false;
		}
		
		var mapOptions = {
		  zoom        : zoom,
		  scrollwheel : scrollwheel,
		  zoomControl : zoomcontrol,
		  draggable   : draggable,
		  center      : new google.maps.LatLng(lat, lng),
		  mapTypeId   : mapType
		};		
		var map = new google.maps.Map($this[0], mapOptions);
		
		var image = $this.data('marker');
		
		var contents    = $this.data('content');
		var titles 		= $this.data('title');
		
		if( ( contents !== undefined && contents !== false ) || ( titles !== undefined && titles !== false ) ) {
			var contentArray = contents.split('|');
			var titleArray   = titles.split(',');
		}
		
		var addresses    = $this.data('addresses');
		if( addresses !== undefined && addresses !== '' ) {
			var addressArray = addresses.split('|');
			var address = [];
			
			for (var i = 0; i < addressArray.length; i++) {
				address[i] = addressArray[i];
				var latlngArray = address[i].split(',');
				var lat1 = parseFloat(latlngArray[0]);
				var lng1 = parseFloat(latlngArray[1]);
				
				var marker = new google.maps.Marker({
				  position : new google.maps.LatLng(lat1, lng1),
				  map      : map,
				  icon     : image,
				  title    : titleArray[i],
				});
				
				if( contents !== undefined && contents !== '' ) {
					marker.content = '<div class="map-data">';
					marker.content += '<h6>' + titleArray[i] + '</h6>';
					marker.content += '<div class="map-content">';
					var contentNew = contentArray[i].split(',');
					
					for (var j = 0; j < contentNew.length; j++) {
						if( j == 0 ) {
							marker.content += contentNew[j];
						} else {
							marker.content += '<br>' + contentNew[j];
						}
					}
					marker.content += '</div>' + '</div>';
					
					marker.info = new google.maps.InfoWindow();
					google.maps.event.addListener(marker, 'click', function() {
						marker.info.setContent(this.content);
						marker.info.open(this.getMap(), this);
					});
				}
			}
		} else {
			var marker = new google.maps.Marker({
			  position : new google.maps.LatLng(lat, lng),
			  map      : map,
			  icon     : image,
			});
			
			if( contents !== undefined && contents !== '' ) {
				marker.content = '<div class="map-data">' + '<h6>' + titles + '</h6>' + '<div class="map-content">' + contents + '</div>' + '</div>';
			}
			var d_infowindow = new google.maps.InfoWindow();
			
			if( contents !== undefined && contents !== '' ) {
				google.maps.event.addListener(marker, 'click', function() {
					d_infowindow.setContent(this.content);
					d_infowindow.open(this.getMap(), this);
				});
			}
		}
		
		if( dataHue !== undefined && dataHue !== '' ) {
		  var styles = [
			{
			  stylers : [
				{ hue : dataHue },
				{ saturation: dataSaturation },
				{ lightness: dataLightness }
			  ]
			}
		  ];
		  map.setOptions({styles: styles});
		}
	 });	 
}

function MapLoadScript() {
	if( typeof google !== 'undefined' && typeof google === 'object' ) {
		if( typeof google.maps === 'object' ) {
			GmapInit();
		}
	}
}