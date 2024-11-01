<?php
/*
Plugin Name: VC Animation
Description: Animation for any Visual Composer elements.
Version: 1.0.1
Text Domain: vcla
Author: WPclever.net
Author URI: https://wpclever.net
*/
define( 'VCLA_VERSION', '1.0.1' );
define( 'VCLA_URI', plugin_dir_url( __FILE__ ) );
define( 'VCLA_PATH', plugin_dir_path( __FILE__ ) );
add_action( 'after_setup_theme', 'vcla_init', 999 );
add_action( 'wp_enqueue_scripts', 'vcla_enqueue_scripts' );
add_action( 'admin_enqueue_scripts', 'vcla_admin_enqueue_scripts' );
function vcla_enqueue_scripts() {
	wp_enqueue_style( 'vcla_frontend', VCLA_URI . 'assets/css/frontend.css' );
}

function vcla_admin_enqueue_scripts() {
	wp_enqueue_style( 'vcla_backend', VCLA_URI . 'assets/css/backend.css' );
}

function vcla_init() {
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		require_once( VCLA_PATH . 'params/properties.php' );
		add_shortcode( 'vc_animation', 'vcla_shortcode' );

		class WPBakeryShortCode_VC_Animation extends WPBakeryShortCodesContainer {
		}

		vc_map(
			array(
				'name'                    => esc_html__( 'VC Animation', 'vcla' ),
				'category'                => esc_html__( 'Animation for any elements', 'vcla' ),
				'icon'                    => 'vcla-icon',
				'base'                    => 'vc_animation',
				'content_element'         => true,
				'show_settings_on_create' => true,
				'is_container'            => true,
				'js_view'                 => 'VcColumnView',
				'as_parent'               => array( 'except' => 'vc_animation' ),
				'params'                  => array(
					array(
						'type'       => 'vcla_properties',
						'heading'    => esc_html__( 'Animation', 'vcla' ),
						'param_name' => 'properties',
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Extra class name', 'vcla' ),
						'param_name'  => 'el_class',
						'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'vcla' ),
					),
				)
			)
		);
	}
}

function vcla_shortcode( $atts, $content ) {
	extract( shortcode_atts( array(
		'properties' => '',
		'el_class'   => '',
	), $atts ) );
	$properties_arr     = explode( ',', $properties );
	$property_name      = isset( $properties_arr[0] ) && ( $properties_arr[0] != 'null' ) ? $properties_arr[0] : 'vcla-shake-01';
	$property_time      = isset( $properties_arr[1] ) && ( $properties_arr[1] != 'null' ) ? $properties_arr[1] : 'linear';
	$property_count     = isset( $properties_arr[2] ) && ( $properties_arr[2] != 'null' ) ? $properties_arr[2] : 'infinite';
	$property_direction = isset( $properties_arr[3] ) && ( $properties_arr[3] != 'null' ) ? $properties_arr[3] : 'alternate-reverse';
	$property_fill      = isset( $properties_arr[4] ) && ( $properties_arr[4] != 'null' ) ? $properties_arr[4] : 'none';
	$property_paused    = isset( $properties_arr[5] ) && ( $properties_arr[5] != 'null' ) ? $properties_arr[5] : 'no';
	$property_duration  = isset( $properties_arr[6] ) && ( $properties_arr[6] != 'null' ) ? $properties_arr[6] : '1000';
	$property_delay     = isset( $properties_arr[7] ) && ( $properties_arr[7] != 'null' ) ? $properties_arr[7] : '0';
	$output             = '';
	$vc_class           = 'vc-animation vcla';
	if ( $el_class != '' ) {
		$vc_class .= ' ' . $el_class;
	}
	if ( $property_paused == 'yes' ) {
		$vc_class .= ' vcla-paused-hover';
	}
	$uid        = uniqid( 'vcla-' );
	$vcla_style = '#' . $uid . '{';
	$vcla_style .= 'animation-name:' . $property_name . ';';
	$vcla_style .= 'animation-duration:' . $property_duration . 'ms;';
	$vcla_style .= 'animation-timing-function:' . $property_time . ';';
	$vcla_style .= 'animation-delay:' . $property_delay . 'ms;';
	$vcla_style .= 'animation-iteration-count:' . $property_count . ';';
	$vcla_style .= 'animation-direction:' . $property_direction . ';';
	$vcla_style .= 'animation-fill-mode:' . $property_fill . ';';
	$vcla_style .= '}';
	echo vcla_add_style_to_head( $vcla_style );
	$output .= '<div class="' . esc_attr( $vc_class ) . '" id=' . esc_attr( $uid ) . '>';
	$output .= do_shortcode( $content );
	$output .= '</div>';

	return $output;
}

function vcla_add_style_to_head( $style ) {
	$script = '<script id=\'' . uniqid( 'vcla-style-' ) . '\' type=\'text/javascript\'>';
	$script .= '(function($) {';
	$script .= '$(document).ready(function() {';
	$script .= '$("head").append("<style>' . str_replace( '"', "'", $style ) . '</style>");';
	$script .= '});';
	$script .= '})(jQuery);';
	$script .= '</script>';

	return $script;
}