<?php 
/*-----------------------------------------------------------------------------------*/
/* Social icons																		*/
/*-----------------------------------------------------------------------------------*/
function idesign_social_icons () {
	
	$socio_list = '';
	$siciocount = 0;
	$services = array ('facebook','twitter','flickr','feed','instagram','googleplus','youtube','pinterest','linkedin');
    
		$socio_list .= '<ul class="social">';	
		foreach ( $services as $service ) :
			
			$active[$service] = esc_url( get_theme_mod('itrans_social_'.$service, '#') );
			if ($active[$service]) { 
				$socio_list .= '<li><a href="'.$active[$service].'" title="'.$service.'" target="_blank"><i class="genericon socico genericon-'.$service.'"></i></a></li>';
				$siciocount++;
			}
			
		endforeach;
		$socio_list .= '</ul>';
		
		if($siciocount>0)
		{	
			return $socio_list;
		} else
		{
			return;
		}
}

/*-----------------------------------------------------------------------------------*/
/* ibanner Slider																		*/
/*-----------------------------------------------------------------------------------*/
function idesign_ibanner_slider () {    
	$arrslidestxt = array();
	$template_dir = get_template_directory_uri();
	$banner_text = get_theme_mod('banner_text', '');
	$slider_height = esc_attr(get_theme_mod('slider_height', 100));
	
	$upload_dir = wp_upload_dir();
	$upload_base_dir = $upload_dir['basedir'];
	$upload_base_url = $upload_dir['baseurl'];
	
	$shortcut_text = __('Edit Slides', 'i-design');	
	
	//$classes[] = 'nx-fullscreen';	
	
    for( $slideno=1; $slideno<=4; $slideno++ ){
		
			$strret = '';
			
			$slide_title = esc_attr(get_theme_mod('itrans_slide'.$slideno.'_title', '' ));
			$slide_desc = esc_attr(get_theme_mod('itrans_slide'.$slideno.'_desc', ''));
			$slide_linktext = esc_attr(get_theme_mod('itrans_slide'.$slideno.'_linktext', ''));
			$slide_linkurl = esc_url(get_theme_mod('itrans_slide'.$slideno.'_linkurl', ''));
			$slide_image = esc_url(get_theme_mod('itrans_slide'.$slideno.'_image', get_template_directory_uri() . '/images/slide'.$slideno.'.jpg'));
			
			$slider_image_id = idesign_get_attachment_id_from_url( $slide_image );			
			$slider_resized_image = wp_get_attachment_image_src( $slider_image_id, 'idesign-slider-thumb' );
			
			
			if ( $slide_image ) {

				if( $slide_image != '' ){
					if( file_exists( str_replace($upload_base_url,$upload_base_dir,$slide_image) ) ){
						$strret .= '<div class="da-img" style="background-image:URL(' . $slider_resized_image[0] .');"><div class="nx-tscreen"></div></div>';
					}
					else
					{
						$slide_image = $template_dir.'/images/slide'.$slideno.'.jpg';
						$strret .= '<div class="da-img noslide-image" style="background-image:URL(' . $slide_image .');"><div class="nx-tscreen"></div></div>';					
					}
				}
				else
				{					
					$slide_image = $template_dir.'/images/no-image.jpg';
					$strret .= '<div class="da-img noslide-image" style="background-image:URL(' . $slide_image .');"><div class="nx-tscreen"></div></div>';
				}
				
				$strret .= '<div class="slider-content-wrap"><div class="nx-slider-container">';
				if( !empty($slide_title) ){$strret .= '<h2>'.$slide_title.'</h2>';}
				if( !empty($slide_desc) ){
					$strret .= '<p>'.$slide_desc.'</p>';
				} else {
					$strret .= '<div class="clear" style="height:16px;"></div>';
				}
				if( !empty($slide_linktext) ){$strret .= '<a href="'.$slide_linkurl.'" class="da-link">'.$slide_linktext.'</a>';}
				$strret .= '</div></div>';
			}
			
			if ( $strret != '' ){
				$arrslidestxt[$slideno] = $strret;
			}
			
					
	}
	
	$sliderscpeed = intval(esc_attr(get_theme_mod('itrans_sliderspeed', '6'))) * 1000 ;	
	
			
	$itrans_sliderparallax = get_theme_mod('itrans_sliderparallax', 1);
	$itrans_slideroverlay = get_theme_mod('slider_overlay', 1);		
	$ubar_stat = get_theme_mod('slider_ubar', 0);	

	if( $itrans_slideroverlay == 1 )
	{
		$overlayclass = "overlay";
	} else
	{
		$overlayclass = "";
	}
	
	if( $ubar_stat == 0 )
	{
		$ubarclass = "hideubar";
	} else
	{
		$ubarclass = "showubar";
	}		
	
	
	if( count( $arrslidestxt) > 0 ){
		echo '<div class="ibanner ' . $overlayclass . ' ' . $ubarclass . '">';
		echo '	<div id="da-slider" class="da-slider" role="banner" data-slider-speed="'.$sliderscpeed.'" data-slider-parallax="'.$itrans_sliderparallax.'" data-edit-slides="'.$shortcut_text.'" data-slider-height="'.$slider_height.'">';
			
		foreach ( $arrslidestxt as $slidetxt ) :
			echo '<div class="nx-slider">';	
			echo	$slidetxt;
			echo '</div>';
		endforeach;
		
		echo '	</div>';
		echo '</div>';
	} else
	{
        echo '<div class="iheader front">';
        echo '    <div class="titlebar">';
        echo '        <h1>';
		
		if ($banner_text) {
			echo esc_html($banner_text);
		} 
        echo '        </h1>';
		echo ' 		  <h2>';

		echo '		</h2>';
        echo '    </div>';
        echo '</div>';
	}
}

