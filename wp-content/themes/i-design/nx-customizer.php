<?php

function idesign_customizer_config() {
	

    $url  = get_stylesheet_directory_uri() . '/inc/kirki/';
	
    /**
     * If you need to include Kirki in your theme,
     * then you may want to consider adding the translations here
     * using your textdomain.
     * 
     * If you're using Kirki as a plugin then you can remove these.
     */

    $strings = array(
        'background-color' => __( 'Background Color', 'i-design' ),
        'background-image' => __( 'Background Image', 'i-design' ),
        'no-repeat' => __( 'No Repeat', 'i-design' ),
        'repeat-all' => __( 'Repeat All', 'i-design' ),
        'repeat-x' => __( 'Repeat Horizontally', 'i-design' ),
        'repeat-y' => __( 'Repeat Vertically', 'i-design' ),
        'inherit' => __( 'Inherit', 'i-design' ),
        'background-repeat' => __( 'Background Repeat', 'i-design' ),
        'cover' => __( 'Cover', 'i-design' ),
        'contain' => __( 'Contain', 'i-design' ),
        'background-size' => __( 'Background Size', 'i-design' ),
        'fixed' => __( 'Fixed', 'i-design' ),
        'scroll' => __( 'Scroll', 'i-design' ),
        'background-attachment' => __( 'Background Attachment', 'i-design' ),
        'left-top' => __( 'Left Top', 'i-design' ),
        'left-center' => __( 'Left Center', 'i-design' ),
        'left-bottom' => __( 'Left Bottom', 'i-design' ),
        'right-top' => __( 'Right Top', 'i-design' ),
        'right-center' => __( 'Right Center', 'i-design' ),
        'right-bottom' => __( 'Right Bottom', 'i-design' ),
        'center-top' => __( 'Center Top', 'i-design' ),
        'center-center' => __( 'Center Center', 'i-design' ),
        'center-bottom' => __( 'Center Bottom', 'i-design' ),
        'background-position' => __( 'Background Position', 'i-design' ),
        'background-opacity' => __( 'Background Opacity', 'i-design' ),
        'ON' => __( 'ON', 'i-design' ),
        'OFF' => __( 'OFF', 'i-design' ),
        'all' => __( 'All', 'i-design' ),
        'cyrillic' => __( 'Cyrillic', 'i-design' ),
        'cyrillic-ext' => __( 'Cyrillic Extended', 'i-design' ),
        'devanagari' => __( 'Devanagari', 'i-design' ),
        'greek' => __( 'Greek', 'i-design' ),
        'greek-ext' => __( 'Greek Extended', 'i-design' ),
        'khmer' => __( 'Khmer', 'i-design' ),
        'latin' => __( 'Latin', 'i-design' ),
        'latin-ext' => __( 'Latin Extended', 'i-design' ),
        'vietnamese' => __( 'Vietnamese', 'i-design' ),
        'serif' => _x( 'Serif', 'font style', 'i-design' ),
        'sans-serif' => _x( 'Sans Serif', 'font style', 'i-design' ),
        'monospace' => _x( 'Monospace', 'font style', 'i-design' ),
    );	

	$args = array(
  
        // Change the logo image. (URL) Point this to the path of the logo file in your theme directory
                // The developer recommends an image size of about 250 x 250
        'logo_image'   => get_template_directory_uri() . '/images/logo.png',
  
        // The color of active menu items, help bullets etc.
        'color_active' => '#95c837',
		
		// Color used on slider controls and image selects
		//'color_accent' => '#dd9933',
		
		// The generic background color
		//'color_back' => '#f7f7f7',
	
        // Color used for secondary elements and desable/inactive controls
        'color_light'  => '#e7e7e7',
  
        // Color used for button-set controls and other elements
        'color_select' => '#34495e',
		 
        
        // For the parameter here, use the handle of your stylesheet you use in wp_enqueue
        'stylesheet_id' => 'customize-styles', 
		
        // Only use this if you are bundling the plugin with your theme (see above)
        'url_path'     => get_template_directory_uri() . '/inc/kirki/',

        'textdomain'   => 'i-design',
		
        'i18n'         => $strings,		
		
		
	);
	
	
	return $args;
}
add_filter( 'kirki/config', 'idesign_customizer_config' );


/**
 * Create the customizer panels and sections
 */
