<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    ZohoCRM
 * @subpackage ZohoCRM/admin/partials
 */


/** This file should primarily consist of HTML with a little bit of PHP. */
?>
<?php
function zohoCRM_id_render(){
	$options = get_option( 'zohoCRM_settings' );
	?>
	<input type='text' name='zohoCRM_settings[zohoCRM_id]' value='<?php 
	if ( isset( $options['zohoCRM_id'] ) ) {
		echo $options['zohoCRM_id']; 
	} ?>' class="regular-text">
	<div class="helper">To learn how to set up your Zoho CRM application ID and secret code for oAuth <a href="https://www.zoho.com/accounts/protocol/oauth-setup.html" target="_blank">Click Here</a></div>
	<?php
}

function zohoCRM_books_id_render(){
	$options = get_option( 'zohoCRM_settings' );
	?>
	<input type='text' name='zohoCRM_settings[zohoCRM_books_id]' value='<?php 
	if ( isset( $options['zohoCRM_books_id'] ) ) {
		echo $options['zohoCRM_books_id']; 
	} ?>' class="regular-text">
	<div class="helper">Your Zoho Books Organization ID is different from your Zoho CRM ID, to learn how to get your Zoho Books Organization ID <a href="https://www.zoho.com/books/api/v3/#organization-id" target="_blank">Click Here</a></div>
	<?php
}

function zohoCRM_ep_crm_render(){
	$options = get_option( 'zohoCRM_settings' );
	?>
    <div class="button-wrapper">
       <?php
        if ( isset( $options['zohoCRM_id'] ) ) { ?>
       <a class="button primary" href="https://accounts.zoho.com/oauth/v2/auth?scope=ZohoCRM.modules.contacts.ALL&client_id=<?php echo $options['zohoCRM_id'] ?>&state=CRM&response_type=code&redirect_uri=<?php echo $options['zohoCRM_callback'] ?>&access_type=offline&prompt=consent">Authorize CRM Endpoint</a>
        <?php } ?>
    </div>

	<div class="helper">Authorize your site to interact with the Zoho CRM API, more information can be found here: <a href="https://www.zoho.com/accounts/protocol/oauth-setup.html" target="_blank">Click Here</a></div>
	<?php
}

function zohoCRM_ep_books_render(){
	$options = get_option( 'zohoCRM_settings' );
	?>
    <div class="button-wrapper">
       <?php
        if ( isset( $options['zohoCRM_id'] ) ) { ?>
       <a class="button primary" href="https://accounts.zoho.com/oauth/v2/auth?scope=ZohoBooks.contacts.ALL&client_id=<?php echo $options['zohoCRM_id'] ?>&state=CRM&response_type=code&redirect_uri=<?php echo $options['zohoCRM_callback'] ?>&access_type=offline&prompt=consent">Authorize Books Endpoint</a>
        <?php } ?>
    </div>

	<div class="helper">Authorize your site to interact with the Zoho Books API, more information can be found here: <a href="https://www.zoho.com/accounts/protocol/oauth-setup.html" target="_blank">Click Here</a></div>
	<?php
}

function zohoCRM_callback_render(){
	$options = get_option( 'zohoCRM_settings' );
	?>
	<input type='text' name='zohoCRM_settings[zohoCRM_callback]' value='<?php 
	if ( isset( $options['zohoCRM_callback'] ) ) {
		echo $options['zohoCRM_callback']; 
	} ?>' class="regular-text">
	<div class="helper">Enter the URL to your oAuth callback page here.</div>
	<?php
}

function zohoCRM_secret_render(){
	$options = get_option( 'zohoCRM_settings' );
	?>
	<input type='text' name='zohoCRM_settings[zohoCRM_secret]' value='<?php 
	if ( isset( $options['zohoCRM_secret'] ) ) {
		echo $options['zohoCRM_secret']; 
	} ?>' class="regular-text">
	<div class="helper">To learn how to set up your Zoho CRM application ID and secret code for oAuth <a href="https://www.zoho.com/accounts/protocol/oauth-setup.html" target="_blank">Click Here</a></div>
	<?php
}

