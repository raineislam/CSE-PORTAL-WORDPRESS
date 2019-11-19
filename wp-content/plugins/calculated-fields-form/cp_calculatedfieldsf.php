<?php
/*
Plugin Name: Calculated Fields Form
Plugin URI: http://cff.dwbooster.com
Description: Create forms with field values calculated based in other form field values.
Version: 1.0.178
Text Domain: calculated-fields-form
Author: CodePeople
Author URI: http://cff.dwbooster.com
License: GPL
*/

if(!defined('WP_DEBUG') || true != WP_DEBUG)
{
	error_reporting(E_ERROR|E_PARSE);
}

require_once 'inc/cpcff_session.inc.php';
// Start Session
CP_SESSION::session_start();

// Defining main constants
define('CP_CALCULATEDFIELDSF_VERSION', '1.0.178' );
define('CP_CALCULATEDFIELDSF_MAIN_FILE_PATH', __FILE__ );
define('CP_CALCULATEDFIELDSF_BASE_PATH', dirname( CP_CALCULATEDFIELDSF_MAIN_FILE_PATH ) );
define('CP_CALCULATEDFIELDSF_BASE_NAME', plugin_basename( CP_CALCULATEDFIELDSF_MAIN_FILE_PATH ) );

require_once 'inc/cpcff_auxiliary.inc.php';
require_once 'config/cpcff_config.cfg.php';

require_once 'inc/cpcff_banner.inc.php';
require_once 'inc/cpcff_main.inc.php';

// Global variables
$cpcff_main = new CPCFF_MAIN; // Main plugin's object

add_action( 'init', 'cp_calculated_fields_form_check_posted_data', 11 );

// functions
//------------------------------------------

function cp_calculatedfieldsf_html_post_page() {
    if (isset($_GET["cal"]) && $_GET["cal"] != '')
    {
		@include_once dirname( __FILE__ ) . '/inc/cpcff_admin_int.inc.php';
    }
    else
	{
		if (isset($_GET["page"]) &&$_GET["page"] == 'cp_calculated_fields_form_sub3')
        {
            echo("Redirecting to upgrade page...<script type='text/javascript'>document.location='http://cff.dwbooster.com/download';</script>");
            exit;
        }
        else if (isset($_GET["page"]) &&$_GET["page"] == 'cp_calculated_fields_form_sub2')
        {
            echo("Redirecting to demo page...<script type='text/javascript'>document.location='http://cff.dwbooster.com/documentation';</script>");
            exit;
        }
        else if (isset($_GET["page"]) &&$_GET["page"] == 'cp_calculated_fields_form_sub4')
        {
            echo("Redirecting to demo page...<script type='text/javascript'>document.location='https://wordpress.org/support/plugin/calculated-fields-form#new-post';</script>");
            exit;
        }
        else
			@include_once dirname( __FILE__ ) . '/inc/cpcff_admin_int_list.inc.php';
	}
}

function cp_calculated_fields_form_check_posted_data() {

    global $wpdb, $cpcff_main;

    if ( 'POST' == $_SERVER['REQUEST_METHOD'] && isset( $_POST['cp_calculatedfieldsf_post_options'] ) && is_admin() )
    {
        cp_calculatedfieldsf_save_options();
		if( isset( $_POST[ 'preview' ] ) )
		{
			print '<!DOCTYPE html><html><head><meta charset="UTF-8"></head><body>';
            print( $cpcff_main->public_form( array( 'id' => $_POST[ 'cp_calculatedfieldsf_id' ] ) ));
			wp_footer();
			print '</body></html>';
			exit;
		}
		return;
    }
}