add_action( 'customize_register', 'idesign_add_panels_and_sections' ); 
function idesign_add_panels_and_sections( $wp_customize ) {
	
	/*
	* Add panels
	*/
	
	$wp_customize->add_panel( 'slider', array(
		'priority'    => 140,
		'title'       => __( 'Slider', 'i-design' ),
		'description' => __( 'Slides details', 'i-design' ),
	));
	
	$wp_customize->add_panel( 'rmenu', array(
		'priority'    => 140,
		'title'       => __( 'Responsive Menu', 'i-design' ),
		'description' => __( 'Responsive Menu Options', 'i-design' ),
	) );		

    /**
     * Add Sections
     */
    $wp_customize->add_section('basic', array(
        'title'    => __('Basic Settings', 'i-design'),
        'description' => '',
        'priority' => 130,
    ));
	
    $wp_customize->add_section('layout', array(
        'title'    => __('Layout Options', 'i-design'),
        'description' => '',
        'priority' => 130,
    ));	
	
    $wp_customize->add_section('social', array(
        'title'    => __('Social Links', 'i-design'),
        'description' => __('Insert full URL of your social link including &#34;http://&#34; replacing #, Empty the fileld if not using the link.', 'i-design'),
        'priority' => 130,
    ));		
	
    $wp_customize->add_section('blogpage', array(
        'title'    => __('Default Blog Page', 'i-design'),
        'description' => '',
        'priority' => 150,
    ));	
	
	// slider sections
	
	$wp_customize->add_section('slidersettings', array(
        'title'    => __('Slide Settings', 'i-design'),
        'description' => '',
        'panel' => 'slider',		
        'priority' => 140,
    ));		
	
	$wp_customize->add_section('slide1', array(
        'title'    => __('Slide 1', 'i-design'),
        'description' => '',
        'panel' => 'slider',		
        'priority' => 140,
    ));	
	$wp_customize->add_section('slide2', array(
        'title'    => __('Slide 2', 'i-design'),
        'description' => '',
        'panel' => 'slider',		
        'priority' => 140,
    ));	
	$wp_customize->add_section('slide3', array(
        'title'    => __('Slide 3', 'i-design'),
        'description' => '',
        'panel' => 'slider',		
        'priority' => 140,
    ));	
	$wp_customize->add_section('slide4', array(
        'title'    => __('Slide 4', 'i-design'),
        'description' => '',
        'panel' => 'slider',		
        'priority' => 140,
    ));	
	
    $wp_customize->add_section('typography', array(
        'title'    => __('Typography', 'i-design'),
        'description' => '',
        'priority' => 140,
    ));		
	
	// promo sections
	
	$wp_customize->add_section('nxpromo', array(
        'title'    => __('More About i-design', 'i-design'),
        'description' => '',
        'priority' => 170,
    ));	
	
	// Responsive Menu sections
	
	$wp_customize->add_section('rmgeneral', array(
        'title'    => __('General Options', 'i-design'),
        'panel' => 'rmenu',		
        'description' => '',
        'priority' => 170,
    ));	
	
    $wp_customize->add_section('rmsettings', array(
        'title'    => __('Menu Appearance', 'i-design'),
        'panel' => 'rmenu',
        'description' => '',
        'priority' => 180,
    ));						
	
}


