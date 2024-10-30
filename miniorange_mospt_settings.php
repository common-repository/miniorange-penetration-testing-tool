<?php
/**
 * Plugin Name: miniOrange Penetration Testing Tool
 * Description: Scan your Website for the top 10 OWASP Vulnerabilities and get a detailed report over email.
 * Version: 1.0.5
 * Author: miniOrange
 * Author URI: https://miniorange.com
 * License: GPL2
 */
 
 define( 'MoSPT_PLUGIN_VERSION', '1.0.5' );
 define('SPT_TEST_MODE', false);

 class MoSPT_PenTest
 {
	 function __construct()
     {
         register_activation_hook(__FILE__, array($this, 'MoSPT_activate'));
         register_deactivation_hook(__FILE__,array($this,'MoSPT_deactivate'));
         add_action('admin_menu', array($this, 'MoSPT_widget_menu'));
         add_action('admin_enqueue_scripts', array($this, 'MoSPT_settings_style'));
         add_action('admin_enqueue_scripts', array($this, 'MoSPT_settings_script'));
         add_action('moSPT_show_message', array($this, 'MoSPT_show_messages'), 1, 2);
         add_action( 'admin_footer', array( $this, 'mospt_feedback_request'));
		$this->MoSPT_includes();
	 }

     function MoSPT_activate()
     {
         global $PenTestDbQueries;
         $PenTestDbQueries->MoSPT_plugin_activate();
     }

     function MoSPT_deactivate()
     {
         delete_option('mospt_customer_selected_plan');
         delete_option('MoSPT_dbversion');
         delete_option('mo2f_user_phone');
         delete_option('mo2f_email');
         delete_option('mo2f_customerKey');
         delete_option('mo2f_api_key');
         delete_option('mo2f_customer_token');
         delete_option('mo2f_app_secret');
         delete_option('mo2f_miniorange_admin');
         delete_site_option('mospt_activated_time');
     }

     function MoSPT_widget_menu()
     {
         $menu_slug = 'moSPT_site_PenTest';
         add_menu_page('miniOrange Penetration Testing Tool', 'miniOrange Penetration Testing Tool', 'activate_plugins', $menu_slug, array($this, 'MoSPT_main'), plugin_dir_url(__FILE__) . 'includes' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'miniorange_icon.png');
         add_submenu_page($menu_slug, 'miniOrange Penetration Testing Tool', 'Scan', 'administrator',$menu_slug, array($this, 'MoSPT_main'), 2);
         add_submenu_page($menu_slug, 'miniOrange Penetration Testing Tool', 'Summary', 'administrator', 'moSPT_site_statistics', array($this, 'MoSPT_main'), 5);
         add_submenu_page($menu_slug, 'miniOrange Penetration Testing Tool', 'Account', 'administrator', 'moSPT_site_account', array($this, 'MoSPT_main'), 7);
     }

     function MoSPT_main()
     {
         include 'controllers' . DIRECTORY_SEPARATOR . 'main_controller.php';
     }

     function MoSPT_settings_style($hook)
     {
         if (strpos($hook, 'page_moSPT')) {
             wp_enqueue_style('mo_wpns_admin_settings_style', plugins_url('includes' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'mospt_style_settings.css', __FILE__));
             wp_enqueue_style('mo_wpns_report_style', plugins_url('includes' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'style-report.css', __FILE__));
             wp_enqueue_style('mo_wpns_admin_settings_datatable_style', plugins_url('includes' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'jquery.dataTables.min.css', __FILE__));
         }
     }

     function MoSPT_settings_script($hook)
     {
         if (strpos($hook, 'page_moSPT')) {
             wp_enqueue_script('mo_wpns_admin_datatable_script', plugins_url('includes' . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'jquery.dataTables.min.js', __FILE__), array('jquery'));
         }
     }

	  function MoSPT_show_messages($content,$type)
		{
			if($type=="NOTICE")
				echo '	<div class="is-dismissible notice notice-warning"> <p>'.esc_html($content).'</p> </div>';
			if($type=="ERROR")
				echo '	<div class="notice notice-error is-dismissible"> <p>'.esc_html($content).'</p> </div>';
			if($type=="SUCCESS")
				echo '	<div class="notice notice-success"> <p>'.esc_html($content).'</p> </div>';
		}
	  
	  function MoSPT_includes(){
          require('database' . DIRECTORY_SEPARATOR . 'database_functions.php');
          require('helper' . DIRECTORY_SEPARATOR . 'curl.php');
          require('helper' . DIRECTORY_SEPARATOR . 'constants.php');
          require('helper' . DIRECTORY_SEPARATOR . 'utility.php');
          require('controllers' . DIRECTORY_SEPARATOR . 'PenTest'.DIRECTORY_SEPARATOR. 'ajax.php');
          require('helper' . DIRECTORY_SEPARATOR . 'mospt_messages.php');
          require('controllers'.DIRECTORY_SEPARATOR.'PenTest'.DIRECTORY_SEPARATOR.'feedback.php');
	  }

     function mospt_feedback_request(){
         if ( 'plugins.php' != basename( $_SERVER['PHP_SELF'] ) ) {
             return;
         }

         $email = get_option("mo2f_email");
         if(empty($email)){
             $user = wp_get_current_user();
             $email = $user->user_email;
         }
         $imagepath=plugins_url( '/includes/images/', __FILE__ );
         wp_enqueue_style( 'wp-pointer' );
         wp_enqueue_script( 'wp-pointer' );
         wp_enqueue_script( 'utils' );
         wp_enqueue_style( 'mospt_admin_plugins_page_style', plugins_url( '/includes/css/mospt_feedback_style.css', __FILE__ ) );

         global $MoSPTDirName;
         include $MoSPTDirName.'views'.DIRECTORY_SEPARATOR.'feedback.php';
     }
}

new MoSPT_PenTest();
