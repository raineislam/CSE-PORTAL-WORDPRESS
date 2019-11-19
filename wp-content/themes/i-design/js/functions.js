/**
 * Functionality specific to i-design.
 *
 * Provides helper functions to enhance the theme experience.
 */

( function( $ ) {
	var body    = $( 'body' ),
	    _window = $( window );
	
	/**
	 * Enables menu toggle for small screens.
	 */
	( function() {
		var nav = $( '#site-navigation' ), button, menu;
		if ( ! nav )
			return;

		button = nav.find( '.menu-toggle' );
		if ( ! button )
			return;

		// Hide button if menu is missing or empty.
		menu = nav.find( '.nav-container' );
		if ( ! menu || ! menu.children().length ) {
			button.hide();
			return;
		}

		$( '.menu-toggle' ).on( 'click.idesign', function() {
			//nav.toggleClass( 'toggled-on' );
		} );
	} )();

	/**
	 * Makes "skip to content" link work correctly in IE9 and Chrome for better
	 * accessibility.
	 *
	 * @link http://www.nczonline.net/blog/2013/01/15/fixing-skip-to-content-links/
	 */
	_window.on( 'hashchange.idesign', function() {
		var element = document.getElementById( location.hash.substring( 1 ) );

		if ( element ) {
			if ( ! /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) )
				element.tabIndex = -1;

			element.focus();
		}
	} );

		
} )( jQuery );

/* scripts to run on document ready */
jQuery(document).ready(function($) {
	
	/* customizing the drop down menu */
	jQuery('div.nav-container > ul > li > a').append( '<span class="colorbar"></span>' );
    jQuery('div.nav-container ul > li').hover(function() {
        jQuery(this).children('ul.children,ul.sub-menu').stop(true, true).slideDown("fast");
    }, function(){
        jQuery(this).children('ul.children,ul.sub-menu').slideUp("fast");
    });
	
	jQuery('.search-form').append( '<span class="searchico genericon genericon-search"></span>' );
	
	
	
	/* adding class for no featured image posts */
	$( "div.entry-nothumb" ).parent(".meta-img").addClass("no-image-meta");
	
	/* Go to top button */
	jQuery('body').append('<a href="#" class="go-top animated"><span class="genericon genericon-collapse"></span></a>');
                        // Show or hide the sticky footer button
    jQuery(window).scroll(function() {
        if (jQuery(this).scrollTop() > 200) {
        	jQuery('.go-top').fadeIn(200).addClass( 'bounce' );
        } else {
            jQuery('.go-top').fadeOut("slow");
        }
    });


    // Animate the scroll to top
    jQuery('.go-top').click(function(event) {
        event.preventDefault();
        jQuery('html, body').animate({scrollTop: 0}, 1000);
    });	
	
	
	
	/*equal height for featured post for two column view */
	
	equalheight = function(container){
	
		var currentTallest = 0,
			 currentRowStart = 0,
			 rowDivs = new Array(),
			 $el,
			 topPosition = 0;
		$(container).each(function() {
		
		   $el = $(this);
		   $($el).height('auto')
		   topPostion = $el.position().top;
		
		   	if (currentRowStart != topPostion) {
				for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
			   		rowDivs[currentDiv].height(currentTallest);
			 	}
			 	rowDivs.length = 0; // empty the array
			 	currentRowStart = topPostion;
			 	currentTallest = $el.height();
			 	rowDivs.push($el);
		   	} else {
			 	rowDivs.push($el);
			 	currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
		  	}
		   	for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
			 	rowDivs[currentDiv].height(currentTallest);
		   	}
		});
	}

  	equalheight('.main article');
	


	/*
	$(window).scroll(function(){
		var newvalue = parseInt($(this).scrollTop()*0.25)-64;
    	$('.ibanner').css('background-position', '0px '+newvalue+'px');
	});
	*/
	
	

	$(window).load(function(){	
		
		// footer area masonry	
		$('#footer-widgets').each(function () {
			$(this).masonry({});
		});
		
		// Two column Blog layout masonry
		$('#blog-cols').each(function () {
			$(this).masonry({});
		});		
		
	});		
	
	
	// slider
	$('#da-slider').each(function() {
		
		_this = $(this);
		var slider_speed = _this.data('slider-speed');
	
		_this.owlCarousel({
	 		
			navigation : true,
			autoPlay : slider_speed,
			paginationSpeed : 600,
			singleItem: true,
			rewindSpeed: 600,
			stopOnHover: true,
			navigationText: ['<span class="genericon genericon-leftarrow"></span>','<span class="genericon genericon-rightarrow"></span>'],
			addClassActive: true,
			theme : "owl-theme1",
			goToFirstSpeed : 1000,
			slideSpeed : 600,
			autoHeight: true			
	 
		});
	 
	});
	
	
	// Banner Parallax Effect	
	if ( $('.ibanner').length > 0 )
	{			
	
		var slider_parallax = $('#da-slider').data('slider-parallax');
		var slider_height = $('#da-slider').data('slider-height');
		
		slider_height = ( ($( window ).height()/100)*slider_height );
		
		if( $( window ).width() > 1200 )
		{
			$('.da-img').css( "height", slider_height );
			$('.ibanner .owl-carousel .owl-wrapper-outer').css( "height", slider_height );
		} else
		{
			$('.da-img').css( "height", slider_height*(2/3));
			$('.ibanner .owl-carousel .owl-wrapper-outer').css( "height", slider_height*(2/3) );			
		}		
		
		
		if (slider_parallax == 1)
		{		
			var slidetop = parseInt($('.ibanner').offset().top);
			
			if( $( window ).width() > 999 )
			{	
				
				$(window).scroll(function(){
					var newvalue = parseInt($(this).scrollTop()*0.80)-56;
					
					if ($(this).scrollTop() > slidetop)
					{
						$('.da-img').css('background-position', 'center '+newvalue+'px');	
					}
					
					if ($(this).scrollTop() <= slidetop)
					{
						var slideheight = $('.active .da-img').height();
						$('.da-img').css('background-position', 'center 0px');
						$('.owl-wrapper-outer').css('max-height', slideheight+'px');
					}
					/**/
				});
			}
		}

	}
	/**/	

	
});