function idesign_custom_setting( $controls ) {
	
    $controls[] = array(
        'type'     => 'text',
        'setting'  => 'top_phone',
        'label'    => __( 'Phone Number', 'i-design' ),
        'section'  => 'basic',
        'default'  => '1-000-123-4567',
        'priority' => 1,
		'description' => __( 'Phone number that appears on top bar.', 'i-design' ),
    );

	$controls[] = array(
		'type'        => 'switch',
		'setting'     => 'pre_loader',
		'label'       => __( 'Turn ON Page Preloader', 'i-design' ),
		'description' => __( 'Turn ON/OFF loding animation before page load', 'i-design' ),
		'section'     => 'basic',
		'default'     => 0,		
		'priority'    => 3,
	);		
	
    $controls[] = array(
        'type'     => 'text',
        'setting'  => 'top_email',
        'label'    => __( 'Email Address', 'i-design' ),
        'section'  => 'basic',
        'default'  => 'email@example.com',
        'priority' => 1,
		'description' => __( 'Email Id that appears on top bar.', 'i-design' ),		
    );

	$controls[] = array(
		'type'        => 'upload',
		'setting'     => 'logo-trans',
		'label'       => __( 'Reverse Transparent logo', 'i-design' ),
		'description' => __( 'Transparent logo for the fullscreen slider and dark background. Width 280px, height 72px max.', 'i-design' ),
        'section'  => 'basic',
		'default'     => '',		
		'priority'    => 1,
	);
	
	$controls[] = array(
		'type'        => 'switch',
		'setting'     => 'show_search',
		'label'       => __( 'Show Search', 'i-design' ),
		'description' => __( 'Show search option on main navigation', 'i-design' ),
		'section'     => 'basic',
		'default'     => 1,
		'priority'    => 3,
	);				
	
	$controls[] = array(
		'type'        => 'color',
		'setting'     => 'primary_color',
		'label'       => __( 'Primary Color', 'i-design' ),
		'description' => __( 'Choose your theme color', 'i-design' ),
		'section'     => 'layout',
		'default'     => '#e57e26',
		'priority'    => 1,
	);	
	
	$controls[] = array(
		'type'        => 'radio-image',
		'setting'     => 'blog_layout',
		'label'       => __( 'Blog Posts Layout', 'i-design' ),
		'description' => __( '(Choose blog posts layout (one column/two column)', 'i-design' ),
		'section'     => 'layout',
		'default'     => '2',
		'priority'    => 2,
		'choices'     => array(
			'1' => get_template_directory_uri() . '/images/onecol.png',
			'2' => get_template_directory_uri() . '/images/twocol.png',
		),
	);
	
	$controls[] = array(
		'type'        => 'switch',
		'setting'     => 'show_full',
		'label'       => __( 'Show Full Content', 'i-design' ),
		'description' => __( 'Show full content on blog pages', 'i-design' ),
		'section'     => 'layout',
		'default'     => 0,
		'priority'    => 3,
	);		
	
	$controls[] = array(
		'type'        => 'switch',
		'setting'     => 'wide_layout',
		'label'       => __( 'Wide layout', 'i-design' ),
		'description' => __( 'Check to have wide layout', 'i-design' ),
		'section'     => 'layout',
		'default'     => 1,
		'priority'    => 4,
	);
	
	// social links
	
    $controls[] = array(
        'type'     => 'text',
        'setting'  => 'itrans_social_facebook',
        'label'    => __( 'Facebook', 'i-design' ),
        'section'  => 'social',
        'default'  => '#',
        'priority' => 1,
    );	
	
    $controls[] = array(
        'type'     => 'text',
        'setting'  => 'itrans_social_twitter',
        'label'    => __( 'Twitter', 'i-design' ),
        'section'  => 'social',
        'default'  => '#',
        'priority' => 1,
    );
	
    $controls[] = array(
        'type'     => 'text',
        'setting'  => 'itrans_social_flickr',
        'label'    => __( 'Flickr', 'i-design' ),
        'section'  => 'social',
        'default'  => '#',
        'priority' => 1,
    );	
	
    $controls[] = array(
        'type'     => 'text',
        'setting'  => 'itrans_social_feed',
        'label'    => __( 'RSS', 'i-design' ),
        'section'  => 'social',
        'default'  => '#',
        'priority' => 1,
    );	
	
    $controls[] = array(
        'type'     => 'text',
        'setting'  => 'itrans_social_instagram',
        'label'    => __( 'Instagram', 'i-design' ),
        'section'  => 'social',
        'default'  => '#',
        'priority' => 1,
    );	
	
    $controls[] = array(
        'type'     => 'text',
        'setting'  => 'itrans_social_googleplus',
        'label'    => __( 'Google Plus', 'i-design' ),
        'section'  => 'social',
        'default'  => '#',
        'priority' => 1,
    );	
	
    $controls[] = array(
        'type'     => 'text',
        'setting'  => 'itrans_social_youtube',
        'label'    => __( 'YouTube', 'i-design' ),
        'section'  => 'social',
        'default'  => '#',
        'priority' => 1,
    );
	
    $controls[] = array(
        'type'     => 'text',
        'setting'  => 'itrans_social_pinterest',
        'label'    => __( 'Pinterest', 'i-design' ),
        'section'  => 'social',
        'default'  => '#',
        'priority' => 1,
    );	
	
    $controls[] = array(
        'type'     => 'text',
        'setting'  => 'itrans_social_linkedin',
        'label'    => __( 'Linkedin', 'i-design' ),
        'section'  => 'social',
        'default'  => '#',
        'priority' => 1,
    );	
	
	// Slider

	$controls[] = array(
		'type'        => 'slider',
		'setting'     => 'itrans_sliderspeed',
		'label'       => __( 'Slide Duration', 'i-design' ),
		'description' => __( 'Slide visibility in second', 'i-design' ),
		'section'     => 'slidersettings',
		'default'     => 6,
		'priority'    => 1,
		'choices'     => array(
			'min'  => 1,
			'max'  => 30,
			'step' => 1
		),
	);

	// Parallax Effect
	$controls[] = array(
		'type'        => 'switch',
		'setting'     => 'itrans_sliderparallax',
		'label'       => __( 'Parallax Effect', 'i-design' ),
		'description' => __( 'Turn ON/OFF Parallax Effect', 'i-design' ),
		'section'     => 'slidersettings',
		'default'     => 1,			
		'priority'    => 4,
	);
	
	$controls[] = array(
		'type'        => 'switch',
		'setting'     => 'slider_overlay',
		'label'       => __( 'Turn Off Slider Overlay Layer', 'i-design' ),
		'description' => __( 'Turn Off/on the dotted slider overlay layer', 'i-design' ),
		'section'     => 'slidersettings',
		'default'     => 1,
		'priority'    => 4,
	);	
	
	$controls[] = array(
		'type'        => 'switch',
		'setting'     => 'slider_ubar',
		'label'       => __( 'Turn On/Off Top Utilitybar', 'i-design' ),
		'description' => __( 'Turn Off/on the top utilitybar containing email/phone and socoal icon links', 'i-design' ),
		'section'     => 'slidersettings',
		'default'     => 0,
		'priority'    => 5,
	);	
	
	$controls[] = array(
		'type'        => 'slider',
		'settings'    => 'slider_height',
		'label'       => __( 'Slider Height (in %)', 'i-design' ),
		'section'     => 'slidersettings',
		'default'     => 100,
		'choices'     => array(
			'min'  => '0',
			'max'  => '100',
			'step' => '1',
		),
	);				
	
	
	// Slide1
    $controls[] = array(
        'type'     => 'text',
        'setting'  => 'itrans_slide1_title',
        'label'    => __( 'Slide1 Title', 'i-design' ),
        'section'  => 'slide1',
        'default'  => '',
        'priority' => 1,
    );
	$controls[] = array(
		'type'        => 'textarea',
		'setting'     => 'itrans_slide1_desc',
		'label'       => __( 'Slide1 Description', 'i-design' ),
		'section'     => 'slide1',
		'default'     => '',
		'priority'    => 10,
	);
    $controls[] = array(
        'type'     => 'text',
        'setting'  => 'itrans_slide1_linktext',
        'label'    => __( 'Slide1 Link text', 'i-design' ),
        'section'  => 'slide1',
        'default'  => '',
        'priority' => 1,
    );
    $controls[] = array(
        'type'     => 'text',
        'setting'  => 'itrans_slide1_linkurl',
        'label'    => __( 'Slide1 Link URL', 'i-design' ),
        'section'  => 'slide1',
        'default'  => '',
        'priority' => 1,
    );
	$controls[] = array(
		'type'        => 'upload',
		'setting'     => 'itrans_slide1_image',
		'label'       => __( 'Slide1 Image', 'i-design' ),
        'section'  	  => 'slide1',
		'default'     => get_template_directory_uri() . '/images/slide1.jpg',
		'priority'    => 1,
	);							
	
	
	// Slide2
    $controls[] = array(
        'type'     => 'text',
        'setting'  => 'itrans_slide2_title',
        'label'    => __( 'Slide2 Title', 'i-design' ),
        'section'  => 'slide2',
        'default'  => '',
        'priority' => 1,
    );
	$controls[] = array(
		'type'        => 'textarea',
		'setting'     => 'itrans_slide2_desc',
		'label'       => __( 'Slide2 Description', 'i-design' ),
		'section'     => 'slide2',
		'default'     => '',
		'priority'    => 10,
	);
    $controls[] = array(
        'type'     => 'text',
        'setting'  => 'itrans_slide2_linktext',
        'label'    => __( 'Slide2 Link text', 'i-design' ),
        'section'  => 'slide2',
        'default'  => '',
        'priority' => 1,
    );
    $controls[] = array(
        'type'     => 'text',
        'setting'  => 'itrans_slide2_linkurl',
        'label'    => __( 'Slide2 Link URL', 'i-design' ),
        'section'  => 'slide2',
        'default'  => '',
        'priority' => 1,
    );
	$controls[] = array(
		'type'        => 'upload',
		'setting'     => 'itrans_slide2_image',
		'label'       => __( 'Slide2 Image', 'i-design' ),
        'section'  	  => 'slide2',
		'default'     => get_template_directory_uri() . '/images/slide2.jpg',
		'priority'    => 1,
	);							
		
		
	// Slide3
    $controls[] = array(
        'type'     => 'text',
        'setting'  => 'itrans_slide3_title',
        'label'    => __( 'Slide3 Title', 'i-design' ),
        'section'  => 'slide3',
        'default'  => '',
        'priority' => 1,
    );
	$controls[] = array(
		'type'        => 'textarea',
		'setting'     => 'itrans_slide3_desc',
		'label'       => __( 'Slide3 Description', 'i-design' ),
		'section'     => 'slide3',
		'default'     => '',
		'priority'    => 10,
	);
    $controls[] = array(
        'type'     => 'text',
        'setting'  => 'itrans_slide3_linktext',
        'label'    => __( 'Slide3 Link text', 'i-design' ),
        'section'  => 'slide3',
        'default'  => '',
        'priority' => 1,
    );
    $controls[] = array(
        'type'     => 'text',
        'setting'  => 'itrans_slide3_linkurl',
        'label'    => __( 'Slide3 Link URL', 'i-design' ),
        'section'  => 'slide3',
        'default'  => '',
        'priority' => 1,
    );
	$controls[] = array(
		'type'        => 'upload',
		'setting'     => 'itrans_slide3_image',
		'label'       => __( 'Slide3 Image', 'i-design' ),
        'section'  	  => 'slide3',
		'default'     => get_template_directory_uri() . '/images/slide3.jpg',
		'priority'    => 1,
	);							
	
	
	// Slide2
    $controls[] = array(
        'type'     => 'text',
        'setting'  => 'itrans_slide4_title',
        'label'    => __( 'Slide4 Title', 'i-design' ),
        'section'  => 'slide4',
        'default'  => '',
        'priority' => 1,
    );
	$controls[] = array(
		'type'        => 'textarea',
		'setting'     => 'itrans_slide4_desc',
		'label'       => __( 'Slide4 Description', 'i-design' ),
		'section'     => 'slide4',
		'default'     => '',
		'priority'    => 10,
	);
    $controls[] = array(
        'type'     => 'text',
        'setting'  => 'itrans_slide4_linktext',
        'label'    => __( 'Slide4 Link text', 'i-design' ),
        'section'  => 'slide4',
        'default'  => '',
        'priority' => 1,
    );
    $controls[] = array(
        'type'     => 'text',
        'setting'  => 'itrans_slide4_linkurl',
        'label'    => __( 'Slide4 Link URL', 'i-design' ),
        'section'  => 'slide4',
        'default'  => '',
        'priority' => 1,
    );
	$controls[] = array(
		'type'        => 'upload',
		'setting'     => 'itrans_slide4_image',
		'label'       => __( 'Slide4 Image', 'i-design' ),
        'section'  	  => 'slide4',
		'default'     => get_template_directory_uri() . '/images/slide4.jpg',
		'priority'    => 1,
	);
	
	// Blog page setting
	
	$controls[] = array(
		'type'        => 'switch',
		'setting'     => 'slider_stat',
		'label'       => __( 'Turn ON/OFF i-design Slider', 'i-design' ),
		'description' => __( 'Turn Off or On to hide/show default i-design slider', 'i-design' ),
		'section'     => 'blogpage',
		'default'     => 0,
		'priority'    => 0,
	);	
	
    $controls[] = array(
        'type'     => 'text',
        'setting'  => 'blogslide_scode',
        'label'    => __( 'Other Slider Shortcode', 'i-design' ),
        'section'  => 'blogpage',
        'default'  => '',
		'description' => __( 'Enter a 3rd party slider shortcode, ex. meta slider, smart slider 2, wow slider, etc.', 'i-design' ),
        'priority' => 2,
    );
	
    $controls[] = array(
        'type'     => 'text',
        'setting'  => 'banner_text',
        'label'    => __( 'Banner Text', 'i-design' ),
        'section'  => 'blogpage',
        'default'  => get_bloginfo( 'description' ),
        'priority' => 3,
		'description' => __( 'if you are using a logo and want your site title or slogan to appear on the header banner', 'i-design' ),		
    );
	
	$controls[] = array(
		'type'        => 'slider',
		'settings'    => 'blog_header_height',
		'label'       => __( 'Image/Vedio Header Height (in %)', 'i-design' ),
		'section'     => 'blogpage',
		'default'     => 100,
		'choices'     => array(
			'min'  => '0',
			'max'  => '100',
			'step' => '1',
		),
	);		
	

	//rmgeneral
	//rmsettings

	$controls[] = array(
		'label' => __('Enable Mobile Navigation', 'i-design'),
		'description' => __('Check if you want to activate mobile navigation.', 'i-design'),
		'setting' => 'enabled',
		'default' => '1',
		'type' => 'checkbox',
        'section'  => 'rmgeneral',	
	);

	$controls[] = array(
		'label' => __('Elements to hide in mobile:', 'i-design'),
		'description' => __('Enter the css class/ids for different elements you want to hide on mobile separeted by a comma(,). Example: .nav,#main-menu ', 'i-design'),
		'setting' => 'hide',
		'default' => '',
		'type' => 'text',
        'section'  => 'rmgeneral',		
	);
	
	$controls[] = array(
		'label' => __('Enable Swipe', 'i-design'),
		'description' => __('Enable swipe gesture to open/close menus, Only applicable for left/right menu.', 'i-design'),
		'setting' => 'swipe',
		'default' => 'yes',
		'choices' => array('yes' => __('Yes', 'i-design'),'no' => __('No', 'i-design')),
		'type' => 'radio',
        'section'  => 'rmgeneral',		
	);
	
	$controls[] = array(
		'label' => __('Search Field Position', 'i-design'),
		'description' => __('Select the position of search box or simply hide the search box if you donot need it.', 'i-design'),
		'setting' => 'search_box',
		'default' => 'below_menu',
		'choices' => array('above_menu' => __('Above Menu', 'i-design'), 'below_menu' => __('Below Menu', 'i-design'), 'hide'=> __('Hide search box', 'i-design') ),
		'type' => 'select',
        'section'  => 'rmgeneral',		
	);
		
	$controls[] = array(
		'label' => __('Allow zoom on mobile devices', 'i-design'),
		'setting' => 'zooming',
		'default' => 'yes',
		'choices' => array('yes' => __('Yes', 'i-design'),'no' => __('No', 'i-design')),
		'type' => 'radio',
        'section'  => 'rmgeneral',	
	);
		

	// Responsive Menu Settings
	$controls[] = array(
		'label' => __('Menu Symbol Position', 'i-design'),
		'description' => __('Select menu icon position which will be displayed on the menu bar.', 'i-design'),
		'setting' => 'menu_symbol_pos',
		'default' => 'left',
		'choices' => array('left' => __('Left', 'i-design'),'right' => __('Right', 'i-design')),
		'type' => 'select',
        'section'  => 'rmsettings',	
	);

	$controls[] = array(
		'label' => __('Menu Text', 'i-design'),
		'description' => __('Entet the text you would like to display on the menu bar.', 'i-design'),
		'setting' => 'bar_title',
		'default' => __('MENU', 'i-design'),
		'type' => 'text',
        'section'  => 'rmsettings',			
	);

	$controls[] = array(
		'label' => __('Menu Open Direction', 'i-design'),
		'description' => __('Select the direction from where menu will open.', 'i-design'),
		'setting' => 'position',
		'default' => 'left',
		'choices' => array('left' => 'Left','right' => 'Right', 'top' => 'Top' ),
		'type' => 'select',
        'section'  => 'rmsettings',			
	);

	$controls[] = array(
		'label' => __('Display menu from width (in px)', 'i-design'),
		'description' => __(' Enter the width (in px) below which the responsive menu will be visible on screen', 'i-design'),
		'setting' => 'from_width',
		'default' => 1069,
		'type' => 'text',
        'section'  => 'rmsettings',			
	);

	$controls[] = array(
		'label' => __('Menu Width', 'i-design'),
		'description' => __('Enter menu width in (%) only applicable for left and right menu.', 'i-design'),
		'setting' => 'how_wide',
		'default' => '80',
		'type' => 'text',
        'section'  => 'rmsettings',			
	);
	
	$controls[] = array(
		'label' => __('Menu bar background color', 'i-design'),
		'description' => '',
		'setting' => 'bar_bgd',
		'default' => '#e57e26',
		'type' => 'color',
        'section'  => 'rmsettings',			
	);
	
	$controls[] = array(
		'label' => __('Menu bar text color', 'i-design'),
		'setting' => 'bar_color',
		'default' => '#F2F2F2',
		'type' => 'color',
        'section'  => 'rmsettings',			
	);
	
	$controls[] = array(
		'label' => __('Menu background color', 'i-design'),
		'setting' => 'menu_bgd',
		'default' => '#2E2E2E',
		'type' => 'color',
        'section'  => 'rmsettings',			
	);
	
	$controls[] = array(
		'label' => __('Menu text color', 'i-design'),
		'setting' => 'menu_color',
		'default' => '#CFCFCF',
		'type' => 'color',
        'section'  => 'rmsettings',			
	);
	
	$controls[] = array(
		'label' => __('Menu mouse over text color', 'i-design'),
		'setting' => 'menu_color_hover',
		'default' => '#606060',
		'type' => 'color',
        'section'  => 'rmsettings',			
	);
	
	$controls[] = array(
		'label' => __('Menu icon color', 'i-design'),
		'setting' => 'menu_icon_color',
		'default' => '#FFFFFF',
		'type' => 'color',
        'section'  => 'rmsettings',			
	);
	
	$controls[] = array(
		'label' => __('Menu borders(top & left) color', 'i-design'),
		'setting' => 'menu_border_top',
		'default' => '#0D0D0D',
		'type' => 'color',
        'section'  => 'rmsettings',		
	);
	
	$controls[] = array(
		'label' => __('Menu borders(bottom) color', 'i-design'),
		'setting' => 'menu_border_bottom',
		'default' => '#131212',
		'type' => 'color',
        'section'  => 'rmsettings',		
	);
	
	$controls[] = array(
		'label' => __('Enable borders for menu items', 'i-design'),
		'setting' => 'menu_border_bottom_show',
		'default' => 'yes',
		'choices' =>  array('yes' => __('Yes', 'i-design'),'no' => __('No', 'i-design')),
		'type' => 'radio',
        'section'  => 'rmsettings',			
	);	
	
	$controls[] = array(
		'type'        => 'custom',
		'settings'    => 'custom_demo',
		'section'     => 'nxpromo',
		'default'	  => '<div class="promo-box">
        <div class="promo-2">
        	<div class="promo-wrap">
            	<a href="http://templatesnext.org/idesign/" target="_blank">' . __('i-design Demo', 'i-design') . '</a>
                <a href="https://www.facebook.com/templatesnext" target="_blank">' . __('Facebook', 'i-design') . '</a> 
                <a href="http://templatesnext.org/ispirit/landing/forums/" target="_blank">' . __('Support', 'i-design') . '</a>                                 
                <a href="https://wordpress.org/support/view/theme-reviews/i-design#postform" target="_blank">' . __('Rate i-design', 'i-design') . '</a>                
            </div>
        </div>
		</div>',
		'priority' => 10,
	);
	
	// promos
	$controls[] = array(
		'type'        => 'custom',
		'settings'    => 'custom_demo',
		'section'     => 'nxpromo',
		'default'	  => '<div class="promo-box">
        <div class="promo-2">
        	<div class="promo-wrap">
                <a href="http://templatesnext.org/ispirit/landing/" target="_blank">Go Premium</a>	
            	<a href="https://wordpress.org/support/theme/i-design/reviews/?filter=5" target="_blank">Rate i-Design</a>
            	<a href="http://templatesnext.org/i-design/" target="_blank">i-Design Demo</a>
                <a href="https://www.facebook.com/templatesnext" target="_blank">Facebook</a> 
                <a href="http://templatesnext.org/ispirit/landing/forums/" target="_blank">Support</a>
                <!-- <a href="http://templatesnext.org/iexcel/docs">Documentation</a> -->
            </div>
        </div>
		</div>',
		'priority' => 10,
	);	
	
    return $controls;
}
add_filter( 'kirki/controls', 'idesign_custom_setting' );