function zohoCRM_debug_render(  ) { 

	$options = get_option( 'zohoCRM_settings' );
	
	if ( !isset( $options['zohoCRM_debug'] ) ) {
		$options['zohoCRM_debug'] = 'false';
	}
	
	?>
	<select name='zohoCRM_settings[zohoCRM_debug]' class='regular-text'>
		<option value="true" <?php if ( $options['zohoCRM_debug'] == 'true' ) { echo 'selected'; } ?>>Debug On</option>
		<option value="false" <?php if ( $options['zohoCRM_debug'] == 'false' ) { echo 'selected'; } ?>>Debug Off</option>
	</select>
	<div class="helper">Debug mode will turn on extra logs.</div>
	<?php

}

function zohoCRM_allow_track(  ) { 

	$options = get_option( 'zohoCRM_settings' );
	
	if ( !isset( $options['zohoCRM_allow_track'] ) ) {
		$options['zohoCRM_allow_track'] = 'false';
	}
	
	?>
	<select name='zohoCRM_settings[zohoCRM_allow_track]' class='regular-text'>
		<option value="true" <?php if ( $options['zohoCRM_allow_track'] == 'true' ) { echo 'selected'; } ?>>Allow Tracking</option>
		<option value="false" <?php if ( $options['zohoCRM_allow_track'] == 'false' ) { echo 'selected'; } ?>>No Tracking</option>
	</select>
	<div class="helper">Allow this plugin to track usage data to improve the plugin usability, functionality and performance.</div>
	<?php

}

function zohoCRM_log_errors_render(  ) { 

	$options = get_option( 'zohoCRM_board_settings' );
	
	if ( !isset( $options['zohoCRM_log_errors'] ) ) {
		$options['zohoCRM_log_errors'] = 'false';
	}
	
	?>
	<select name='zohoCRM_settings[zohoCRM_log_errors]' class='regular-text'>
		<option value="true" <?php if ( $options['zohoCRM_log_errors'] == 'true' ) { echo 'selected'; } ?>>Log Errors</option>
		<option value="false" <?php if ( $options['zohoCRM_log_errors'] == 'false' ) { echo 'selected'; } ?>>No Logging</option>
	</select>
	<div class="helper">Allow this plugin to log errors to a log file. It can come in handy when debugging.</div>
	<?php

}

function zohoCRM_analytics_render(  ) { 

	$options = get_option( 'zohoCRM_settings' );
	
	if ( !isset( $options['zohoCRM_analytics'] ) ) {
		$options['zohoCRM_analytics'] = 'false';
	}
	
	?>
	<select name='zohoCRM_settings[zohoCRM_analytics]' class='regular-text'>
		<option value="true" <?php if ( $options['zohoCRM_analytics'] == 'true' ) { echo 'selected'; } ?>>Add Analytics</option>
		<option value="false" <?php if ( $options['zohoCRM_analytics'] == 'false' ) { echo 'selected'; } ?>>No Analytics</option>
	</select>
	<div class="helper">Track job views as page views in google analytics. This assumes you have google analytics tracking code already installed on your site. It will only add page tracking to the on page job board navigation.</div>
	<?php

}







function zohoCRM_cache_expiry_render(  ) { 

	$options = get_option( 'zohoCRM_settings' );
	
	if ( !isset( $options['zohoCRM_cache_expiry'] ) ) {
		$options['zohoCRM_cache_expiry'] = '3600';
	}

	//if set to no cache, delete any transient data that is currently cached.
	if ( isset( $options['zohoCRM_cache_expiry'] ) && 
		 $options['zohoCRM_cache_expiry'] === '1' 
	) {
		delete_transient( 'ghjb_json' );
		delete_transient( 'ghjb_jobs' );
	}
	?>

	<select name='zohoCRM_settings[zohoCRM_cache_expiry]' class='regular-text'>
	<option value="1"      <?php if ( $options['zohoCRM_cache_expiry'] === '1'      ) { echo 'selected'; } ?>>No Cache (not recommended, except for testing)</option>
	<option value="3600"   <?php if ( $options['zohoCRM_cache_expiry'] === '3600'   ) { echo 'selected'; } ?>>1 Hour</option>
	<option value="7200"   <?php if ( $options['zohoCRM_cache_expiry'] === '7200'   ) { echo 'selected'; } ?>>2 Hours</option>
	<option value="21600"  <?php if ( $options['zohoCRM_cache_expiry'] === '21600'  ) { echo 'selected'; } ?>>6 Hours</option>
	<option value="43200"  <?php if ( $options['zohoCRM_cache_expiry'] === '43200'  ) { echo 'selected'; } ?>>12 Hours</option>
	<option value="86400"  <?php if ( $options['zohoCRM_cache_expiry'] === '86400'  ) { echo 'selected'; } ?>>1 Day (24 Hours)</option>
	<option value="172800" <?php if ( $options['zohoCRM_cache_expiry'] === '172800' ) { echo 'selected'; } ?>>2 Days (48 Hours)</option>
	<option value="604800" <?php if ( $options['zohoCRM_cache_expiry'] === '604800' ) { echo 'selected'; } ?>>7 Days (168 Hours)</option>
	</select>
	<div class="helper">Cache expiration time for the Zoho CRM API data.</div>
	<?php

}

