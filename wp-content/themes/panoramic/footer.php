<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package panoramic
 */
?>
</div><!-- #content -->

<footer id="colophon" class="site-footer" role="contentinfo">
	
	<div class="site-footer-widgets">
        <div class="site-container">
        
            <?php if ( is_active_sidebar( 'footer' ) ) : ?>
            <ul>
                <?php dynamic_sidebar( 'footer' ); ?>
            </ul>
    		<?php endif; ?>
    		
            <div class="clearboth"></div>
        </div>
    </div>
	
	<div class="site-footer-bottom-bar">
	
		<div class="site-container">
			
			<div class="site-footer-bottom-bar-left">

             	<?php printf( __( 'Design by: %1$s', 'panoramic' ), '<a href="http://#">RaineSoft</a>' ); ?> 
                
			</div>
	        
	        <div class="site-footer-bottom-bar-right">
                
	            <?php wp_nav_menu( array( 'theme_location' => 'footer','container' => false, 'fallback_cb' => false, 'depth'  => 1 ) ); ?>
                
	        </div>
	        
	    </div>
		
        <div class="clearboth"></div>
	</div>
	
</footer><!-- #colophon -->

<?php wp_footer(); ?>

</body>
</html>