/* scripts to run as loads */

(function($) {
	
	/* acrolling header */
	var nav_container = $(".headerwrap");
	var nav = $(".site-header");

	var top_spacing = 00;
	var waypoint_offset = 00;
	
	if( $( window ).width() > 999 )
	{
		if ( $(".admin-bar").length>0 )
		{
			if($( window ).width()<766)
			{
				var top_spacing = 0;
			} else
			{
				var top_spacing = 30;
			}
		} else
		{
			var top_spacing = 0;
		}
		nav_container.waypoint({
			handler: function(direction) {
				
				if (direction == 'down') {
					nav_container.css({ 'height':nav.outerHeight() });		
					nav.stop().addClass("fixeddiv").css("top",-nav.outerHeight()).animate({"top":top_spacing});
				} else {
				
					nav_container.css({ 'height':'auto' });
					nav.stop().removeClass("fixeddiv").css("top",nav.outerHeight()).animate({"top":""});
				}
				
			},
			offset: function() {
				return -nav.outerHeight()-waypoint_offset;
			}
		});
	}

	/* no utility bar class addition */
	if ( $('.utilitybar').length == 0 )
	{
		$('.headerwrap').addClass('noutility');
	}
	
	//$('#content #blog-cols .post.type-post, .tx-blog .tx-blog-item').each(function (index) {
	$('.twocol-blog #content #blog-cols .post').each(function (index) {		
		var _this = $(this);
			
		_this.css('visibility', 'hidden').addClass('animated');
		_this.one('inview', function () {
			setTimeout( function () {
				_this.css('visibility', 'visible').addClass('fadeInUp');
			}, (Math.floor((Math.random() * 320) + 24)));
		});
			
	});	
	

	$('.onecol-blog #primary .entry-thumbnail, .onecol-blog #primary .post-mainpart').css('visibility', 'hidden').addClass('animated');
	$('.onecol-blog #primary .entry-thumbnail').one('inview', function() {
		$(this).css('visibility', 'visible').addClass( 'fadeInLeft' );
	});
	
	$('.onecol-blog #primary .post-mainpart').one('inview', function() {
		$(this).css('visibility', 'visible').addClass( 'fadeInRight' );
	});
	/*	*/

	
	

	// Banner Fullscreen
	/*	
	if ( $('.ibanner').length > 0 )
	{
		var txwinHeight = $(window).height();
		$('.da-img').height(txwinHeight);
		$('body').addClass('nx-fullscreen');
	}
	*/
	

	if ( $('.ibanner').length > 0 || $('.tx-slider').length > 0 )
	{
		$('body').addClass('nx-fullscreen');
		
		if($('.tx-slider').length > 0)
		{
			$(".nx-fullscreen .utilitybar").css("display", "none");
		}
	}
	
	if($(".home").length > 0)
	{
		$('ul.nav-menu > li > a[href*=#]').on('click', function(event){     
			event.preventDefault();
			$('html,body').animate({scrollTop:($(this.hash).offset().top)-100}, 500);
		});
	}
	
	$('a[href*="#"]:not([href="#"])').click(function() {
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
			var target = $(this.hash);
			target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
			if (target.length) {
				$('html, body').animate({
					scrollTop: target.offset().top
				}, 1000);
				return false;
		  	}
		}
	});		
		
})(jQuery);
/**/