/*-----------------------------------------------------------------------------------*/
/* find attachment id from url																	*/
/*-----------------------------------------------------------------------------------*/
function idesign_get_attachment_id_from_url( $attachment_url = '' ) {

    global $wpdb;
    $attachment_id = false;

    // If there is no url, return.
    if ( '' == $attachment_url )
        return;

    // Get the upload directory paths
    $upload_dir_paths = wp_upload_dir();

    // Make sure the upload path base directory exists in the attachment URL, to verify that we're working with a media library image
    if ( false !== strpos( $attachment_url, $upload_dir_paths['baseurl'] ) ) {

        // If this is the URL of an auto-generated thumbnail, get the URL of the original image
        $attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );

        // Remove the upload path base directory from the attachment URL
        $attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );

        // Finally, run a custom database query to get the attachment ID from the modified attachment URL
        $attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url ) );

    }

    return $attachment_id;
}


/*
 * add body class for i-design wpr menu
 *
 * @since i-design 1.0.1
 */
add_filter( 'body_class', 'idesign_slider_body_class' );
function idesign_slider_body_class( $classes ) {

	$hide_front_slider = get_theme_mod('slider_stat', 0);
	if ( ( is_home() && $hide_front_slider == 0 ) || ( is_front_page() && $hide_front_slider == 0 )  ) {
		$classes[] = 'home-slider-off';	
	}

	if ( is_home() && !is_front_page() && $hide_front_slider == 0 ) {
		$classes[] = 'nx-blog-only';	
	}	

	return $classes;
}

