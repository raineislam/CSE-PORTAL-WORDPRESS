<?php
/**
 * all file includeed
 *
 * @param  
 * @return mixed|string
 */
	require_once( trailingslashit( get_template_directory() ) . '/inc/plugin-install.php' );
	require_once( trailingslashit( get_template_directory() ) . '/inc/widget.php' );
	require_once( trailingslashit( get_template_directory() ) . '/inc/breadcrumb.php' );
	require_once( trailingslashit( get_template_directory() ) . '/inc/static-function.php' );
	//customizer
	require_once( trailingslashit( get_template_directory() ) . '/customizer/customizer.php' );
	require_once( trailingslashit( get_template_directory() ) . '/customizer/pro-button/class-customize.php' );
		require_once( trailingslashit( get_template_directory() ) . '/inc/oneline-lite-theme.php' );
	?>