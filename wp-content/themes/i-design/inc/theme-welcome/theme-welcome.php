<?php


if (isset($_GET['activated']) && is_admin()) {
	set_transient( '_welcome_screen_activation_redirect', true, 30 );
}

add_action( 'admin_init', 'welcome_screen_do_activation_redirect' );
function welcome_screen_do_activation_redirect() {
  // Bail if no activation redirect
    if ( ! get_transient( '_welcome_screen_activation_redirect' ) ) {
    return;
  }

  // Delete the redirect transient
  delete_transient( '_welcome_screen_activation_redirect' );

  // Bail if activating from network, or bulk
  if ( is_network_admin() || isset( $_GET['activate-multi'] ) ) {
    return;
  }

  // Redirect to bbPress about page
  wp_safe_redirect( add_query_arg( array( 'page' => 'welcome-screen-about' ), admin_url( 'themes.php' ) ) );

}

add_action('admin_menu', 'welcome_screen_pages');

function welcome_screen_pages() {
	add_theme_page(
		'Welcome To Welcome i-Design',
		'About i-Design',
		'read',
		'welcome-screen-about',
		'welcome_screen_content',
		'dashicons-awards', 
		6 		
	);
}

function welcome_screen_content() {
	
	$logo_url = get_template_directory_uri() . '/inc/theme-welcome/i-design-welcome.jpg';
	$img_url = get_template_directory_uri() . '/inc/theme-welcome/images/';
	$active_tab = 'ispirit_about';
	$ocdi_buttont = "";
	if ( class_exists('OCDI_Plugin') ) {
		$ocdi_buttont = "button-enabled";
	} else
	{
		$ocdi_buttont = "button-disabled";
	} 	
	$details_theme = wp_get_theme();
	$name_version = $details_theme->get( 'Name' ) . " - " . $details_theme->get( 'Version' );
  	?>
  	<div class="wrapp">
        <div class="nx-info-wrap-2 welcome-panel">
        	
        	<div class="nx-info-wrap">
            	
                <div class="tx-wspace-24"></div>
                <div class="tx-wspace-24"></div>                
                <div class="welcome-logo"><img src="<?php echo $logo_url; ?>" alt="" class="welcome-logo-img" width="" /></div>
                <div class="nx-info-desc">
                	<div class="nx-welcome"><?php echo __( 'Welcome To ', 'i-design' ).$name_version; ?></div>
                    <p><?php printf( __( 'Congratulations! You are about to use one of the most feature rich and easy to customize WordPress theme.', 'i-design' ) ); ?></p>
                	<p>
                    <a class="" href="<?php echo admin_url(); ?>themes.php?page=tgmpa-install-plugins"><?php printf( __( 'Install Recommended Plugins', 'i-design' ) ); ?></a> 
					<?php printf( __( 'and <b>Kick start your website in one click</b>, Setup any one of our demo websites and edit/remove/add contents.', 'i-design' ) ); ?>
					<?php printf( __( 'We have <a href="http://templatesnext.org/idesign/" target="_blank"><b>Demo-1</b></a> and <a href="http://www.templatesnext.org/idesign/?page_id=1040" target="_blank"><b>Demo-2</b></a>, ready for you.', 'i-design' ) ); ?>                    
                    </p>
                	<a class="button button-primary button-hero" href="https://wordpress.org/support/theme/i-design/reviews/?filter=5"><?php printf( __( 'Post Your Review', 'i-design' ) ); ?></a>
                	<a class="button button-primary button-hero" href="http://templatesnext.org/ispirit/landing/"><?php printf( __( 'Go Premium', 'i-design' ) ); ?></a>
                </div>
                <div style="display: block; clear: both; padding-top: 56px; padding-bottom: 96px;">
                	<div style="text-align: center;">
                    	<div style="width: 100%; text-align:center; display: block; font-size: 24px; padding-bottom: 24px;">What Next?</div> 
                    </div>                 
                	<div style="text-align: center;">
                    	<a href="<?php echo admin_url(); ?>themes.php?page=tgmpa-install-plugins">
                        	<img src="<?php echo $img_url; ?>install-plugins.png" alt="" class="step-img" />
                        </a>
					</div>
                    <div style="display: block; clear: both; padding-top: 12px; padding-bottom: 8px;">
                    	<div style="width: 40%; text-align:right; display: block; float:left; min-height: 33px;">
                        	<img src="<?php echo $img_url; ?>arrow-down-left-right.png" alt="" class="step-arrow" />
                        </div>
                    	<div style="width: 20%; text-align:center; display: block; float:left; min-height: 33px;"></div>                        
                    	<div style="width: 40%; text-align:left; display: block; float:left; min-height: 33px;">
                        	<img src="<?php echo $img_url; ?>arrow-down-right.png" alt="" class="step-arrow" />
                        </div>                        
                    </div>
                    <div style="display: block; clear: both;">
                    	<div style="width: 40%; text-align:right; display: block; float:left; min-height: 33px;">
                    	<a href="<?php echo admin_url(); ?>themes.php?page=pt-one-click-demo-import">                        
                        	<img src="<?php echo $img_url; ?>one-click-demo-setup.png" alt="" class="step-img" />
                        </a>    
                        </div>
                    	<div style="width: 20%; text-align:center; display: block; float:left; min-height: 33px;"><span class="step-or"><?php printf( __( 'OR', 'i-design' ) ); ?></span></div>                        
                    	<div style="width: 40%; text-align:left; display: block; float:left; min-height: 33px;">
                       	<a href="<?php echo admin_url(); ?>customize.php">
                        	<img src="<?php echo $img_url; ?>start-cutomizing.png" alt="" class="step-img" />
                        </a>    
                        </div>                        
                    </div>
                </div>
                <div class="tx-wspace-24"></div>
                <div class="nx-admin-row">
                	<div class="one-four-col">
                    	<a href="http://www.templatesnext.org/icreate/?page_id=1030" target="_blank">
                            <div class="nx-dash"><span class="dashicons dashicons-video-alt2"></span></div>
                            <h3 class="tx-admin-link"><?php printf( __( 'Video Guide', 'i-design' ) ); ?></h3>
                        </a>
                    </div>
                	<div class="one-four-col">
                    	<a href="http://templatesnext.org/ispirit/landing/forums/" target="_blank">
                            <div class="nx-dash"><span class="dashicons dashicons-format-chat"></span></div>
                            <h3 class="tx-admin-link"><?php printf( __( 'Support Forum', 'i-design' ) ); ?></h3>
                        </a>
                    </div>
                	<div class="one-four-col">
                    	<a href="http://www.templatesnext.org/icreate/?page_id=541" target="_blank">
                            <div class="nx-dash"><span class="dashicons dashicons-migrate"></span></div>
                            <h3 class="tx-admin-link"><?php printf( __( 'TemplatesNext Toolkit', 'i-design' ) ); ?></h3>
                        </a>
                    </div>
                	<div class="one-four-col">
                    	<a href="https://www.facebook.com/templatesnext/" target="_blank">
                            <div class="nx-dash"><span class="dashicons dashicons-facebook-alt"></span></div>
                            <h3 class="tx-admin-link"><?php printf( __( 'Communit', 'i-design' ) ); ?>y</h3>
                        </a>
                    </div>                                                            
                </div>
                <div class="tx-wspace-24"></div>

                	<div class="nx-tab-content" style="font-size: 15px;"> 
                		<p>&nbsp;</p>
                        <h2><?php printf( __( 'Starting with i-Design', 'i-design' ) ); ?></h2>
                        <ol>
                        	<li><b>Install Plugins : </b> To install and activate all the recommended plugin at once, go to 
                            	menu "Appearance" > "<a href="<?php echo admin_url(); ?>themes.php?page=tgmpa-install-plugins">Install Plugins</a>".</li>
                        	<li><b>One Click Demo Setup : </b> i-design comes with "<a href="<?php echo admin_url(); ?>themes.php?page=pt-one-click-demo-import">One Click Demo Setup</a>", You can import and setup copy of any of our demo website in one click. </li>                                  
                        	<li><b>Start Customizing : </b>To start setting up your theme go to menu "Appearance" > "<a href="<?php echo admin_url(); ?>customize.php">Customize</a>".</li>
                        </ol>
        			</div>
                    
                <div class="tx-wspace-24"></div><div class="tx-wspace-24"></div>    
 	
            </div>

                <div id="dashboard_right_now" class="postbox" style="display: block; float: right; width: 33%; max-width: 320px; margin: 16px;">
                    <h2 class="hndle nxw-title" style="padding: 12px 24px;"><span>Help Us With Your Review</span></h2>
                    <div class="inside">
                        <div class="main" style="padding: 24px;">
							<p style="padding-bottom: 12px; font-size: 15px; color: #555;"><b>If you like i-design</b>, share few words in your review, it helps the theme to spread. 
                            Few words of appriciation also motivates the designers and the developers.</p>
                            
                            <p style="padding-bottom: 12px; font-size: 15px; color: #555;">If you have not posted your review/feedback yet, we request you to post your review.</p>
                    		<a class="button button-primary button-hero" target="_blank" href="https://wordpress.org/support/theme/i-design/reviews/?filter=5">Post Your Review</a> 
                            <p style="padding-top: 6px; font-size: 15px; color: #555;"><b>Thanks in Advance</b><br /><span style="font-size: 12px;"><i>Team TemplatesNext</i></span></p>                            

                        </div>
                    </div>
                </div>   

            <div class="tx-wspace"></div>
        
            
            
        </div>
        
  	</div>
  
  	<?php
}

