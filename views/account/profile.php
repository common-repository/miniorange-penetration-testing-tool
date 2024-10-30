<?php  
$forget_nonce = wp_create_nonce('mospt-forget-nonce');
echo'
    <div class="mo_wpns_divided_layout">
        <div class="mo_wpns_setting_layout" >
          <div>
                <h4>Thank You for registering with miniOrange.</h4>
                <h3>Your Profile</h3>
                <table border="1" style="background-color:#FFFFFF; border:1px solid #CCCCCC; border-collapse: collapse; padding:0px 0px 0px 10px; margin:2px; width:85%">
                    <tr>
                        <td style="width:45%; padding: 10px;">Username/Email</td>
                        <td style="width:55%; padding: 10px;">'.esc_html($email).'</td>
                    </tr>
                    <tr>
                        <td style="width:45%; padding: 10px;">Customer ID</td>
                        <td style="width:55%; padding: 10px;">'.esc_html($key).'</td>
                    </tr>
                    <tr>
                        <td style="width:45%; padding: 10px;">API Key</td>
                        <td style="width:55%; padding: 10px;">'.esc_html($api).'</td>
                    </tr>
                    <tr>
                        <td style="width:45%; padding: 10px;">Token Key</td>
                        <td style="width:55%; padding: 10px;">'.esc_html($token).'</td>
                    </tr>
                </table>
                <br/>
                <p><a href="#mo_wpns_forgot_password_link">Click here</a> if you forgot your password to your miniOrange account.</p>
                <a target="_blank" href="https://login.xecurify.com/moas/initializepayment" id="redirect_to_payment" hidden></a>
            </div>
        </div>
    </div>
    <form id="forgot_password_form" method="post" action="">
        <input type="hidden" name="option" value="mo_wpns_reset_password" />
        <input type="hidden" name="mospt_forget_nonce" value="'.$forget_nonce.'" />

    </form>
   
	<script>
		jQuery(document).ready(function(){
			jQuery(\'a[href="#mo_wpns_forgot_password_link"]\').click(function(){
				jQuery("#forgot_password_form").submit();
			}); 
		});
	</script>';

$mospt_customer_selected_plan = get_option( 'mospt_customer_selected_plan' );
        if ( ! empty( $mospt_customer_selected_plan ) ) {
            delete_option( 'mospt_customer_selected_plan' );
          ?><script type="text/javascript">jQuery('#is_from_upgrade').submit();</script>
<?php }  