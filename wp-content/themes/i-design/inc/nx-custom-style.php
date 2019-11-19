<?php
	
	/*
	*
	*	nx Theme Functions
	*	------------------------------------------------
	*	nx Framework v 1.0
	*
	*	nx_custom_styles()
	*	nx_custom_script()
	*	nx_go_to_top()		
	*
	*/

 	/* CUSTOM CSS OUTPUT
 	================================================== */
 	if (!function_exists('idesign_custom_styles')) { 
		function idesign_custom_styles() {
			
			global  $idesign_data;
			$custom_css = "";
			$body_font_size = "13";
			$body_line_height = "24";
			$menu_font_size = "13";
			$primary_color = "#e57e26";

			$primary_color = esc_attr(get_theme_mod('primary_color', '#e57e26'));

			

			echo '<style type="text/css">'. "\n";
			
			echo 'themecolor {color: '.$primary_color.';}';
			echo 'themebgcolor {background-color: '.$primary_color.';}';
			echo 'themebordercolor {border-color: '.$primary_color.';}';	
			
			echo '.tx-slider .owl-pagination .owl-page > span { background: transparent; border-color: '.$primary_color.';  }';
			echo '.tx-slider .owl-pagination .owl-page.active > span { background-color: '.$primary_color.'; }';
			echo '.tx-slider .owl-controls .owl-buttons .owl-next, .tx-slider .owl-controls .owl-buttons .owl-prev { background-color: '.$primary_color.'; }';									
			
			//echo '.nav-container > ul li a {font-size: '. $menu_font_size .'px;}';
			
			echo 'a,a:visited,.blog-columns .comments-link a:hover, .socialicons ul.social li a:hover .socico {color: '.$primary_color.';}';

			echo 'input:focus,textarea:focus {border: 1px solid '.$primary_color.';}';
			
			echo 'button,input[type="submit"],input[type="button"],input[type="reset"],.nav-container .current_page_item > a > span,.nav-container .current_page_ancestor > a > span,.nav-container .current-menu-item > a span,.nav-container .current-menu-ancestor > a > span,.nav-container li a:hover span {background-color: '.$primary_color.';}';

			echo '.nav-container li:hover > a,.nav-container li a:hover {color: '.$primary_color.';}';

			echo '.nav-container .sub-menu,.nav-container .children {border-top: 2px solid '.$primary_color.';}';

			echo '.ibanner,.da-dots span.da-dots-current,.tx-cta a.cta-button, .utilitybar {background-color: '.$primary_color.';}';

			echo '#ft-post .entry-thumbnail:hover > .comments-link,.tx-folio-img .folio-links .folio-linkico,.tx-folio-img .folio-links .folio-zoomico {background-color: '.$primary_color.';}';

			echo '.entry-header h1.entry-title a:hover,.entry-header > .entry-meta a:hover {color: '.$primary_color.';}';

			echo '.featured-area div.entry-summary > p > a.moretag:hover {background-color: '.$primary_color.';}';

			echo '.site-content div.entry-thumbnail .stickyonimg,.site-content div.entry-thumbnail .dateonimg,.site-content div.entry-nothumb .stickyonimg,.site-content div.entry-nothumb .dateonimg {background-color: '.$primary_color.';}';

			echo '.entry-meta a,.entry-content a,.comment-content a,.entry-content a:visited {color: '.$primary_color.';}';

			echo '.format-status .entry-content .page-links a,.format-gallery .entry-content .page-links a,.format-chat .entry-content .page-links a,.format-quote .entry-content .page-links a,.page-links a {background: '.$primary_color.';border: 1px solid '.$primary_color.';color: #ffffff;}';

			echo '.format-gallery .entry-content .page-links a:hover,.format-audio .entry-content .page-links a:hover,.format-status .entry-content .page-links a:hover,.format-video .entry-content .page-links a:hover,.format-chat .entry-content .page-links a:hover,.format-quote .entry-content .page-links a:hover,.page-links a:hover {color: '.$primary_color.';}';

			echo '.iheader.front {background-color: '.$primary_color.';}';

			echo '.navigation a,.tx-post-row .tx-folio-title a:hover,.tx-blog .tx-blog-item h3.tx-post-title a:hover {color: '.$primary_color.';}';

			echo '.paging-navigation div.navigation > ul > li a:hover,.paging-navigation div.navigation > ul > li.active > a {color: '.$primary_color.';	border-color: '.$primary_color.';}';

			echo '.comment-author .fn,.comment-author .url,.comment-reply-link,.comment-reply-login,.comment-body .reply a,.widget a:hover {color: '.$primary_color.';}';

			echo '.widget_calendar a:hover {background-color: '.$primary_color.';	color: #ffffff;	}';

			echo '.widget_calendar td#next a:hover,.widget_calendar td#prev a:hover {background-color: '.$primary_color.';color: #ffffff;}';

			echo '.site-footer div.widget-area .widget a:hover, .nx-fullscreen .site-header:not(.fixeddiv) .nav-container .nav-menu > li > a:hover {color: '.$primary_color.';}';

			echo '.site-main div.widget-area .widget_calendar a:hover,.site-footer div.widget-area .widget_calendar a:hover {	background-color: '.$primary_color.';color: #ffffff;}';
						
			echo '.widget a:visited { color: #373737;}';

			echo '.widget a:hover,.entry-header h1.entry-title a:hover,.error404 .page-title:before,.tx-post-comm:after {color: '.$primary_color.';}';

			echo '.da-dots > span > span {background-color: '.$primary_color.';}';

			echo '.iheader,.format-status, .nx-preloader .nx-ispload {background-color: '.$primary_color.';}';
			
			echo '.tx-cta {border-left: 6px solid '.$primary_color.';}';
			
			echo '.paging-navigation #posts-nav > span:hover, .paging-navigation #posts-nav > a:hover, .paging-navigation #posts-nav > span.current, .paging-navigation #posts-nav > a.current, .paging-navigation div.navigation > ul > li a:hover, .paging-navigation div.navigation > ul > li > span.current, .paging-navigation div.navigation > ul > li.active > a {border: 1px solid '.$primary_color.';color: '.$primary_color.';}';
			
			echo '.entry-title a { color: #141412;}';
			
			echo '.nav-container ul.nav-menu > li > ul a:hover { background-color:'.$primary_color.'; color: #FFF; }';
			
			echo '.site-footer .widget-area .widget input[type="submit"],.site .tx-slider .tx-slide-button a,.ibanner .da-slider .owl-item.active .da-link  { background-color: '.$primary_color.'; color: #FFF; }';
			echo '.site-footer .widget-area .widget input[type="submit"]:hover,.site .tx-slider .tx-slide-button a:hover  { background-color: #373737; color: #FFF; }';
			
			echo '.nav-container .sub-menu, .nav-container .children { border-bottom: 4px solid '.$primary_color.';}';
			
			echo '.tx-service .tx-service-icon span {background-color:'.$primary_color.'; color: #FFF; border: 4px solid #e7e7e7;}';
			
			echo '.tx-service .tx-service-icon span i {color: #FFF;}';
			
			echo '.tx-service:hover .tx-service-icon span {background-color: #FFF; color:'.$primary_color.'; border: 4px solid '.$primary_color.';}';
			
			echo '.tx-service:hover .tx-service-icon span i {color: '.$primary_color.';}';
			
			echo '.ibanner .da-slider .owl-controls .owl-page span { border-color:'.$primary_color.'; }';	
			echo '.ibanner .da-slider .owl-controls .owl-page.active span, .ibanner .da-slider .owl-controls.clickable .owl-page:hover span {  background-color: '.$primary_color.'; }';
			echo '.sldprev, .ibanner .da-slider .owl-prev, .sldnext, .ibanner .da-slider .owl-next {  background-color: '.$primary_color.'; }';
			
			echo '.site-footer .widget-area .widget input[type="submit"],.site .tx-slider .tx-slide-button a,.ibanner .da-slider .owl-item.active .da-link  { background-color: '.$primary_color.'; color: #FFF; }';
			echo '.site-footer .widget-area .widget input[type="submit"]:hover,.site .tx-slider .tx-slide-button a:hover  { background-color: #373737; color: #FFF; }';
			
			echo '.colored-drop .nav-container ul ul a, .colored-drop ul.nav-container ul a, .colored-drop ul.nav-container ul, .colored-drop .nav-container ul ul {background-color: '.$primary_color.';}';
			echo '.pagination .nav-links > span:hover, .pagination .nav-links > a:hover, .pagination .nav-links > span.current, .pagination .nav-links > a.current { color: '.$primary_color.'; border-color: '.$primary_color.'; } ';			
		
			echo '.vslider_button, .vslider_button:visited { background-color:'.$primary_color.'!important; }';
			
			if ($custom_css) {
			echo "\n".'/* =============== user styling =============== */'."\n";
			echo $custom_css;
			}
			
			// CLOSE STYLE TAG
			echo "</style>". "\n";
		}
	
		add_action('wp_head', 'idesign_custom_styles');
	}
	
	/* CUSTOM JS OUTPUT
	================================================== 
	function nx_custom_script() {
		
		global  $idesign_data;
		
		$custom_js = $idesign_data['custom_js'];
		
		if ($custom_js) {			
			echo "\n<script>\n".$custom_js."\n</script>\n";			
		}
	}
	
	add_action('wp_footer', 'nx_custom_script');
		
*/
?>