function cp_calculatedfieldsf_save_options()
{
	check_admin_referer( 'session_id_'.CP_SESSION::session_id(), '_cpcff_nonce' );
    global $wpdb;
    if (!defined('CP_CALCULATEDFIELDSF_ID'))
        define ('CP_CALCULATEDFIELDSF_ID',$_POST["cp_calculatedfieldsf_id"]);

	$error_occur = false;
	if( isset( $_POST[ 'form_structure' ] ) )
    {
		// Remove bom characters
		$bom = pack('H*','EFBBBF');
		$_POST[ 'form_structure' ] = preg_replace("/$bom/", '', $_POST[ 'form_structure' ]);

		$form_structure_obj = CPCFF_AUXILIARY::json_decode( $_POST[ 'form_structure' ] );
		if( !empty( $form_structure_obj ) )
		{
			global $cpcff_default_texts_array;
			$cpcff_text_array = '';

			$_POST = CPCFF_AUXILIARY::stripcslashes_recursive($_POST);
			if( isset( $_POST[ 'cpcff_text_array' ] ) )
			{
				$cpcff_text_array = $_POST[ 'cpcff_text_array' ];
				unset( $_POST[ 'cpcff_text_array' ] );
			}

			$data = array(
						  'form_structure' => $_POST['form_structure'],

						  'fp_from_email' => $_POST['fp_from_email'],
						  'fp_destination_emails' => $_POST['fp_destination_emails'],
						  'fp_subject' => $_POST['fp_subject'],
						  'fp_inc_additional_info' => $_POST['fp_inc_additional_info'],
						  'fp_return_page' => $_POST['fp_return_page'],
						  'fp_message' => $_POST['fp_message'],
						  'fp_emailformat' => $_POST['fp_emailformat'],

						  'cu_enable_copy_to_user' => $_POST['cu_enable_copy_to_user'],
						  'cu_user_email_field' => (isset($_POST['cu_user_email_field'])?$_POST['cu_user_email_field']:''),
						  'cu_subject' => $_POST['cu_subject'],
						  'cu_message' => $_POST['cu_message'],
						  'cu_emailformat' => $_POST['cu_emailformat'],

						  'enable_paypal' => @$_POST["enable_paypal"],
						  'paypal_email' => $_POST["paypal_email"],
						  'request_cost' => @$_POST["request_cost"],
						  'paypal_product_name' => $_POST["paypal_product_name"],
						  'currency' => $_POST["currency"],
						  'paypal_language' => $_POST["paypal_language"],
						  'paypal_mode' => $_POST["paypal_mode"],
						  'paypal_recurrent' => $_POST["paypal_recurrent"],
						  'paypal_identify_prices' => (isset($_POST['paypal_identify_prices'])?$_POST['paypal_identify_prices']:'0'),
						  'paypal_zero_payment' => $_POST["paypal_zero_payment"],

						  'vs_use_validation' => $_POST['vs_use_validation'],
						  'vs_text_is_required' => $_POST['vs_text_is_required'],
						  'vs_text_is_email' => $_POST['vs_text_is_email'],
						  'vs_text_datemmddyyyy' => $_POST['vs_text_datemmddyyyy'],
						  'vs_text_dateddmmyyyy' => $_POST['vs_text_dateddmmyyyy'],
						  'vs_text_number' => $_POST['vs_text_number'],
						  'vs_text_digits' => $_POST['vs_text_digits'],
						  'vs_text_max' => $_POST['vs_text_max'],
						  'vs_text_min' => $_POST['vs_text_min'],
						  'vs_text_previousbtn' => $_POST['vs_text_previousbtn'],
						  'vs_text_nextbtn' => $_POST['vs_text_nextbtn'],
						  'vs_all_texts' => serialize( $cpcff_text_array ),

						  'cv_enable_captcha' => $_POST['cv_enable_captcha'],
						  'cv_width' => $_POST['cv_width'],
						  'cv_height' => $_POST['cv_height'],
						  'cv_chars' => $_POST['cv_chars'],
						  'cv_font' => $_POST['cv_font'],
						  'cv_min_font_size' => $_POST['cv_min_font_size'],
						  'cv_max_font_size' => $_POST['cv_max_font_size'],
						  'cv_noise' => $_POST['cv_noise'],
						  'cv_noise_length' => $_POST['cv_noise_length'],
						  'cv_background' => $_POST['cv_background'],
						  'cv_border' => $_POST['cv_border'],
						  'cv_text_enter_valid_captcha' => $_POST['cv_text_enter_valid_captcha']
			);
			$_update_result = $wpdb->update (
				$wpdb->prefix.CP_CALCULATEDFIELDSF_FORMS_TABLE,
				$data,
				array( 'id' => CP_CALCULATEDFIELDSF_ID ),
				array( '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s' ),
				array( '%d' )
			);
			if( $_update_result === false )
			{
				global $cff_structure_error;
				$cff_structure_error = __('<div class="error-text">The data cannot be stored in database because has occurred an error with the database structure. Please, go to the plugins section and Deactivate/Activate the plugin to be sure the structure of database has been checked, and corrected if needed. If the issue persist, please <a href="http://wordpress.dwbooster.com/support">contact us</a></div>', 'calculated-fields-form' );
			}
		}
		else
		{
			$error_occur = true;
		}
	}
	else
    {
		$error_occur = true;
    }

	if( $error_occur )
	{
		global $cff_structure_error;
        $cff_structure_error = __('<div class="error-text">The data cannot be stored in database because has occurred an error with the form structure. Please, try to save the data again. If have been copied and pasted data from external text editors, the data can contain invalid characters. If the issue persist, please <a href="http://wordpress.dwbooster.com/support">contact us</a></div>', 'calculated-fields-form' );
	}
}


