<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link	  http://example.com
 * @since      1.7.0
 *
 * @package    ZohoCRM
 * @subpackage ZohoCRM/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 */
class ZohoCRM_Public {

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
	 * @param      string    $zohoCRM       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $zohoCRM, $version ) {

		$this->zohoCRM = $zohoCRM;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    2.0.1
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

		wp_register_style( $this->zohoCRM, plugin_dir_url( __FILE__ ) . 'css/zohoCRM-public.css', array(), $this->version, 'all' );
		
		$options = get_option( 'zohoCRM_settings' );
		if ( isset( $options['zohoCRM_custom_css'] ) && isset($options['zohoCRM_custom_css_checkbox']) &&
			 $options['zohoCRM_custom_css'] !== '') {
			$custom_css = $options['zohoCRM_custom_css'];		
			wp_add_inline_style( $this->zohoCRM, $custom_css );
		}
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.7.0
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
		$options = get_option( 'zohoCRM_settings' );
		$v = $this->version;
		if ( isset( $options['zohoCRM_debug'] ) &&
			 $options['zohoCRM_debug'] === 'true' ) {
			$v .= '_' . time();	
		}
		
		if ( !wp_script_is( 'handlebars', 'registered' ) ) {
			wp_register_script( 'handlebars', plugin_dir_url( __FILE__ ) . 'js/handlebars-v3.0.0.js', array( 'jquery' ), null, false );
		}
		if ( !wp_script_is( 'jquery.cycle2', 'registered' ) ) {
			wp_register_script( 'jquery.cycle2', plugin_dir_url( __FILE__ ) . 'js/jquery.cycle2.min.js', array( 'jquery' ), '20141007', false );
		}
		wp_register_script( 'ghjbp', plugin_dir_url( __FILE__ ) . 'js/zohoCRM_settings-public.js', array( 'jquery', 'handlebars' ), $v, false );
		
	}
	
	/**
	 * Register the shortcodes.
	 *
	 * @since    1.0.0
	 */

	public function register_shortcodes() {
		add_shortcode( 'zohoCRM', array( $this, 'zohoCRM_shortcode_function_test2') );
		add_shortcode( 'zohoCRM-oauthcallback', array( $this, 'zohoCRM_shortcode_oauthcallback_function') );
		add_shortcode( 'zohoCRM-editinfo', array( $this, 'zohoCRM_shortcode_editinfo_function') );
	}

	/**
	 * Handle the [zohoCRM-editinfo] shortcode.
	 *
	 * @since    1.0.0
	 */

	public function zohoCRM_shortcode_editinfo_function( $atts, $content= null){
		wp_enqueue_style($this->zohoCRM);
		$options = get_option( 'zohoCRM_settings' );
		$zoho = new Zoho;
		$zoho->options = $options; 
		$edit_html = '<h1>Zoho Edit Info</h1>';

		$edit_html .= '<section id="primary" class="content-area">';
		$edit_html .= '<main id="main" class="site-main">';
		$edit_html .= '<form>';
		//ToDo: add form fields here for editing Zoho Profile and Payment info
		$edit_html .= '<p>Placeholder text where form should go.</p>';

		$edit_html .= '</form>';
		$edit_html .= '</main>';
		$edit_html .= '</section>';
		
		return $edit_html;
	}
	
	/**
	 * Handle the [zohoCRM-oauthcallback] shortcode.
	 *
	 * @since    1.0.0
	 */

	public function zohoCRM_shortcode_oauthcallback_function( $atts, $content= null){
		wp_enqueue_style($this->zohoCRM);
		$options = get_option( 'zohoCRM_settings' );
		$zoho = new Zoho;
		$zoho->options = $options; 
		$oauthcallback_html = '<h1>Zoho oauthcallback</h1>';

		$oauthcallback_html .= '<section id="primary" class="content-area">';
		$oauthcallback_html .= '<main id="main" class="site-main">';

		//echo $_GET['state'];
		if(isset($_GET['code']) && isset($_GET['state'])) {
			// try to get an access token
			$code = $_GET['code'];
			$module = $_GET['state'];
			$maketoken = $zoho->getToken($code, $module);
			if($maketoken){
				$oauthcallback_html .=  "<p>Zoho access token created or updated.</p>";
			}else{
				$oauthcallback_html .=  "<p class='alert'>Something went horribly wrong while trying to acquire an access token from Zoho.</p>";
				
			//echo $maketoken;
			}
		}
		//echo $code;

		$oauthcallback_html .= '</main><!-- .site-main -->';
		$oauthcallback_html .=	'</section><!-- .content-area -->';
		
		return $oauthcallback_html;
	}

	/**
	 * Handle the main [zohoCRM] shortcode.
	 *
	 * @since    1.0.0
	 */

	public function zohoCRM_shortcode_function_test2( $atts, $content = null){
		wp_enqueue_style($this->zohoCRM);
		$options = get_option( 'zohoCRM_settings' );
		//$ghjb_html  = '<div class="zohoCRM">' . $options['zohoCRM_id'] . '</div>';

		$foo = new Zoho;
		$foo->options = $options; 

		$ghjb_html = '<div class="profile-main">';
		
		$testfoo = $foo->getZohoToken('CRM');
		$bookstokens = $foo->getZohoToken('Books');
		//print_r($testfoo);
     if(!$testfoo->access_token){
		//$testfoo = getZohoToken('CRM');
		$ghjb_html = '<p>Endpoint has not been authorized.</p>';
		}else{
			$access = $testfoo->access_token;
			$refresh = $testfoo->refresh_token;
				$data = $foo->getCRMContact($testfoo->access_token);
				if(isset($data['code'])){
						if($data['code'] == "INVALID_TOKEN"){
								$tst = $foo->refreshToken($access, $refresh, 'CRM');
								//$testfoo = getZohoToken('CRM');
								$data = $foo->getCRMContact($tst);
								//$data = $data['data'][0];
						}
					}
					if($data){
						$data = $data['data'][0];
						$bookdata = $foo->getBOOKSContacts($bookstokens->access_token, $data['Email']);
                        if(isset($bookdata['code'])){
						      if($bookdata['code'] === "INVALID_TOKEN"){
								   $tst2 = $foo->refreshToken($bookstokens->access_token, $bookstokens->refresh_token, 'Books');
								   $bookdata = $foo->getBOOKSContacts($tst2, $data['Email']);
								   //$data = $data['data'][0];
						                 }
					          }
						$ghjb_html .= '<div class="profile-box"><h2>My Profile</h2></div>';
						$ghjb_html .= '<div class="profile-box"><label>First Name:</label> ' . $data['First_Name'] . '</div>';
						$ghjb_html .= '<div class="profile-box"><label>Last Name:</label> ' . $data['Last_Name'] . '</div>';
						$ghjb_html .= '<div class="profile-box"><label>Email:</label> ' . $data['Email'] . '</div>';
						$ghjb_html .= '<div class="profile-box"><label>Zoho ID:</label> ' . $data['id'] . '</div>';
						$ghjb_html .= '<div class="profile-box"><label>Contact Type:</label> ';
						if($data['Contact_Type']){
							$ghjb_html .= $data['Contact_Type'];
						}else{
							$ghjb_html .= 'None found';
						}
						$ghjb_html .= '</div>';					
						                        if(!$bookdata){
                                                    $ghjb_html .= '<div class="profile-box"><label>Zoho Books ID:</label> None</div>';
                                                 }else{
													$ghjb_html .= '<div class="profile-box"><label>Zoho Books ID:</label> ' . $bookdata['contact_id'] . '</div>';
												 }
						$ghjb_html .= '<div class="profile-box"><label>Tags:</label></div>';
						if($data['Tag']){
							foreach ($data['Tag'] as $tag) {
							$ghjb_html .= '<div class="profile-box">' . $tag['name'] . '</div>';
							}
						}else{
							$ghjb_html .= '<div class="profile-box">No tags associated with this user</div>';
						}						 
					}else{
						$ghjb_html .= '<div class="profile-box"><h2>My Profile</h2></div>';
						$ghjb_html .= '<div class="profile-box">User Not Found in the system.</div>';
					}
			}	
		
			$ghjb_html .= '</div><!-- .profile-main -->';




		//$ghjb_html .= '<div>' . $foo->aMemberVar . '</div>';
		//$ghjb_html  .= '<div class="zohoCRM">' . $foo->options['zohoCRM_id'] . '</div>';
		return $ghjb_html;
	}


	
} ?>