jQuery(document).ready(function($) {

	//footer#colophon.site-footer

	function fixfooter() {  
		var footerheight = $('.site-footer').height();
		console.log(footerheight);
			
		var footer_styles = {
			"z-index" : "-1",
			"position" : "fixed",
			"left" : "0px",	
			"bottom" : "0px",
			"right" : "0px",
			"overflow" : "hidden"					
		}
	
		var site_main_styles = {
			"z-index" : "1"
		}
		
		var footer_filler_style = {
			"height" : footerheight,
			"background" : "transparent"	
		}
		
		var body_page_style = {
			"margin-bottom" : footerheight
		}	
		
		$('#colophon.site-footer').css( footer_styles );
		
		//$('.tx-footer-filler').css( footer_filler_style );
		
		$('#main.site-main').css( site_main_styles );
		
		$('#page.site').css( body_page_style );		   
	}	
	
	/**/
	if( ( $('.nx-wide').length > 0 ) && ( $(window).width() > 1200) ) {
		setTimeout(fixfooter, 2000)
	}
	
	if( $(".hideubar").length > 0 ) {
		$(".nx-fullscreen .utilitybar").css("display", "none");
	}
	
	// Video slider
	if ( $('.home').length > 0 && $('.home-slider-off').length > 0 )
	{
		//console.log("it should be : "+(((winheight)/100)*header_height));
		var header_height = $('.iheader').data('header-height');
		var video_id = $('.iheader').data('video-id');
		
		var winheight = $( window ).height();
		var winwidth = $( window ).width();
		
		if( winwidth > 1200 )
		{
			$('.iheader').css( "height", ((winheight)/100)*header_height );
			//console.log("it should be : "+(((winheight)/100)*header_height));
		} else
		{
			$('.iheader').css( "height", winheight/2);
		}
		
		embed_code = '<iframe src="https://www.youtube.com/embed/'+video_id+'?controls=0&showinfo=0&rel=0&autoplay=1&loop=1&playlist='+video_id+'" frameborder="0" allowfullscreen></iframe>';
		if( video_id ) {
			$(".video-foreground").append(embed_code);
		}				
	}
	
	$(window).load(function(){	
		// hide the preloader
		if ( $( 'body' ).hasClass( 'nx-preloader' ))
		{					
			$( '.nx-preloader .nx-ispload' ).css( "display", "none" );
		}
	});	
		
});