add_action( 'admin_head', 'welcome_screen_remove_menus' );

function welcome_screen_remove_menus() {
    remove_submenu_page( 'index.php', 'welcome-screen-about' );
}

add_action('admin_head', 'nx_welcome_style');

function nx_welcome_style() {
  	echo '<style>
		.step-arrow {
			opacity: 0.5;
		}
		.nxw-title {
			background-color: #0085ba;
			color: #FFFFFF;
			font-size: 16px;
			padding: 6px 12px;
		}
		.step-or {
			font-size: 26px;
			font-weight: 600;
			line-height: 33px;
		}
		.step-img {
			width: 280px;
			max-width: 100%;
		}
		.nx-info-wrap {
			display: block;
			float: left;
			max-width: 960px;
			padding: 12px;
			display: inline-block;
		}
		
		.welcome-panel .nx-welcome,
		.nx-info-wrap .nx-welcome {
			font-size: 28px; 
			font-weight: 600; 
			padding-bottom: 0px;
			line-height: 32px;
		}
		
		.nx-info-wrap .nx-info-desc {
			font-size: 16px;
			line-height: 22px;
			display: block;
			float: left;
			width: 50%;
		}
		
		.nx-info-wrap .nx-info-desc	p {
			font-size: 16px;
			line-height: 22px;			
		}
		
		.welcome-logo {
			display: block;
			float: left;
			width: 50%;
		}
		.welcome-logo-img {
			width: 100%;
			max-width: 100%;
		}
		.nx-admin-row {
			display: block;
			clear: both;
			box-sizing: border-box;
		}
		.nx-admin-row:after {
			display: table;
			clear: both;
			width: 100%;
			content: " ";
			display: block;
		}
		.one-four-col {
			display: block;
			float: left;
			width: 24%;
			padding: 16px;
			box-sizing: border-box;	
			text-align: center;
			background-color: #f1f1f1;
			margin-right: 1%;
		}
		.one-four-col:hover {
			background-color: #FFFFFF;
		}
		.one-four-col a {
			display: block;
		}				
		
		.one-four-col:last-child {
			margin-right: 0px;
		}		
		.one-four-col h3 {
			text-transform: uppercase;
		}		
		.nx-dash {
			font-size: 48px;
			line-height: 80px;
			width: 80px;
			border: 4px solid #95c837;
			margin: auto;
			border-radius: 42px;
		}		
		.nx-dash span {
			font-size: 48px;
			line-height: 80px;
			width: 64px;
			color: #95c837;
		}
		
		.nx-kick,
		.nx-kick:visited {
			background-color: #dd9933;
			color: #FFF;
		}
		.tx-wspace {
			display: block;
			clear: both;
			width: 100%;
			height: 120px;
		}
		.tx-wspace-12,
		.tx-wspace-24 {
			display: block;
			clear: both;
			width: 100%;
			height: 12px;
			content: " ";
		}
		.tx-wspace-24 {
			height: 24px;
		}			
		.nx-tab-content {
			font-size: 15px;
		}
		.nx-tab-content p {
			font-size: 15px;
		}
		.nx-red {
			color: #b40000;
		}
		.nx-tab-content h4 {
			padding: 0px;
			margin: 0px;
			margin-top: 12px;
		}
		
  	</style>';
}


