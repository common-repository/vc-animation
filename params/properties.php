<?php
if ( ! class_exists( 'VCLA_Param_Properties' ) ) {
	class VCLA_Param_Properties {
		function __construct() {
			if ( class_exists( 'WpbakeryShortcodeParams' ) ) {
				WpbakeryShortcodeParams::addField( 'vcla_properties', array(
					$this,
					'output'
				), VCLA_URI . 'params/js/properties.js' );
			}
		}

		function output( $settings, $saved_value ) {
			$param_name = isset( $settings['param_name'] ) ? $settings['param_name'] : '';
			if ( $saved_value != '' ) {
				$saved_value_arr = explode( ',', $saved_value );
			}
			$property_name      = isset( $saved_value_arr[0] ) && ( $saved_value_arr[0] != 'null' ) ? $saved_value_arr[0] : 'vcla-shake-01';
			$property_time      = isset( $saved_value_arr[1] ) && ( $saved_value_arr[1] != 'null' ) ? $saved_value_arr[1] : 'linear';
			$property_count     = isset( $saved_value_arr[2] ) && ( $saved_value_arr[2] != 'null' ) ? $saved_value_arr[2] : 'infinite';
			$property_direction = isset( $saved_value_arr[3] ) && ( $saved_value_arr[3] != 'null' ) ? $saved_value_arr[3] : 'alternate-reverse';
			$property_fill      = isset( $saved_value_arr[4] ) && ( $saved_value_arr[4] != 'null' ) ? $saved_value_arr[4] : 'none';
			$property_paused    = isset( $saved_value_arr[5] ) && ( $saved_value_arr[5] != 'null' ) ? $saved_value_arr[5] : 'no';
			$property_duration  = isset( $saved_value_arr[6] ) && ( $saved_value_arr[6] != 'null' ) ? $saved_value_arr[6] : '1000';
			$property_delay     = isset( $saved_value_arr[7] ) && ( $saved_value_arr[7] != 'null' ) ? $saved_value_arr[7] : '0';
			$uid                = uniqid( 'vcla_properties_' );
			ob_start();
			?>
			<div class="vcla_properties" id="<?php echo esc_attr( $uid ); ?>">
				<input type="hidden" class="wpb_vc_param_value <?php echo esc_attr( $param_name ); ?>"
				       name="<?php echo esc_attr( $param_name ); ?>" value="<?php echo esc_attr( $saved_value ); ?>"/>
				<div class="vcla_preview">
					<div class="vcla_preview_shape"></div>
				</div>
				<div class="vcla_item">
					<div class="vc_row">
						<div class="vc_col-sm-6">
							<div class="vcla_label">Name</div>
							<div class="vcla_field">
								<select class="vcla_property vcla_select_value" data-key="animation-name"
								        data-val="<?php echo esc_attr( $property_name ); ?>"
								        data-box="<?php echo esc_attr( $uid ); ?>">
									<!-- heartbeat -->
									<option value="vcla-heartbeat-01">vcla-heartbeat-01</option>
									<option value="vcla-heartbeat-02">vcla-heartbeat-02</option>
									<!-- floating -->
									<option value="vcla-floating-vertical">vcla-floating-vertical</option>
									<option value="vcla-floating-horizontal">vcla-floating-horizontal</option>
									<option value="vcla-floating-shadow">vcla-floating-shadow</option>
									<!-- shake -->
									<option value="vcla-shake-01">vcla-shake-01</option>
									<option value="vcla-shake-02">vcla-shake-02</option>
									<option value="vcla-shake-basic">vcla-shake-basic</option>
									<option value="vcla-shake-little">vcla-shake-little</option>
									<option value="vcla-shake-slow">vcla-shake-slow</option>
									<option value="vcla-shake-hard">vcla-shake-hard</option>
									<option value="vcla-shake-horizontal">vcla-shake-horizontal</option>
									<option value="vcla-shake-vertical">vcla-shake-vertical</option>
									<option value="vcla-shake-rotate">vcla-shake-rotate</option>
									<option value="vcla-shake-opacity">vcla-shake-opacity</option>
									<option value="vcla-shake-crazy">vcla-shake-crazy</option>
									<option value="vcla-shake-chunk">vcla-shake-chunk</option>
									<!-- spin -->
									<option value="vcla-spin-right">vcla-spin-right</option>
									<option value="vcla-spin-left">vcla-spin-left</option>
									<!-- jump -->
									<option value="vcla-jump-01">vcla-jump-01</option>
									<option value="vcla-jump-02">vcla-jump-02</option>
									<!-- color -->
									<option value="vcla-color-01">vcla-color-01</option>
									<option value="vcla-color-02">vcla-color-02</option>
								</select>
							</div>
						</div>
						<div class="vc_col-sm-6">
							<div class="vcla_label">Time function</div>
							<div class="vcla_field">
								<select class="vcla_property vcla_select_value" data-key="animation-timing-function"
								        data-val="<?php echo esc_attr( $property_time ); ?>"
								        data-box="<?php echo esc_attr( $uid ); ?>">
									<option value="linear">linear</option>
									<option value="ease">ease</option>
									<option value="ease-in">ease-in</option>
									<option value="ease-out">ease-out</option>
									<option value="ease-in-out">ease-in-out</option>
									<option value="step-start">step-start</option>
									<option value="step-end">step-end</option>
									<option value="initial">initial</option>
									<option value="inherit">inherit</option>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="vcla_item">
					<div class="vc_row">
						<div class="vc_col-sm-6">
							<div class="vcla_label">Iteration count</div>
							<div class="vcla_field">
								<select class="vcla_property vcla_select_value" data-key="animation-iteration-count"
								        data-val="<?php echo esc_attr( $property_count ); ?>"
								        data-box="<?php echo esc_attr( $uid ); ?>">
									<option value="infinite">infinite</option>
									<option value="initial">initial</option>
									<option value="inherit">inherit</option>
									<?php
									for ( $i = 1; $i < 101; $i ++ ) {
										echo '<option value="' . $i . '">' . $i . '</option>';
									}
									?>
								</select>
							</div>
						</div>
						<div class="vc_col-sm-6">
							<div class="vcla_label">Direction</div>
							<div class="vcla_field">
								<select class="vcla_property vcla_select_value" data-key="animation-direction"
								        data-val="<?php echo esc_attr( $property_direction ); ?>"
								        data-box="<?php echo esc_attr( $uid ); ?>">
									<option value="normal">normal</option>
									<option value="reverse">reverse</option>
									<option value="alternate">alternate</option>
									<option value="alternate-reverse">alternate-reverse</option>
									<option value="initial">initial</option>
									<option value="inherit">inherit</option>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="vcla_item">
					<div class="vc_row">
						<div class="vc_col-sm-6">
							<div class="vcla_label">Fill mode</div>
							<div class="vcla_field">
								<select class="vcla_property vcla_select_value" data-key="animation-fill-mode"
								        data-val="<?php echo esc_attr( $property_fill ); ?>"
								        data-box="<?php echo esc_attr( $uid ); ?>">
									<option value="none">none</option>
									<option value="forwards">forwards</option>
									<option value="backwards">backwards</option>
									<option value="both">both</option>
									<option value="initial">initial</option>
									<option value="inherit">inherit</option>
								</select>
							</div>
						</div>
						<div class="vc_col-sm-6">
							<div class="vcla_label">Paused on hover?</div>
							<div class="vcla_field">
								<select class="vcla_property vcla_select_value" data-key="animation-paused-hover"
								        data-val="<?php echo esc_attr( $property_paused ); ?>"
								        data-box="<?php echo esc_attr( $uid ); ?>">
									<option value="no">no</option>
									<option value="yes">yes</option>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="vcla_item vcla_item_horizontal">
					<div class="vc_row">
						<div class="vc_col-sm-2">
							<div class="vcla_label">Duration</div>
						</div>
						<div class="vc_col-sm-10">
							<div class="vcla_field">
								<div class="vcla_slider">
									<div class="vcla_slider_bar vcla_property vcla_slider_value"
									     data-key="animation-duration"
									     data-val="<?php echo esc_attr( $property_duration ); ?>"
									     data-box="<?php echo esc_attr( $uid ); ?>"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="vcla_item vcla_item_horizontal">
					<div class="vc_row">
						<div class="vc_col-sm-2">
							<div class="vcla_label">Delay</div>
						</div>
						<div class="vc_col-sm-10">
							<div class="vcla_field">
								<div class="vcla_slider">
									<div class="vcla_slider_bar vcla_property vcla_slider_value"
									     data-key="animation-delay"
									     data-val="<?php echo esc_attr( $property_delay ); ?>"
									     data-box="<?php echo esc_attr( $uid ); ?>"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
			$output = ob_get_contents();
			ob_end_clean();

			return $output;
		}
	}
}

if ( class_exists( 'VCLA_Param_Properties' ) ) {
	$VCLA_Param_Properties = new VCLA_Param_Properties();
}