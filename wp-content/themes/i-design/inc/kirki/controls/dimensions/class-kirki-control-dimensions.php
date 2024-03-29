<?php
/**
 * Customizer Control: dimensions.
 *
 * @package     Kirki
 * @subpackage  Controls
 * @copyright   Copyright (c) 2017, Aristeides Stathopoulos
 * @license     http://opensource.org/licenses/https://opensource.org/licenses/MIT
 * @since       2.1
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Dimensions control.
 * multiple fields with CSS units validation.
 */
class Kirki_Control_Dimensions extends WP_Customize_Control {

	/**
	 * The control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'kirki-dimensions';

	/**
	 * Used to automatically generate all CSS output.
	 *
	 * @access public
	 * @var array
	 */
	public $output = array();

	/**
	 * Data type
	 *
	 * @access public
	 * @var string
	 */
	public $option_type = 'theme_mod';

	/**
	 * The kirki_config we're using for this control
	 *
	 * @access public
	 * @var string
	 */
	public $kirki_config = 'global';

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * @see WP_Customize_Control::to_json()
	 */
	public function to_json() {
		parent::to_json();

		$this->json['default'] = $this->setting->default;
		if ( isset( $this->default ) ) {
			$this->json['default'] = $this->default;
		}
		$this->json['output']  = $this->output;
		$this->json['value']   = $this->value();
		$this->json['choices'] = $this->choices;
		$this->json['link']    = $this->get_link();
		$this->json['id']      = $this->id;
		$this->json['l10n']    = $this->l10n();

		if ( 'user_meta' === $this->option_type ) {
			// @codingStandardsIgnoreLine
			$this->json['value'] = get_user_meta( get_current_user_id(), $this->id, true );
		}

		$this->json['inputAttrs'] = '';
		foreach ( $this->input_attrs as $attr => $value ) {
			$this->json['inputAttrs'] .= $attr . '="' . esc_attr( $value ) . '" ';
		}

		if ( is_array( $this->choices ) ) {
			foreach ( $this->choices as $choice => $value ) {
				if ( 'labels' !== $choice && true === $value ) {
					$this->json['choices'][ $choice ] = true;
				}
			}
		}
		if ( is_array( $this->json['default'] ) ) {
			foreach ( $this->json['default'] as $key => $value ) {
				if ( isset( $this->json['choices'][ $key ] ) && ! isset( $this->json['value'][ $key ] ) ) {
					$this->json['value'][ $key ] = $value;
				}
			}
		}
	}

	/**
	 * Enqueue control related scripts/styles.
	 *
	 * @access public
	 */
	public function enqueue() {
		wp_enqueue_script( 'kirki-dimensions', trailingslashit( Kirki::$url ) . 'controls/dimensions/dimensions.js', array( 'jquery', 'customize-base' ), false, true );
		wp_localize_script( 'kirki-dimensions', 'dimensionskirkiL10n', $this->l10n() );
		wp_enqueue_style( 'kirki-dimensions-css', trailingslashit( Kirki::$url ) . 'controls/dimensions/dimensions.css', null );
	}

	/**
	 * An Underscore (JS) template for this control's content (but not its container).
	 *
	 * Class variables for this control class are available in the `data` JS object;
	 * export custom variables by overriding {@see WP_Customize_Control::to_json()}.
	 *
	 * @see WP_Customize_Control::print_template()
	 *
	 * @access protected
	 */
	protected function content_template() {
		?>
		<label>
			<# if ( data.label ) { #>
				<span class="customize-control-title">{{{ data.label }}}</span>
			<# } #>
			<# if ( data.description ) { #>
				<span class="description customize-control-description">{{{ data.description }}}</span>
			<# } #>
			<div class="wrapper">
				<div class="control">
					<# for ( choiceKey in data.default ) { #>
						<div class="{{ choiceKey }}">
							<h5>
								<# if ( ! _.isUndefined( data.choices.labels ) && ! _.isUndefined( data.choices.labels[ choiceKey ] ) ) { #>
									{{ data.choices.labels[ choiceKey ] }}
								<# } else if ( ! _.isUndefined( data.l10n[ choiceKey ] ) ) { #>
									{{ data.l10n[ choiceKey ] }}
								<# } else { #>
									{{ choiceKey }}
								<# } #>
							</h5>
							<div class="{{ choiceKey }} input-wrapper">
								<input {{{ data.inputAttrs }}} type="text" value="{{ data.value[ choiceKey ] }}"/>
							</div>
						</div>
					<# } #>
				</div>
			</div>
		</label>
		<?php
	}

	/**
	 * Render the control's content.
	 *
	 * @see WP_Customize_Control::render_content()
	 */
	protected function render_content() {}

	/**
	 * Returns an array of translation strings.
	 *
	 * @access protected
	 * @since 3.0.0
	 * @param string|false $id The string-ID.
	 * @return string
	 */
	protected function l10n( $id = false ) {
		$translation_strings = array(
			'left-top'              => esc_attr__( 'Left Top', 'i-design' ),
			'left-center'           => esc_attr__( 'Left Center', 'i-design' ),
			'left-bottom'           => esc_attr__( 'Left Bottom', 'i-design' ),
			'right-top'             => esc_attr__( 'Right Top', 'i-design' ),
			'right-center'          => esc_attr__( 'Right Center', 'i-design' ),
			'right-bottom'          => esc_attr__( 'Right Bottom', 'i-design' ),
			'center-top'            => esc_attr__( 'Center Top', 'i-design' ),
			'center-center'         => esc_attr__( 'Center Center', 'i-design' ),
			'center-bottom'         => esc_attr__( 'Center Bottom', 'i-design' ),
			'font-size'             => esc_attr__( 'Font Size', 'i-design' ),
			'font-weight'           => esc_attr__( 'Font Weight', 'i-design' ),
			'line-height'           => esc_attr__( 'Line Height', 'i-design' ),
			'font-style'            => esc_attr__( 'Font Style', 'i-design' ),
			'letter-spacing'        => esc_attr__( 'Letter Spacing', 'i-design' ),
			'word-spacing'          => esc_attr__( 'Word Spacing', 'i-design' ),
			'top'                   => esc_attr__( 'Top', 'i-design' ),
			'bottom'                => esc_attr__( 'Bottom', 'i-design' ),
			'left'                  => esc_attr__( 'Left', 'i-design' ),
			'right'                 => esc_attr__( 'Right', 'i-design' ),
			'center'                => esc_attr__( 'Center', 'i-design' ),
			'size'                  => esc_attr__( 'Size', 'i-design' ),
			'height'                => esc_attr__( 'Height', 'i-design' ),
			'spacing'               => esc_attr__( 'Spacing', 'i-design' ),
			'width'                 => esc_attr__( 'Width', 'i-design' ),
			'height'                => esc_attr__( 'Height', 'i-design' ),
			'invalid-value'         => esc_attr__( 'Invalid Value', 'i-design' ),
		);
		$translation_strings = apply_filters( "kirki/{$this->kirki_config}/l10n", $translation_strings );
		if ( false === $id ) {
			return $translation_strings;
		}
		return $translation_strings[ $id ];
	}
}