function zohoCRM_clear_cache_render(  ) { 

	$options = get_option( 'zohoCRM_settings' );
	
	if ( isset( $options['zohoCRM_clear_cache'] ) && 
		 $options['zohoCRM_clear_cache'] === '1' 
	) {
		delete_transient( 'ghjb_json' );
		delete_transient( 'ghjb_jobs' );
		echo '<div class="updated settings-error notice is-dismissible"><p>Cache cleared successfully.</p></div>';
	}
	else {
		$options['zohoCRM_clear_cache'] = '0';
	}
	
	
	?>
	<label class="helper"><input type='checkbox' name='zohoCRM_settings[zohoCRM_clear_cache]' value='1' <?php if ( $options['zohoCRM_clear_cache'] === '1' ) { echo 'checked'; } ?> >
	To clear Zoho CRM API data from this site's cache (<a href="https://codex.wordpress.org/Transients_API" target="_blank">Transients</a>), check this box and save changes.</label>
	<?php

}

function zohoCRM_custom_css_render(  ) {

	$options = get_option( 'zohoCRM_settings' );
	?>

	<?php
     if($options['zohoCRM_custom_css_checkbox'] == 'on'){
		echo '<input type="checkbox" id="custom-css" checked name="zohoCRM_settings[zohoCRM_custom_css_checkbox]"/> <label for="custom-css">Use Custom Css?</label>';
		echo '<div class="custom-css-textarea show">';
	 }else{
		echo '<input type="checkbox" id="custom-css" name="zohoCRM_settings[zohoCRM_custom_css_checkbox]"/> <label for="custom-css">Use Custom Css?</label>';
		echo '<div class="custom-css-textarea hide">';
	}
	?>
	<textarea name="zohoCRM_settings[zohoCRM_custom_css]" class="large-text" rows="20"><?php if(isset($options['zohoCRM_custom_css'])) echo trim($options['zohoCRM_custom_css']);?></textarea>
		<div class="helper">Place any custom CSS here.</div>
	</div>
	<?php

}

function zohoCRM_inline_form_template_render(  ) { 

	$options = get_option( 'zohoCRM_settings' );
	?>
	<textarea name='zohoCRM_settings[zohoCRM_inline_form_template]' class="large-text"><?php 
	if ( !isset( $options['zohoCRM_inline_form_template'] ) ) { // Nothing yet saved
		echo ''; 
	}
	else {
		echo $options['zohoCRM_inline_form_template']; 
	}
	?></textarea>
	<div class="helper">Set the text for your description label. Note, this is only displayed when the display description option is active. Default is blank.</div>
	<?php

}


function zohoCRM_gh_settings_section_callback(  ) { 

	echo __( 'Configure settings for your Zoho CRM account.', 'zohoCRM' );

}
function zohoCRM_jb_settings_section_callback(  ) { 

	echo __( 'Update settings for your Zoho CRM account.', 'zohoCRM' );

}
function zohoCRM_p_settings_section_callback(  ) { 

	// echo __( 'Plugin settings.', 'zohoCRM' );

}

function zohoCRM_ep_settings_section_callback(  ) { 

	echo __( 'Authorize endpoints to interact with your Zoho CRM account.', 'zohoCRM' );

}

function zohoCRM_options_page(  ) {

	?>
	<form action='options.php' method='post'>
		<?php
			settings_fields( 'zohoCRM_settings' );
			do_settings_sections( 'zohoCRM_settings' );
			submit_button();
		?>
		
	</form>
	<?php

}

?>