// cp_calculatedfieldsf_get_option:
$cp_calculatedfieldsf_option_buffered_item = false;
$cp_calculatedfieldsf_option_buffered_id = -1;

function cp_calculatedfieldsf_get_option ($field, $default_value, $id = '')
{
	$value = '';
    if (!defined("CP_CALCULATEDFIELDSF_ID"))
        define ("CP_CALCULATEDFIELDSF_ID", (!empty($id)) ? $id : 1);
    if (empty($id))
        $id = CP_CALCULATEDFIELDSF_ID;

    global $wpdb, $cp_calculatedfieldsf_option_buffered_item, $cp_calculatedfieldsf_option_buffered_id;
    if ($cp_calculatedfieldsf_option_buffered_id == $id)
	{
        if( property_exists( $cp_calculatedfieldsf_option_buffered_item, $field ) ) $value = @$cp_calculatedfieldsf_option_buffered_item->$field;
	}
    else
    {
		$myrows = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM ".$wpdb->prefix.CP_CALCULATEDFIELDSF_FORMS_TABLE." WHERE id=%d", $id ) );
		if( !empty( $myrows ) )
		{
			if( property_exists( $myrows[0], $field ) )
			{
				$value = @$myrows[0]->$field;
			}
			else
			{
				$value = $default_value;
			}
			$cp_calculatedfieldsf_option_buffered_item = $myrows[0];
			$cp_calculatedfieldsf_option_buffered_id  = $id;
		}
		else
		{
			$value = $default_value;
		}
    }

	if( $field == 'form_structure'  && !is_array( $value ) )
	{
		$form_data = CPCFF_AUXILIARY::json_decode( $value, 'normal' );
		$value = $cp_calculatedfieldsf_option_buffered_item->form_structure = ( !is_null( $form_data ) ) ? $form_data : '';
	}

    if ( ( $field == 'vs_all_texts' && empty( $value ) ) || ( $value == '' && $cp_calculatedfieldsf_option_buffered_item->form_structure == '' ) )
        $value = $default_value;

	/**
	 * Filters applied before returning a form option,
	 * use three parameters: The value of option, the name of option and the form's id
	 * returns the new option's value
	 */
    $value = apply_filters( 'cpcff_get_option', $value, $field, $id );

    return $value;
}
?>