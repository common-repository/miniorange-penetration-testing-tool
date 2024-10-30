<?php
$nonce = wp_create_nonce('mospt-support-nonce');

echo'	
		<div class="mo_wpns_divided_layout_2">

		<div class="mo_wpns_support_layout">
			<img src="'.dirname(plugin_dir_url(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR .'images'.DIRECTORY_SEPARATOR .'support3.png">
			<h1>Support</h1>
			<p>Need any help? We are available any time, Just send us a query so we can help you.</p>
				<form name="f" method="post" action="">
					<input type="hidden" name="option" value="mo_wpns_send_query"/>
					<input type="hidden" name="mospt_support_nonce" value="'.$nonce.'"/>
					<table class="mo_wpns_settings_table">
						<tr><td>
							<input type="email" class="mo_wpns_table_textbox" id="query_email" name="query_email" value="'.esc_html($email).'" placeholder="Enter your email" required />
							</td>
						</tr>
						<tr><td>
							<input type="text" class="mo_wpns_table_textbox" name="query_phone" id="query_phone" value="'.esc_html($phone).'" placeholder="Enter your phone"/>
							</td>
						</tr>
						<tr>
							<td>
								<textarea id="query" name="query" class="mo_wpns_settings_textarea" style="resize: vertical;width:100%" cols="52" rows="7" placeholder="Write your query here"></textarea>
							</td>
						</tr>
					</table>
					<input type="submit" name="send_query" id="send_query" value="Submit Query" style="margin-bottom:3%;" class="mo_wpns_button mo_wpns_button1" />
				</form>
				<br />			
		</div>
		</div>';