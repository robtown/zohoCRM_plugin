<?php 
class Zoho { 
    public $options = null;

    /**
 *  Custom Functions to access the Zoho API's
 * 
 */

 // Insert/Upsert the tokens into the WordPress database as needed
 function insert_tokens($access, $refresh, $module) {
    global $wpdb; //removed $name and $description there is no need to assign them to a global variable
    $table_name = $wpdb->prefix . "zoho_tokens"; //try not using Uppercase letters or blank spaces when naming db tables
   
    $results = getZohoToken($module);
    
    if($results){
        $wpdb->replace($table_name, array(
            'zoho_token_id' => $results->zoho_token_id,
            'access_token' => $access,
            'refresh_token' => $refresh,
            'zoho_module' => $module,
            'token_scope' => 'ALL',
            'date_inserted' => date('Y-m-d H:i:s')
             ),array('%s', '%s', '%s', '%s', '%s')
            );
            //echo "Existing Token: " . $wpdb->insert_id . '<br>';
    }else{
        $wpdb->insert($table_name, array(
            'access_token' => $access,
            'refresh_token' => $refresh,   
            'zoho_module' => $module,
            'token_scope' => 'ALL',
            'date_inserted' => date('Y-m-d H:i:s')
                ),array('%s', '%s', '%s', '%s', '%s')
                );
              //  echo "New Token: " . $wpdb->insert_id . '<br>';
    }
  }

  // Retreive tokens from DB
function getZohoToken($module){
    global $wpdb; 
    $table_name = $wpdb->prefix . "zoho_tokens";
      $results = $wpdb->get_row( "SELECT * FROM " . $table_name . " WHERE Zoho_module = '" . $module . "'" );
               return $results;
}

// Used by the oauthcallback page function to acquire the actual access token 
function getToken($code, $module){
            $options = get_option( 'zohoCRM_settings' );
            $url = 'https://accounts.zoho.com/oauth/v2/token';
            $client_id = $options['zohoCRM_id'];
            $client_secret = $options['zohoCRM_secret'];
            $state = 'testing';
            $response_type = 'code';
            $redirect_uri = $options['zohoCRM_callback'];
            $access_type = 'offline';
           
           // print_r($options);
			$myvars = 'code=' . $code . '&client_id='. $client_id . '&client_secret=' . $client_secret . '&redirect_uri='. $redirect_uri .'&grant_type=authorization_code';

            $ch = curl_init( $url );
			curl_setopt( $ch, CURLOPT_POST, 1);
			curl_setopt( $ch, CURLOPT_POSTFIELDS, $myvars);
			curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt( $ch, CURLOPT_HEADER, 0);
			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

			$response = curl_exec( $ch );
			$result = json_decode($response, true);

            $result = $result; 
            //print_r($result);
			if(!isset($result['error'])){
            $foo = $result["access_token"];
            if(isset($result["access_token"])){
                $reftemp = 'none';
                if(isset($result['refresh_token'])){
                    $reftemp = $result['refresh_token'];
                }
                $accesstemp = $result["access_token"];
                insert_tokens($accesstemp,$reftemp, $module);
            }
					return true;
				}else{
					return false;
				}
}

    // Refresh the access token if it needs
function refreshToken($access, $refresh, $module){
        $options = get_option( 'zohoCRM_settings' );
        $CID = $options['zohoCRM_id'];
        $SECRET = $options['zohoCRM_secret'];
	$refreshurl = "https://accounts.zoho.com/oauth/v2/token?refresh_token=" . $refresh . "&client_id=" . $CID . "&client_secret=" . $SECRET . "&grant_type=refresh_token";
            $ch = curl_init( $refreshurl );
			curl_setopt( $ch, CURLOPT_POST, 1);
			//curl_setopt( $ch, CURLOPT_POSTFIELDS, $myvars);
			curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt( $ch, CURLOPT_HEADER, 0);
			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

			$response = curl_exec( $ch );
			$result = json_decode($response, true);

            $result = $result; 
            insert_tokens($result['access_token'], $refresh, $module);
           //print_r($result);
		return $result['access_token'];
}

// Get the Zoho CRM user info
function getCRMContact($token){
	$user = wp_get_current_user();
	  $zohoapiurl = "https://www.zohoapis.com/crm/v2/Contacts";
	// echo "Calling " . $zohoapiurl . "<br>";
	$havemetafield  = get_user_meta($user->ID, 'zoho_id', false);
	if($havemetafield){
		$zohoapiurl = $zohoapiurl . '/' . $havemetafield[0];

		$ch2 = curl_init($zohoapiurl);
		$headr = array();
		$headr[] = 'Content-length: 0';
		$headr[] = 'Content-type: application/json';
		$headr[] = 'Authorization: Zoho-oauthtoken '. $token;

		curl_setopt($ch2, CURLOPT_HTTPHEADER,$headr);
		curl_setopt( $ch2, CURLOPT_RETURNTRANSFER, 1);
	  	//curl_setopt($ch2, CURLOPT_POST,true);
		$rest = curl_exec($ch2);
		curl_close($ch2);
		 //print_r($rest);
		$data = json_decode($rest, true);
		return $data;
	}
		   return false;
}

// Get the zoho Books user info
function getBOOKSContacts($token, $booksuser){
    $ret = false;
    ///echo 'Token: ' . $token . ' User: ' . $booksuser; 
  $zohoapiurl = "https://books.zoho.com/api/v3/contacts";
    $ch2 = curl_init($zohoapiurl);
    $headr = array();
    $headr[] = 'Content-length: 0';
    $headr[] = 'Content-type: application/json';
    $headr[] = 'Authorization: Zoho-oauthtoken '. $token;

    curl_setopt($ch2, CURLOPT_HTTPHEADER,$headr);
    curl_setopt( $ch2, CURLOPT_RETURNTRANSFER, 1);
      //curl_setopt($ch2, CURLOPT_POST,true);
    $rest = curl_exec($ch2);
            $httpcode = curl_getinfo($ch2, CURLINFO_HTTP_CODE);
    curl_close($ch2);
    // print_r($rest);
    $data = json_decode($rest, true);
            if($httpcode == 401 || $httpcode == 401){
              $data['code'] = "INVALID_TOKEN";
                  $ret = $data;
              
           }else{
            foreach ($data['contacts'] as $value) {
                  if($value['email'] == $booksuser){
                       $ret = $value;
                      //print_r($ret);
                  }
            }
           }
    return $ret;
   }
}
?>