<?php
class MoSPT_PenTestQuery
{
	function __construct()
    {
		global $wpdb;
		$this-> userDetailsTable    = $wpdb->prefix . 'mo2f_user_details';
	}
	
	
	function MoSPT_plugin_activate()
    {
	    global $wpdb;
        add_site_option('mospt_activated_time', time());
		if(!get_option('MoSPT_dbversion')||get_option('MoSPT_dbversion')<147)
		{
		    update_option('MoSPT_dbversion', MoSPT_Constants::DB_VERSION );
		}
		else {
			$current_db_version = get_option('MoSPT_dbversion');
			if($current_db_version < MoSPT_Constants::DB_VERSION)
			update_option('MoSPT_dbversion', MoSPT_Constants::DB_VERSION );
		}
	}

	function moSPT_get_user_detail( $column_name, $user_id )
    {
		global $wpdb;
		if($wpdb->get_var("SHOW TABLES LIKE '$this->userDetailsTable'")!==$this->userDetailsTable )
			return 'error';
		$user_column_detail = $wpdb->get_results( "SELECT " . $column_name . " FROM " . $this->userDetailsTable . " WHERE user_id = " . $user_id . ";" );
		$value              = empty( $user_column_detail ) ? '' : get_object_vars( $user_column_detail[0] );

		return $value == '' ? '' : $value[ $column_name ];
	}
	
}
