<?php
/*
 Plugin Name: CalculatorPro Calculators
 Plugin URI: http://www.calculatorpro.com/?utm_source=wordpress_plugin&utm_content=wp_plugins
 Description: A collection of over 300 embeddable calculators.
 Version: 1.1.7
 Author: jgadbois
 Author URI: http://www.domainsuperstar.com
 */
?>
<?php
  define("CP_VERSION","1.1.6");

  // setup callbacks
  add_action('admin_init', 'CP_init_fn');
  add_action('admin_menu', 'CP_add_settings');

  // ajax
  add_action('wp_ajax_preview_calc', 'CP_preview_calc');

  add_shortcode('calc', 'CP_widget_shortcode');

  // allow shortcode in widget
  add_filter('widget_text', 'do_shortcode');
  add_action('init', 'CP_load_text_domain');
  add_action('init', 'CP_setup_actions');

	
  function CP_load_text_domain() {
    $plugin_dir = trailingslashit( basename(dirname(__FILE__)) ) . 'lang/';
  	load_plugin_textdomain( 'calculator_pro', false, $plugin_dir );
  }

  function CP_setup_actions() {
    if( get_option('cp_version') != CP_VERSION ) {
      update_option('cp_version', CP_VERSION);
    }
  }

  function CP_add_settings() {
    add_options_page('Calculator Pro', 'Calculator Pro', 'administrator', __FILE__, 'CP_options_page_fn');
  }

  function CP_options_page_fn() {
    $options = get_option('calc_pro_options');
  ?>
    <div class="wrap">
      <div class="icon32" id="icon-options-general"><br></div>
      <div class='banner'>
        <img src='<?php echo plugins_url('images/banner.jpg', __FILE__) ?>'/>
        <div class='mda'>
          <h2>Get More From Your Calculators</h2>
          <p>
            Visit CalculatorPRO.com for the ability to customize calculators, purchase add-ons that provide you with lead and analytics, 
            as well as completely custom calculators tailored to your needs.
          </p>
        </div>
      </div>
      <div class='cp-packages'>
        <a href='http://www.calculatorpro.com/pricing' target='_blank'><img src='<?php echo plugins_url('images/packages.png', __FILE__) ?>'/></a>
      </div>
      <div class='clearfix'>
        <div class='left-col col'>
          <div class='cp_content_box'>
            <h3>Add Basic Calculator To Your Site</h3>
            <ul>
              <li><h4>Step 1: Select a Calculator</h4></li>
              <li><h4>Step 2: Copy &amp; Paste Shortcode</h4>
                The shortcode can be pasted into any post, page, or widget.
              </li>
            </ul>
          </div>

          <div class='cp_content_box'>
            <h3>Shortcode</h3>
            <div class='shortcode'>
              <div id="cp_shortcode"></div>
            </div>
          </div>
        </div>
        <div class='right-col col'>
          <div class='cp_content_box'>
            <?php CP_section_calcs() ?>
            <div id="widget_preview">
               Select a calculator for a preview.
            </div>
          </div>
        </div>
      </div>
      <div class='cta full-width'>
        <a href='http://www.calculatorpro.com/pricing' target='_blank'>
          <h2>Visit CalculatorPro.com for Customization and Add-ons</h2>
        </a>
      </div>
      <div class='clearfix'>
        <div class='left-col col'>
          <div class='cp_content_box support'>
            <h3>Support Calculator Pro</h3>
            <p>Help us to continue to create awesome calculators to solve your problems!</p>
            <img src='<?php echo plugins_url('images/cc.jpg', __FILE__) ?>'/>
            <form class="paypal_form" action="https://www.paypal.com/cgi-bin/webscr" method="post" target='_blank'>
              <input type="hidden" name="cmd" value="_s-xclick">
              <input type="hidden" name="hosted_button_id" value="SR6TBXHTVJV2N">
              <input type='submit' class='cp-button' value='Donate' name='submit'>
              <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
            </form>
          </div>
        </div>
        <div class='right-col col'>
          <div class='cp_content_box blue faq'>
            <a href='http://www.calculatorpro.com/faq' target='_blank'>Check out our FAQs</a>
          </div>
        </div>
      </div>
      
      <form action="options.php" method="post">
        <?php settings_fields('calc_pro_options'); ?>
        <?php do_settings_sections(__FILE__); ?>
        <p class="submit">
          <input name="Submit" type="submit" class="button-primary" value="<?php esc_attr_e('Save Changes'); ?>" />
        </p>
    </div>
  <?php
  }

  function CP_getCalculatorList() {
    $calcList = wp_remote_get("http://api.calculatorpro.com/cp_calclist");

    if(is_wp_error($calcList)) {
      // echo $calcList->get_error_message();
    } else {
      return json_decode($calcList['body']);
    }
  }

  function CP_getCalculator($id) {
    $calc = wp_remote_get("http://api.calculatorpro.com/calc/" . $id);

    if(is_wp_error($calc)) {
      // echo $calc->get_error_message();
    } else {
      return json_decode($calc['body']);
    }
  }

  function CP_init_fn() {
    // set up settings
    register_setting('calc_pro_options', 'calc_pro_options' );

    add_settings_section('main_section', '', '', __FILE__);
    add_settings_field('allow_links', 'Allow Links to Calculator Pro', 'CP_allow_links_fn', __FILE__, 'main_section');

    wp_enqueue_script('jquery-ui-slider');
    wp_enqueue_script('calc-colorpicker', plugins_url('js/colorpicker/colorpicker.js', __FILE__), array('jquery'));
    wp_enqueue_script('cp-app', plugins_url('js/app.js', __FILE__), array('jquery'));
    wp_enqueue_script('select2', plugins_url('js/select2/select2.min.js', __FILE__), array('jquery'));

    wp_register_style('cp-colorpicker', plugins_url('js/colorpicker/css/colorpicker.css', __FILE__));
    wp_enqueue_style('cp-colorpicker');

    wp_register_style('select_styling', plugins_url('js/select2/select2.css', __FILE__));
    wp_enqueue_style('select_styling');

    wp_register_style('cp-styles', plugins_url('css/cp_styles.css', __FILE__));
    wp_enqueue_style('cp-styles');

    wp_register_style('jquery-ui-slider', plugins_url('css/ui-slider.css', __FILE__));
    wp_enqueue_style('jquery-ui-slider');

    if(!get_option('calc_pro_options')) {
      $defaults = array('start_color'=>'#378CAF', 'end_color'=>'#006395', 'calc_width'=>260, 'text_color'=>'#FFFFFF', 'allow_links'=>'true', 'font_size'=>'16px');
      add_option('calc_pro_options', $defaults);
    }
  }

  function CP_shortcode_section_text_fn() {
    echo '<p>Select a calculator from the list to generate a shortcode that can be placed in any Post or Page</p>';
  }

   function CP_section_calcs() {
    $calcs = CP_getCalculatorList();

    echo "<select id='cp_shortcode_picker' name='cp_shortcode_picker' style='width: 100%;'>";

    echo "<option></option>";

    foreach($calcs as $item=>$value) {
      echo "<option value='$item'>$value</option>";
    }

    echo "</select>";
  }

  function CP_allow_links_fn() {
    $options = get_option('calc_pro_options');
    $checked = $options['allow_links'] ? "checked='checked'" : "";

    echo "<input id='allow_links_check' name='calc_pro_options[allow_links]' type='checkbox' value='true' " . $checked . "'/>";
  }

  function CP_reset_customizations_fn() {
    echo "<input id='reset_cust' type='button' value='Reset' />";
  }

  function CP_rgb_to_html($rgbStr) {
		if( strpos( $rgbStr, "#" ) !== FALSE ) return $rgbStr;

		$rgbStr = substr($rgbStr, 4, sizeof($rgbStr)-2);
		$rgb = explode(',', $rgbStr);
		$r = $rgb[0]; $g = $rgb[1]; $b = $rgb[2];
		$r = intval($r); $g = intval($g); $b = intval($b);

		$r = dechex($r<0?0:($r>255?255:$r));
		$g = dechex($g<0?0:($g>255?255:$g));
		$b = dechex($b<0?0:($b>255?255:$b));

		$color = (strlen($r) < 2?'0':'').$r;
		$color .= (strlen($g) < 2?'0':'').$g;
		$color .= (strlen($b) < 2?'0':'').$b;
		return '#'.$color;
  }

  function CP_widget_shortcode($atts) {
    extract(shortcode_atts(array(
      'id' => '910',
      'text_color'=>null,
      'start_color'=>null,
      'end_color'=>null,
      'calc_width'=>null,
      'allow_links'=>null,
      'font_size'=>null,
      'use_custom_css'=>null,
      'currency_symbol'=>null,
      'unique_id'=>false
    ), $atts));
	
    $calc = CP_getCalculator($id);

    $calc->fields = explode(",", $calc->fields);
    $options = get_option('calc_pro_options');
    $datas = '';
    $allow_links = $allow_links ? $allow_links : (isset($options['allow_links']) ? $options['allow_links'] : null);
    if ($allow_links != null && $allow_links != 'null' && $allow_links != '-1') {
      $datas .= ' data-anchor="2"';
    } else {
      $datas .= ' data-anchor="' . ( -1 * ($id * 7 + 36)) . '"';
    }
    ob_start();

    ?>
    <div class="cp-calc-widget" data-calcid="<?php echo $id; ?>"<?php echo $datas; ?>></div><a href="http://www.calculatorpro.com/calculator/<?php $calc->name ?>"></a><script <?php echo ($unique_id ? 'id="wordpress_preview_calc_unique"' : ''); ?> src="http://www.calculatorpro.com/wp-content/plugins/calcs/js/widgetV6.min.js"></script>
    <?php

    $widget = ob_get_contents();
    ob_end_clean();
    return trim($widget);
  }

  function CP_preview_calc() {
    echo CP_widget_shortcode(array(
      'id' => $_POST['id'],
      'calc_width' => $_POST['calc_width'],
      'text_color' => $_POST['text_color'],
      'start_color' => $_POST['start_color'],
      'end_color' => $_POST['end_color'],
      'allow_links' => $_POST['allow_links'],
      'font_size' => $_POST['font_size'],
      'unique_id' => true
    ));
    die();
  }
?>
