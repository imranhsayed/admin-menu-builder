<?php
/**
 * Custom functions for creating admin menu settings for the plugin.
 *
 * @package Admin Menu Builder
 */
add_action( 'admin_menu', 'ihs_create_post_tax_menu' );

if ( ! function_exists( 'ihs_create_post_tax_menu' ) ) {
	/**
	 * Creates Menu for Plugin in the dashboard.
	 */
	function ihs_create_post_tax_menu() {
		// Create new top-level menu.
		add_menu_page( 'Create Post Tax Plugin Settings', 'Create Post Tax', 'administrator', __FILE__, 'ihs_post_tax_form_func', 'dashicons-admin-plugins' );
		// Call register settings function.
		add_action( 'admin_init', 'register_ihs_post_tax_settings' );
	}
}

if ( ! function_exists( 'register_ihs_post_tax_settings' ) ) {
	/**
	 * Register our settings.
	 */
	function register_ihs_post_tax_settings() {
		register_setting( 'ihs_post_tax_settings_group', 'ihs_custom_post_name' );
		register_setting( 'ihs_post_tax_settings_group', 'ihs_custom_tax_name' );
		register_setting( 'ihs_post_tax_settings_group', 'ihs_is_hierarchical' );
	}
}

if ( ! function_exists( 'ihs_get_checked_val' ) ) {
	/**
	 * Find the value of checked input value and return an array.
	 *
	 * @return {array} $checked_array Array containing values yes or no.
	 */
	function ihs_get_checked_val() {
		$checked_array = array(
			'checked-yes' => '',
			'checked-no' => '',
		);
		$checkbox_val = esc_attr( get_option( 'ihs_is_hierarchical' ) );
		if ( 'Yes' === $checkbox_val ) {
			$checked_array['checked-yes'] = 'checked';
		} else if ( 'No' === $checkbox_val ) {
			$checked_array['checked-no'] = 'checked';
		}
		return $checked_array;
	}
}

if ( ! function_exists( 'ihs_post_tax_form_func' ) ) {
	/**
	 * Settings Page for Plugin.
	 */
	function ihs_post_tax_form_func() {
		?>
		<div class="wrap">
			<h1>Post and Taxonomy Generator Settings</h1>

			<form method="post" action="options.php">
				<h1>Custom Post Generator Settings</h1>
				<?php settings_fields( 'ihs_post_tax_settings_group' ); ?>
				<?php do_settings_sections( 'ihs_post_tax_settings_group' ); ?>
				<table class="form-table">
					<tr valign="top">
						<th scope="row">Custom Post Name<span class="">*</span></th>
						<td><label for=""><input type="text" name="ihs_custom_post_name" value="<?php echo esc_attr( get_option( 'ihs_custom_post_name' ) ); ?>" /></label></td>
					</tr>
				</table>
				<h2>Create Taxonomy Settings</h2>
				<table class="form-table">
					<tr valign="top">
						<th scope="row">Custom Taxonomy Name<span class="">*</span></th>
						<td><label for=""><input type="text" name="ihs_custom_tax_name" value="<?php echo esc_attr( get_option( 'ihs_custom_tax_name' ) ); ?>" /></label></td>
					</tr>
					<tr valign="top">
						<th scope="row">Hierarchical ( Y/N ): <span class="ihs-otp-red">*</span></th>
						<td><label for="">
								<?php $checked_array = ihs_get_checked_val(); ?>
								<input type="radio" name="ihs_is_hierarchical" class="" value="Yes" <?php echo esc_attr( $checked_array['checked-yes'] ); ?>/>Yes
								<input type="radio" name="ihs_is_hierarchical" class="" value="No" <?php echo esc_attr( $checked_array['checked-no'] ); ?>/>No
							</label></td>
					</tr>
				</table>
				<?php submit_button(); ?>
			</form>
		</div>
		<?php
	}
}