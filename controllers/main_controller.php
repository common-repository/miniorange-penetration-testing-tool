<?php
global $MoSPTDirName;
$controller = $MoSPTDirName . 'controllers'.DIRECTORY_SEPARATOR.'PenTest'.DIRECTORY_SEPARATOR;
global $active_tab;
include $MoSPTDirName . 'controllers'.DIRECTORY_SEPARATOR. 'navbar.php';

if( isset( $_GET[ 'page' ]))

{

	$page = sanitize_text_field(wp_unslash($_GET['page']));

	switch($page){
		case 'moSPT_site_PenTest':
			include $controller . 'registeration.php';
			break;
		case 'moSPT_site_statistics':
			include $controller . 'statistics.php';
			break;
		case 'moSPT_site_account':
			include $controller . 'account.php';
			break;
	}
}

include $MoSPTDirName . 'controllers'.DIRECTORY_SEPARATOR. 'support.php';