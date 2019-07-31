<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    ZohoCRM
 * @subpackage ZohoCRM/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 */
class ZohoCRM_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $zohoCRM    The ID of this plugin.
	 */
	private $zohoCRM;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $zohoCRM       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $zohoCRM, $version ) {

		$this->zohoCRM = $zohoCRM;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in ZohoCRM_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The ZohoCRM_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->zohoCRM, plugin_dir_url( __FILE__ ) . 'css/zohoCRM-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in ZohoCRM_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The ZohoCRM_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->zohoCRM, plugin_dir_url( __FILE__ ) . 'js/zohoCRM-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Register the settings page.
	 *
	 * @since	1.0.0
	 */
	//http://wpsettingsapi.jeroensormani.com/settings-generator
	function zohoCRM_add_admin_menu(  ) { 
		//add_options_page( 'Zoho CRM Settings', 'ZohoCRM', 'manage_options', 'zohoCRM', 'zohoCRM_options_page' );
		add_menu_page( 'Zoho CRM Settings', 'ZohoCRM', 'manage_options', 'zohoCRM', 'zohoCRM_options_page', 'none' );
	}

	function zohoCRM_settings_init(  ) { 
		register_setting( 'zohoCRM_settings', 'zohoCRM_settings' );

		add_settings_section(
			'zohoCRM_zohoCRM_settings_section', 
			__( 'Zoho CRM Account', 'zohoCRM' ), 
			'zohoCRM_gh_settings_section_callback', 
			'zohoCRM_settings'
		);
		
		// add_settings_section(
		// 	'zohoCRM_jobboard_settings_section', 
		// 	__( 'Zoho CRM Settings', 'zohoCRM' ), 
		// 	'zohoCRM_jb_settings_section_callback', 
		// 	'zohoCRM_settings'
		// );
		
		add_settings_section(
			'zohoCRM_plugin_settings_section', 
			__( 'Plugin Settings', 'zohoCRM' ), 
			'zohoCRM_p_settings_section_callback', 
			'zohoCRM_settings'
		);

		add_settings_section(
			'zohoCRM_plugin_endpoints_section', 
			__( 'Authorize Endpoints', 'zohoCRM' ), 
			'zohoCRM_ep_settings_section_callback', 
			'zohoCRM_settings'
		);

		//zoho authorize Zoho CRM endpoint
		add_settings_field(
			'zohoCRM_ep_crm',
			__( 'Zoho CRM API', 'zohoCRM' ),
			'zohoCRM_ep_crm_render', 
			'zohoCRM_settings', 
			'zohoCRM_plugin_endpoints_section' 
		);

		//zoho authorize Zoho Books endpoint
		add_settings_field(
			'zohoCRM_ep_books',
			__( 'Zoho Books API', 'zohoCRM' ),
			'zohoCRM_ep_books_render', 
			'zohoCRM_settings', 
			'zohoCRM_plugin_endpoints_section' 
		);

		//zoho_id
		add_settings_field(
			'zohoCRM_id',
			__( 'Zoho ID', 'zohoCRM' ),
			'zohoCRM_id_render', 
			'zohoCRM_settings', 
			'zohoCRM_zohoCRM_settings_section' 
		);

		//zoho_books_id
		add_settings_field(
			'zohoCRM_books_id',
			__( 'Zoho Books ID', 'zohoCRM' ),
			'zohoCRM_books_id_render', 
			'zohoCRM_settings', 
			'zohoCRM_zohoCRM_settings_section' 
		);

		//zoho_secret
		add_settings_field(
			'zohoCRM_secret',
			__( 'Zoho Secret', 'zohoCRM' ),
			'zohoCRM_secret_render', 
			'zohoCRM_settings', 
			'zohoCRM_zohoCRM_settings_section' 
		);

		//zoho_auth_callback
		add_settings_field(
			'zohoCRM_callback',
			__( 'Zoho oAuth Callback', 'zohoCRM' ),
			'zohoCRM_callback_render', 
			'zohoCRM_settings', 
			'zohoCRM_zohoCRM_settings_section' 
		);
		
		// //url_token
		// add_settings_field( 
		// 	'zohoCRM_url_token', 
		// 	__( 'URL Token', 'zohoCRM' ), 
		// 	'zohoCRM_url_token_render', 
		// 	'zohoCRM_settings', 
		// 	'zohoCRM_zohoCRM_settings_section' 
		// );

		// add_settings_field( 
		// 	'zohoCRM_api_key', 
		// 	__( 'API key', 'zohoCRM' ), 
		// 	'zohoCRM_api_key_render', 
		// 	'zohoCRM_settings', 
		// 	'zohoCRM_zohoCRM_settings_section' 
		// );

		add_settings_field( 
			'zohoCRM_cache_expiry', 
			__( 'Cache Expiration', 'zohoCRM' ), 
			'zohoCRM_cache_expiry_render', 
			'zohoCRM_settings', 
			'zohoCRM_zohoCRM_settings_section' 
		);

		add_settings_field( 
			'zohoCRM_clear_cache', 
			__( 'Clear Cache Now', 'zohoCRM' ), 
			'zohoCRM_clear_cache_render', 
			'zohoCRM_settings', 
			'zohoCRM_zohoCRM_settings_section' 
		);

		add_settings_field( 
			'zohoCRM_type', 
			__( 'Type', 'zohoCRM' ), 
			'zohoCRM_type_render', 
			'zohoCRM_settings', 
			'zohoCRM_jobboard_settings_section' 
		);
		
		
		add_settings_field( 
			'zohoCRM_custom_css', 
			__( 'Custom CSS', 'zohoCRM' ), 
			'zohoCRM_custom_css_render', 
			'zohoCRM_settings', 
			'zohoCRM_jobboard_settings_section' 
		);

		add_settings_field( 
			'zohoCRM_debug', 
			__( 'Debug', 'zohoCRM' ), 
			'zohoCRM_debug_render', 
			'zohoCRM_settings', 
			'zohoCRM_plugin_settings_section' 
		);
		
		add_settings_field( 
			'zohoCRM_analytics', 
			__( 'Add Analytics', 'zohoCRM' ), 
			'zohoCRM_analytics_render', 
			'zohoCRM_settings', 
			'zohoCRM_plugin_settings_section' 
		);
		
		/*
		add_settings_field( 
			'zohoCRM_allow_track', 
			__( 'Allow Tracking', 'zohoCRM' ), 
			'zohoCRM_allow_track', 
			'zohoCRM_settings', 
			'zohoCRM_plugin_settings_section' 
		);
		*/

		add_settings_field( 
			'zohoCRM_log_errors', 
			__( 'Log Errors', 'zohoCRM' ), 
			'zohoCRM_log_errors_render', 
			'zohoCRM_settings', 
			'zohoCRM_plugin_settings_section' 
		);
		
	}

	/**
	 * Add the shortcodes media button.
	 *
	 * @since    1.0.0
	 */
	public function zoho_add_shortcode_media_button() {
		add_thickbox();
		
		$zoho_settings_url = admin_url('options-general.php?page=zohoCRM' );
		echo <<<HTML
		
<a href="#TB_inline?width=600&height=550&inlineId=add-zoho-shortcode-form" id="add-zoho-shortcode-button" class="button thickbox">Add Zoho CRM Data</a>
<div id="add-zoho-shortcode-form" style="display:none;">
	<div class="zoho-wizard media-modal wp-core-ui">
		<div class="media-frame">
			<div class="media-frame-title">
				<h1>Greenhouse Job Board</h1>
				<h2>Shortcode Wizard</h2>
			</div>
			
			<div class="media-frame-content">
				<div class="section">
					<p>Use these settings to customize your short code settings and then insert your shortcode into your content.</p>
				</div>
				
				<!--<div class="section">
					<label>
						<input type="checkbox" class="include" data-include="url_token" />Include URL token to override <a href="$zoho_settings_url">plugin settings</a>?
					</label>
					<div class="section section_url_token" style="display:none;">
						<label for="url_token">Url token
							<input id="url_token" type="text" />
						</label>
					</div>
				</div>-->
				
				<!--<div class="section">
					<label>
						<input type="checkbox" class="include" data-include="api_key" />Include API Key to override <a href="$zoho_settings_url">plugin settings</a>?
					</label>
					<div class="section section_api_key" style="display:none;">
						<label for="api_key">API Key
							<input id="api_key" type="text" />
						</label>
					</div>
				</div>-->
				
				<div class="section">
					<label>
						<input type="checkbox" class="include" data-include="texts" />Set Text Values to override <a href="$zoho_settings_url">plugin settings</a>?
					</label>
				
					<div class="section section_texts" style="display:none;">
						<div class="section">
							<label for="apply_now">Apply Now Text
								<input id="apply_now" type="text" />
							</label>
						</div>
						<div class="section">
							<label for="apply_now_cancel">Apply Now Cancel Text
								<input id="apply_now_cancel" type="text" />
							</label>
						</div>
						<div class="section">
							<label for="read_full_desc">Read Full Description Text
								<input id="read_full_desc" type="text" />
							</label>
						</div>
						<div class="section">
							<label for="hide_full_desc">Hide Full Description Text
								<input id="hide_full_desc" type="text" />
							</label>
						</div>
						<div class="section">
							<label for="location_label">Location Label Text
								<input id="location_label" type="text" />
							</label>
						</div>
						<div class="section">
							<label for="office_label">Office Label Text
								<input id="office_label" type="text" />
							</label>
						</div>
						<div class="section">
							<label for="department_label">Department Label Text
								<input id="department_label" type="text" />
							</label>
						</div>
					</div>
				</div>
				
				<div class="section">
					<label>
						<input type="checkbox" id="hide_forms" class="include" checked data-include="display_form" />Display Application Forms?
					</label>
				
					<div class="section section_display_form">
						<label>
							<select id="form_type">
								<option value="default" selected>Use default setting</option>
								<option value="iframe">Embed iFrame forms</option>
								<option value="inline">Inline dynamic forms</option>
							</select>
						</label>
					
						<div class="section section_display_form section_form_fields" style="display:none;">
							<label for="form_fields">Form Fields
								<input id="form_fields" type="text" />
							</label>
							<div class="help_text">Pipe '|' delimeted. For example: First Name|Email (leave blank to display all fields).</div>
						</div>
						
					</div>
					
				</div>
				
				
				<div class="section">
					<label>
						<input type="checkbox" id="display_custom_meta" class="include" data-include="display_meta" />Customize Displayed Job Data?
					</label>
				
					<div class="section section_display_meta" style="display:none;">
						<div class="section">
							<label>
								<input type="checkbox" id="display_location" />Display Job Location?
							</label>
						</div>
						<div class="section">
							<label>
								<input type="checkbox" id="display_office" />Display Job Office?
							</label>
						</div>
						<div class="section">
							<label>
								<input type="checkbox" id="display_department" />Display Job Department?
							</label>
						</div>
						<div class="section">
							<label>
								<input type="checkbox" id="display_description" />Display Job Description?
							</label>
						</div>
					</div>
				</div>
				
				
				<div class="section">
					<label>
						<input type="checkbox" class="include" data-include="filter" />Filter jobs?
					</label>
				
					<div class="section section_filter" style="display:none;">
						<div class="section">
							<label>
								<input type="checkbox" class="include" data-include="department_filter" />Filter by department?
							</label>
							<div class="section section_department_filter" style="display:none;">
								<label for="department_filter">Department Filter
									<input id="department_filter" type="text" />
								</label>
								<div class="help_text">Pipe '|' delimeted. For example: Department 1| Department 2.</div>
							</div>
						</div>
						<div class="section">
							<label>
								<input type="checkbox" class="include" data-include="job_filter" />Filter by Job?
							</label>
							<div class="section section_job_filter" style="display:none;">
								<label for="job_filter">Job Filter
									<input id="job_filter" type="text" />
								</label>
								<div class="help_text">Pipe '|' delimited. For example: job 1| job 2.</div>
							</div>
						</div>
						<div class="section">
							<label>
								<input type="checkbox" class="include" data-include="office_filter" />Filter by Office?
							</label>
							<div class="section section_office_filter" style="display:none;">
								<label for="office_filter">Office Filter
									<input id="office_filter" type="text" />
								</label>
								<div class="help_text">Pipe '|' delimited. For example: office 1| office 2.</div>
							</div>
						</div>
						<div class="section">
							<label>
								<input type="checkbox" class="include" data-include="location_filter" />Filter by Location?
							</label>
							<div class="section section_location_filter" style="display:none;">
								<label for="location_filter">Location Filter
									<input id="location_filter" type="text" />
								</label>
								<div class="help_text">Single locations only. For example: location 1.</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="section">
					<label>
						<input type="checkbox" id="custom_order" class="include" data-include="custom_order" />Customize job order?
					</label>
				
					<div class="section section_custom_order" style="display:none;">
						<div class="section">
							<label>Order by: 
								<select id="board_orderby">
									<option value="title">Title</option>
									<option value="date">Date</option>
									<option value="id">Job ID</option>
									<option value="department">Department</option>
									<option value="location">Location</option>
									<option value="office">Office</option>
									<option value="random">Random</option>
								</select>
							</label>
						</div>
						<div class="section">
							<label>Order: 
								<select id="board_order">
									<option value="">Descending (default)</option>
									<option value="ASC">Ascending</option>
								</select>
							</label>
						</div>
						<div class="section">
							<label>
								<input type="checkbox" id="include_sticky" class="include" data-include="sticky" />Sticky job?
							</label>
							<div class="help_text">Force a job to 'stick' to the top or bottom of the job board no matter the sorting order.</div>

							<div class="section section_sticky" style="display:none;">
								<label>Stick position: 
									<select id="sticky_position">
										<option value="top">Top</option>
										<option value="bottom">Bottom</option>
									</select>
								</label>
							</div>
							
							<div class="section section_sticky" style="display:none;">
								<label for="sticky_id">Sticky job ID
									<input id="sticky_id" type="text" />
								</label>
								<div class="help_text">Enter the job id for the sticky job.</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="section">
					<label>
						<input type="checkbox" id="custom_group" class="include" data-include="custom_group" />Group jobs?
					</label>
				
					<div class="section section_custom_group" style="display:none;">
						<div class="section">
							<label>Group by: 
								<select id="grouping">
									<option value="department">Department</option>
									<option value="location">Location</option>
									<option value="office">Office</option>
								</select>
							</label>
						</div>
						<div class="section">
							<label>Display Group Headline: 
								<select id="group_headline">
									<option value="">Yes (default)</option>
									<option value="false">Don't Display Headline</option>
								</select>
							</label>
						</div>
					</div>
				</div>
			
			</div>
			
			<div class="media-frame-toolbar">
				<div class="media-toolbar-secondary">
					<a style="float: left;" href="#" onclick="tb_remove(); return false;">Cancel</a>		
				</div>				
				<div class="media-toolbar-primary">
					<a style="float: right;" class="insert-zoho-shortcode-button button button-primary button-large media-button">Insert Shortcode</a>
				</div>
			</div>
		</div>
	</div>
</div>

HTML;
	}

	
	
	
	

}
