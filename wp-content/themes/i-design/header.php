<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package i-design
 * @since i-design 1.0
 */
?>
<?php

$top_phone = '';
$top_email = '';
$video_id = '';

$top_phone = esc_attr(get_theme_mod('top_phone', ''));
$top_email = sanitize_email(get_theme_mod('top_email', ''));
$show_search = get_theme_mod('show_search', 1);

$idesign_logo_trans = get_theme_mod( 'logo-trans', '' );
$custom_logo_id = get_theme_mod( 'custom_logo' );
$custom_logo_image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
$custom_logo_image = $custom_logo_image[0];

if(has_header_video())
{
	$video_id = idesign_get_video_id(get_header_video_url());
}

global $post; 

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> style="">
	<?php if( get_theme_mod('pre_loader', 0) == 1 ) : ?>
	<div class="nx-ispload">
        <div class="nx-ispload-wrap">
            <div class="nx-folding-cube">
                <div class="nx-cube1 nx-cube"></div>
                <div class="nx-cube2 nx-cube"></div>
                <div class="nx-cube4 nx-cube"></div>
                <div class="nx-cube3 nx-cube"></div>
            </div>
        </div>    
    </div>
    <?php endif; ?>
	<div id="page" class="hfeed site">

    	<div class="pacer-cover"></div>

        <?php if ( $top_email || $top_phone || idesign_social_icons() ) : ?>
    	<div id="utilitybar" class="utilitybar">
        	<div class="ubarinnerwrap">
                <div class="socialicons">
                    <?php echo idesign_social_icons(); ?>
                </div>
                <?php if ( !empty($top_phone) ) : ?>
                <div class="topphone tx-topphone">
                    <i class="topbarico genericon genericon-phone"></i>
                    <?php esc_html_e('Call us : ','i-design'); ?> <?php echo $top_phone; ?>
                </div>
                <?php endif; ?>
                
                <?php if ( !empty($top_email) ) : ?>
                <div class="topphone top_email">
                    <i class="topbarico genericon genericon-mail"></i>
                    <?php esc_html_e('Mail us : ','i-design'); ?> <?php echo $top_email; ?>
                </div>
                <?php endif; ?>                
            </div> 
        </div>
        <?php endif; ?>
        
        <div class="headerwrap">
            <header id="masthead" class="site-header" role="banner">
         		<div class="headerinnerwrap">

					<?php if ( $idesign_logo_trans && $custom_logo_image ) : ?>
                        <a class="home-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
                            <span>
                            	<?php if ( $custom_logo_image ) : ?><img src="<?php echo esc_url($custom_logo_image); ?>" class="idesign-logo normal-logo" /> <?php endif; ?>
                                <?php if ( $idesign_logo_trans ) : ?><img src="<?php echo esc_url($idesign_logo_trans); ?>" class="idesign-logo trans-logo" /><?php endif; ?>
                            </span>
                        </a>
                    <?php elseif ( $custom_logo_image ) : ?>
                        <a class="home-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
                            <span>
                            	<?php if ( $custom_logo_image ) : ?><img src="<?php echo esc_url($custom_logo_image); ?>" class="idesign-logo" /> <?php endif; ?>
                            </span>
                        </a>     
                    <?php elseif ( $idesign_logo_trans ) : ?>
                        <a class="home-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
                            <span>
                                <?php if ( $idesign_logo_trans ) : ?><img src="<?php echo esc_url($idesign_logo_trans); ?>" class="idesign-logo" /><?php endif; ?>
                            </span>
                        </a>                                                
                    <?php else : ?>
                        <span id="site-titlendesc">
                            <a class="home-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
                                <h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
                                <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>   
                            </a>
                        </span>
                    <?php endif; ?>	                    
        				<div class="nx-logo-shortcut" data-addtrans-logo="<?php esc_attr_e( 'Add Transparent Logo', 'i-design' ); ?>"></div>
                    <div id="navbar" class="navbar">
                        <nav id="site-navigation" class="navigation main-navigation" role="navigation">
                            <h3 class="menu-toggle"><?php _e( 'Menu', 'i-design' ); ?></h3>
                            <a class="screen-reader-text skip-link" href="#content" title="<?php esc_attr_e( 'Skip to content', 'i-design' ); ?>"><?php _e( 'Skip to content', 'i-design' ); ?></a>
                            <?php 
								if ( has_nav_menu(  'primary' ) ) {
										wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu', 'container_class' => 'nav-container', 'container' => 'div' ) );
									}
									else
									{
										wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-container' ) ); 
									}
								?>
							
                        </nav><!-- #site-navigation -->
                        <?php if( $show_search == 1 ) { ?>
                        <div class="topsearch">
                            <?php get_search_form(); ?>
                        </div>
                        <?php } ?>
                    </div><!-- #navbar -->
                    <div class="clear"></div>
                </div>
            </header><!-- #masthead -->
        </div>
        
        <!-- #Banner -->
        <?php
		
		$hide_title = $show_slider = $other_slider = $custom_title = $hide_breadcrumb = "";
		if ( function_exists( 'rwmb_meta' ) ) {
			$hide_title = rwmb_meta('idesign_hidetitle');
			$show_slider = rwmb_meta('idesign_show_slider');
			$other_slider = rwmb_meta('idesign_other_slider');
			$custom_title = rwmb_meta('idesign_customtitle');
			$hide_breadcrumb = rwmb_meta('idesign_hide_breadcrumb');
		}
		
		$hide_front_slider = get_theme_mod('slider_stat', 0);
		$other_front_slider = get_theme_mod('blogslide_scode', '');
		$itrans_slogan = esc_attr(get_theme_mod('banner_text', get_bloginfo( 'description' )));
		$blog_header_heigh = esc_attr(get_theme_mod('blog_header_height', 100));
		
		$other_slider = esc_html($other_slider);
		$other_front_slider = esc_html($other_front_slider);
		
		if($other_slider) :
		?>
		
        <div class="other-slider" style="">
	       	<?php echo do_shortcode( htmlspecialchars_decode($other_slider) ) ?>
        </div>
		
		<?php	
		elseif ( ( is_home() && !is_paged() ) || $show_slider || ( is_front_page() && !$show_slider ) ) : 
		?>
            <?php if ( !empty($other_front_slider) && is_home() ) : ?>
            <div id="ibanner">
            	<?php echo do_shortcode( htmlspecialchars_decode($other_front_slider) ) ?>
            </div>    
        	<?php elseif ( $hide_front_slider != 0 || $show_slider ) : ?>
            <div id="ibanner">
            	<?php idesign_ibanner_slider(); ?>
            </div>
            
        	<?php else : ?>
            <div class="iheader ibanner hideubar" id="ibanner" data-header-height="<?php echo $blog_header_heigh; ?>" data-video-id="<?php echo $video_id; ?>" data-edittext="<?php esc_attr_e( 'Switch Slider', 'i-design' ); ?>" data-editheader="<?php esc_attr_e( 'Change Background Image/Video', 'i-design' ); ?>">
            	<div class="imagebg" style="background-image: url('<?php header_image(); ?>');"></div>
				<?php if( $video_id ) : ?>         
                <div class="video-background">
                    <div class="video-foreground">
                    </div>
                </div>
				<?php elseif ( has_header_video() ) : ?>
                <div class="video-background">
                	<div class="video-foreground">
                        <video width="100%" height="100%" autoplay loop>
                            <source src="<?php echo get_header_video_url(); ?>" type="video/mp4">
                        </video>
                    </div>                
                </div>             
                <?php endif; ?> 
                <div class="titlebar">
                    <h1 class="entry-title">
                        <?php
                            if ($itrans_slogan) {
                                echo esc_html($itrans_slogan);
                            }
                        ?>	                 
                    </h1>
                </div>
            </div>                                    
        	<?php endif; ?>            
            
        <?php 
		elseif(!$hide_title) : 
		?>
        <div class="iheader" style="">
        	<div class="titlebar">
            	
                <?php
					if( is_archive() )
					{
						echo '<h1 class="entry-title">';
								the_archive_title();                						
						echo '</h1>';
					} elseif ( is_search() )
					{
						echo '<h1 class="entry-title">';
							printf( __( 'Search Results for: %s', 'i-design' ), get_search_query() );					
						echo '</h1>';
					} else
					{
						if ( !empty($custom_title) )
						{
							echo '<h1 class="entry-title">'.esc_html($custom_title).'</h1>';
						}
						else
						{
							echo '<h1 class="entry-title">';
							the_title();
							echo '</h1>';
						}						
					}

            	?>
				<?php 
				
                    if(function_exists('bcn_display') && !$hide_breadcrumb )
                    {
				?>
                	<div class="nx-breadcrumb">
                <?php
                        bcn_display();
				?>
                	</div>
                <?php		
                    } 
                ?>               
            <div class="clear"></div>	
            </div>
        </div>
        
		<?php endif; ?>
		<div id="main" class="site-main">

