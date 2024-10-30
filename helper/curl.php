<?php
include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'mospt_api.php';

class MoSPT_callAPI
{
       
       function mospt_submit_contact_us( $q_email, $q_phone, $query )
		{
		$current_user = wp_get_current_user();
		$url    = MoSPT_Constants::HOST_NAME . "/moas/rest/customer/contact-us";
		$query  = '[WordPress Penetration Testing Tool: - V '.MoSPT_PLUGIN_VERSION.']: ' . $query;
        
		$fields = array(
					'firstName'	=> $current_user->user_firstname,
					'lastName'	=> $current_user->user_lastname,
					'company' 	=> sanitize_text_field($_SERVER['SERVER_NAME']),
					'email' 	=> $q_email,
					'ccEmail'   => '2fasupport@xecurify.com',
					'phone'		=> $q_phone,
					'query'		=> $query
				);
		$field_string = json_encode( $fields );
        $headers = array("Content-Type"=>"application/json","charset"=>"UTF-8","Authorization"=>"Basic");
        $mospt_api =  new MOSPT_API();
        return $mospt_api->mospt_make_curl_call( $url, $field_string );

	  }

        function mospt_check_customer() {
        $url = MoSPT_Constants::HOST_NAME . "/moas/rest/customer/check-if-exists";
        $email = get_option( "mo2f_email" );
        $fields = array (
            'email' => $email
        );
        $field_string = json_encode ( $fields );

        $headers = array("Content-Type"=>"application/json","charset"=>"UTF-8","Authorization"=>"Basic");
        $mospt_api =  new MOSPT_API();
        return $mospt_api->mospt_make_curl_call( $url, $field_string );

    }

    function mospt_forgot_password()
    {
    
        $url         = MoSPT_Constants::HOST_NAME . '/moas/rest/customer/password-reset';
        $email       = get_option('mo2f_email');

    
        $fields      = array(
                        'email' => $email
                     );
    
        $field_string        = json_encode($fields);

        $headers = array("Content-Type"=>"application/json","charset"=>"UTF-8","Authorization"=>"Basic");
        $mosptApi= new MOSPT_API();
        return $mosptApi->mospt_make_curl_call( $url, $field_string );
    }


    function mospt_create_customer($email, $company, $password, $phone = '', $first_name = '', $last_name = '') {

        $url = MoSPT_Constants::HOST_NAME . '/moas/rest/customer/add';
       
        $fields       = array(
            'companyName'     => $company,
            'areaOfInterest'  => 'WordPress Site-Uptime Plugin',
            'productInterest' => 'Site-Uptime Monitor',
            'firstname'       => $first_name,
            'lastname'        => $last_name,
            'email'           => $email,
            'phone'           => $phone,
            'password'        => $password
        );
        $field_string = json_encode( $fields );
        $headers = array("Content-Type"=>"application/json","charset"=>"UTF-8","Authorization"=>"Basic");
        $mosptApi= new MOSPT_API();
        return $mosptApi->mospt_make_curl_call( $url, $field_string );
    }

     function mospt_get_customer_key($email,$password) {
        $url      = MoSPT_Constants::HOST_NAME . "/moas/rest/customer/key";
        $fields       = array(
            'email'    => $email,
            'password' => $password
        );
        $field_string = json_encode( $fields );
        
        $headers = array("Content-Type"=>"application/json","charset"=>"UTF-8","Authorization"=>"Basic");
        $mospt_api =  new MOSPT_API();
        return $mospt_api->mospt_make_curl_call( $url, $field_string );
    }

    function mospt_send_email_alert($email,$phone,$message,$feedback_option){


        global $user;
        $url = MoSPT_Constants::HOST_NAME . '/moas/api/notify/send';
        $customerKey = MoSPT_Constants::DEFAULT_CUSTOMER_KEY;
        $apiKey      = MoSPT_Constants::DEFAULT_API_KEY;
        $fromEmail			= 'no-reply@xecurify.com';
        if ($feedback_option == 'mospt_skip_feedback')
        {
            $subject            = "Deactivate [Skipped Feedback]: WordPress miniOrange Penetration Testing Tool -". $email;
        }
        else if ($feedback_option == 'mospt_feedback')
        {

            $subject            = "Feedback: WordPress miniOrange Penetration Testing Tool -". $email;
        }



        $user         = wp_get_current_user();
        $query = '[WordPress miniOrange Penetration Testing Tool: - V '.MoSPT_PLUGIN_VERSION.']: ' . $message;
        $content='<div >Hello, <br><br>First Name :'.$user->user_firstname.'<br><br>Last  Name :'.$user->user_lastname.'   <br><br>Company :<a href="'.$_SERVER['SERVER_NAME'].'" target="_blank" >'.$_SERVER['SERVER_NAME'].'</a><br><br>Phone Number :'.$phone.'<br><br>Email :<a href="mailto:'.$email.'" target="_blank">'.$email.'</a><br><br>Query :'.$query.'</div>';
        $fields = array(
            'customerKey'	=> $customerKey,
            'sendEmail' 	=> true,
            'email' 		=> array
            (
                'customerKey' 	=> $customerKey,
                'fromEmail' 	=> $fromEmail,
                'fromName' 		=> 'Xecurify',
                'toEmail' 		=> '2fasupport@xecurify.com',
                'toName' 		=> '2fasupport@xecurify.com',
                'subject' 		=> $subject,
                'content' 		=> $content
            ),
        );

        $field_string = json_encode($fields);
        $mospt_api =  new MOSPT_API();
        $authHeader   = $this->createAuthHeader($customerKey,$apiKey);
        $response = $mospt_api->mospt_make_curl_call( $url, $field_string , $authHeader);
        return $response;
    }

    function createAuthHeader($customerKey, $apiKey) {
        $currentTimestampInMillis = round(microtime(true) * 1000);
        $currentTimestampInMillis = number_format($currentTimestampInMillis, 0, '', '');

        /* Creating the Hash using SHA-512 algorithm */
        $stringToHash   = $customerKey . $currentTimestampInMillis . $apiKey;;
        $hashValue      = hash( "sha512", $stringToHash );

        $headers = array(
            "Content-Type"  => "application/json",
            "Customer-Key"  => $customerKey,
            "Timestamp"     => $currentTimestampInMillis,
            "Authorization" => $hashValue
        );

        return $headers;
    }
    
}