<?php
namespace SKULLZISH_ZELISH\ADMIN;
defined( 'ABSPATH' ) || exit;
class SKULLZISH_CONFIG {

	public function __construct() {
	   
	}
	public static function skullzlsh_index() {
		 	global $wpdb;
		 	$status = true;
		 	$data = array();
		 	if( isset( $_REQUEST['skullzlsh_zelish_config'] ) && ! empty( $_REQUEST['skullzlsh_zelish_config'] ) ) {
				 	$data['position']  = sanitize_text_field( $_REQUEST['skullzlsh_zelish_config']['position'] );

		         		if( ! isset( $data['position'] ) || empty( $data['position'] ) ) {
		         			$status = false;
		         		}
		         		if ( true === $status ) {
		        			update_option( 'skullzlsh_zelish_config', $data, true );     
		         		}
         	}
         	self::skullzlsh_zelish_template( $status );
	}	
	
	public static function skullzlsh_zelish_template( $status ) {
		$config = get_option( 'skullzlsh_zelish_config', true );
		?>
		<div class="skull-container skull-mt-5">
			
				<form method="POST" name="skullzlsh_zelish_config">
			<div class="skull-col-md-12 skull-badge skull-p-0 skull-m-0">
				<table class="skull-table skull-m-0 skull-table-bordered skull-bg-white">
					<thead>
						<tr>
							<th colspan="2">
								<p class="skull-h5 skull-float-left">
									<?php esc_html_e( 'Configure Zelish', 'skullzlsh' );?>
								</p>
						</tr>
					</thead>
					<tbody >
						<tr>
							<td>
								<h5><?php esc_html_e( "Button's position", "skullzlsh" );?></h5>
							</td>
							<td>
								<select name="skullzlsh_zelish_config[position]" class="skull-form-control skull-m-0 skull-w-100 skull-rounded-0" style="max-width: 100%">
									<option value="top" <?php selected( isset( $config['position'] ) ? $config['position'] : '', 'top' );?> >
										<?php esc_html_e( 'Top only', 'skullzlsh' );?>
									</option>
									<option value="bottom" <?php selected( isset( $config['position'] ) ? $config['position'] : '', 'bottom'); ?>>
										<?php esc_html_e( 'Bottom only', 'skullzlsh' );?>
									</option>
									<option value="both" <?php selected( isset( $config['position'] ) ? $config['position'] : '', 'both'); ?>>
										<?php esc_html_e( 'Top & bottom', 'skullzlsh' );?>
									</option>
								</select>
							</td>
						</tr>
					</tbody>
					<tfoot>
						<tr>
							<th colspan="2" class="skull-text-center">
								<?php echo ( false === $status )?'<p class="skull-text-danger"> '. esc_html__( 'Please check all fields...', 'skullzlsh' ) . '</p>':'';?>
								<button class="skull-btn skull-btn-success skull-btn-sm" type="submit"><?php echo esc_html__( 'Save', 'skullzlsh' );?></button>
							</th>
						</tr>
					</tfoot>
				</table>
			</div>
				</form>
		</div>
		<?php 
	}
}