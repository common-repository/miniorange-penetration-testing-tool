<?php
  //if uninstall not called from WordPress exit
   if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) 
       exit();

       delete_option('mospt_customer_selected_plan');
       delete_option('MoSPT_dbversion');
       delete_option('mo2f_user_phone');
       delete_option('mo2f_email');
       delete_option('mo2f_customerKey');
       delete_option('mo2f_api_key');
       delete_option('mo2f_customer_token');
       delete_option('mo2f_app_secret');
       delete_option('mo2f_miniorange_admin');
?>