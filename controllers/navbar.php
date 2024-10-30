<?php

$logo_url = plugin_dir_url(dirname(__FILE__)) . 'includes' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'miniorange_logo.png';
$profile_url = add_query_arg(array('page' => 'moSPT_site_account'), sanitize_text_field($_SERVER['REQUEST_URI']));
$penTest_main_url = add_query_arg(array('page' => 'moSPT_site_PenTest'), sanitize_text_field($_SERVER['REQUEST_URI']));
$report_url = add_query_arg(array('page' => 'moSPT_site_statistics	'), sanitize_text_field($_SERVER['REQUEST_URI']));

include $MoSPTDirName . 'views' . DIRECTORY_SEPARATOR . 'navbar.php';