function idesign_get_video_id( $video_url ){
	
	if( (preg_match('/http:\/\/(www\.)*youtube\.com\/.*/',$video_url)) || (preg_match('/http:\/\/(www\.)*youtu\.be\/.*/',$video_url)) )
	{
		$video_id = ( preg_match( '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $video_url, $match ) ) ? $match[1] : false;
		return $video_id;
	} else
	{
		return false;
	}
}


/* Calling Theme Welcome on activation */
require_once( get_template_directory() . '/inc/theme-welcome/theme-welcome.php' );

/* activating all site origin widgets bundle */
function idesign_filter_active_widgets($active){
    $active['features'] = true;
    $active['icon'] = true;
	
    $active['button'] = true;	
    $active['layout-slider'] = true;	
    $active['social-media-buttons'] = true;	
    $active['call-to-action'] = true;
    $active['google-maps'] = true;	
    //$active['image'] = true;	
    //$active['post-carousel'] = true;	
    //$active['taxonomy'] = true;
    $active['contact'] = true;	
    $active['headline'] = true;	
    $active['image-grid'] = true;	
    $active['price-table'] = true;	
    //$active['testimonial'] = true;	
    $active['editor'] = true;	
    $active['hero'] = true;	
    $active['image-slider'] = true;
    $active['simple-masonry'] = true;
    $active['video'] = true;		
	
    return $active;
}
add_filter('siteorigin_widgets_active_widgets', 'idesign_filter_active_widgets');



/* Demo import by One Click Demo Import */
// include get_template_directory() . '/inc/one-click-demo-import/one-click-demo-import.php';

function idesign_import_files() {
  return array(
  	/**/
    array(
      'import_file_name'             	=> 'i-Design Demo Classic',
      'import_file_url'            		=> 'https://raw.githubusercontent.com/TemplatesNext/i-design-demo/master/i-design.wordpress-1.xml',
      'import_widget_file_url'     		=> 'https://raw.githubusercontent.com/TemplatesNext/i-design-demo/master/i-design-widgets.wie',
      'import_customizer_file_url' 		=> 'https://raw.githubusercontent.com/TemplatesNext/i-design-demo/master/i-design-export-1.dat',
      'import_preview_image_url'     	=> 'https://raw.githubusercontent.com/TemplatesNext/i-design-demo/master/i-design-demo-1.jpg',
      'import_notice'                	=> __( 'Please make sure you have plugin "TemplatesNext ToolKit" and "Contact Form 7" installed and active before you start the import process. <br> This process involves transfer of data and media from server to server and might take some time.', 'i-design' ),
	  'preview_url'                		=> 'http://templatesnext.org/idesign/',
    ),
	
    array(
      'import_file_name'             	=> 'i-Design Demo - Page Builder',
      'import_file_url'            		=> 'https://raw.githubusercontent.com/TemplatesNext/i-design-demo/master/i-design.wordpress-2.xml',
      'import_widget_file_url'     		=> 'https://raw.githubusercontent.com/TemplatesNext/i-design-demo/master/i-design-widgets.wie',
      'import_customizer_file_url' 		=> 'https://raw.githubusercontent.com/TemplatesNext/i-design-demo/master/i-design-export-2.dat',
      'import_preview_image_url'     	=> 'https://raw.githubusercontent.com/TemplatesNext/i-design-demo/master/i-design-demo-2.jpg',
      'import_notice'                	=> __( 'Please make sure you have plugin "TemplatesNext ToolKit" and "Contact Form 7" installed and active before you start the import process. <br> This process involves transfer of data and media from server to server and might take some time.', 'i-design' ),
	  'preview_url'                		=> 'http://www.templatesnext.org/idesign/?page_id=1040',	  
    ),	
  );
}
add_filter( 'pt-ocdi/import_files', 'idesign_import_files' );

add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );

function idesign_after_import_setup($selected_import) {
		if ( 'i-Design Demo Classic' === $selected_import['import_file_name'] ) {

		// Assign menus to their locations.
		$main_menu = get_term_by( 'name', 'main nav', 'nav_menu' );
	
		set_theme_mod( 'nav_menu_locations', array(
				'primary' => $main_menu->term_id,
			)
		);
		
		$front_page_id = get_page_by_title( 'Front Page' );
       	if ( isset( $front_page_id->ID ) ) {
			update_option( 'page_on_front', $front_page_id->ID );
        	update_option( 'show_on_front', 'page' );
       	}		
		
	} elseif ( 'i-Design Demo - Page Builder' === $selected_import['import_file_name'] ) {
	
		// Assign menus to their locations.
		$main_menu = get_term_by( 'name', 'main nav', 'nav_menu' );
		set_theme_mod( 'nav_menu_locations', array(
				'primary' => $main_menu->term_id,
			)
		);
		
		$front_page_id = get_page_by_title( 'Home - Page Builder' );
       	if ( isset( $front_page_id->ID ) ) {
			update_option( 'page_on_front', $front_page_id->ID );
        	update_option( 'show_on_front', 'page' );
       	}			
	
	}

}
add_action( 'pt-ocdi/after_import', 'idesign_after_import_setup' );

/* Delete The default Hello World Post before import */
/* Resetting default Widgets */
function ispirit_before_content_import( $selected_import ) {
	wp_delete_post(1);
	update_option( 'sidebars_widgets', $null );
}
add_action( 'pt-ocdi/before_content_import', 'ispirit_before_content_import' );

/* change title for page and menu */
function idesign_plugin_page_setup( $default_settings ) {
    $default_settings['page_title']  = esc_html__( 'i-Design One Click Demo Setup', 'i-design' );
    $default_settings['menu_title']  = esc_html__( 'i-Design Demo Setup' ,'i-design' );
    return $default_settings;
}
add_filter( 'pt-ocdi/plugin_page_setup', 'idesign_plugin_page_setup' );

