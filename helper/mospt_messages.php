<?php
	
	class moSPT_messages
	{

		const SUPPORT_FORM_VALUES				= "Please submit your query along with email.";
		const SUPPORT_FORM_SENT					= "Thanks for getting in touch! We shall get back to you shortly.";
		const SUPPORT_FORM_ERROR				= "Your query could not be submitted. Please try again.";

        const NONCE_ERROR						= 'Nonce error';

        const PASS_LENGTH						= 'Choose a password with minimum length 6.';
        const PASS_MISMATCH						= 'Password and Confirm Password do not match.';
		const REQUIRED_FIELDS					= 'Please enter all the required fields';
		const ACCOUNT_EXISTS					= 'You already have an account with miniOrange. Please SIGN IN.';
		const RESET_PASS						= 'You password has been reset successfully and sent to your registered email. Please check your mailbox.';
		const REG_SUCCESS						= 'Your account has been retrieved successfully.';
		const INVALID_CREDENTIALS               = 'Invalid Credentials.';
		const INVALID_REQ                       = 'Invalid request. Please try again';

		public static function mospt_show_message($message , $data=array())
		{
			$message = constant( "self::".$message );
		    foreach($data as $key => $value)
		    {
		        $message = str_replace("{{" . $key . "}}", $value , $message);
		    }
		    return $message;
		}

	}

?>