<?php

echo'<div class="wrap">
				<div><img  style="float:left;margin-top:5px;" src="'.$logo_url.'"></div>
				<h1>
					miniOrange Site PenTest &nbsp;
					<a class="add-new-h2 " href="'.$profile_url.'">Account</a>	
				</h1>

		</div>';
		$active_tab = sanitize_text_field(wp_unslash($_GET['page']));
		if($active_tab == 'moSPT_site')
			$active_tab = 'moSPT_site_PenTest';
		?>

<div class="mo_flex-container" style="margin-bottom: 55px;">
	
	<a class="nav-tab <?php echo ($active_tab == 'moSPT_site_PenTest' 	  ? 'nav-tab-active' : '')?>" href="<?php echo $penTest_main_url;?>" id="schdule">Scan</a>
    <a class="nav-tab <?php echo ($active_tab == 'moSPT_site_statistics' 	  ? 'nav-tab-active' : '')?>" href="<?php echo $report_url;?>" id="report">Last Scan Summary</a>

</div>
<br>