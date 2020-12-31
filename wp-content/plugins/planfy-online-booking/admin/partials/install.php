<?php

/**
* Provide a admin area view for the plugin
*
* This file is used to markup the admin-facing aspects of the plugin.
*
* @link       https://www.planfy.com
* @since      1.0.0
*
* @package    Planfy
* @subpackage Planfy/admin/partials
*/
?>

<link rel="stylesheet" href="https://www.planfy.com/assets/css/front-style.css" />

<div class="wrap about-wrap">
	<h1>Online Booking System <small style="font-size:18px;font-weight:100;">by Planfy</small></h1>

	<p class="paragraphText">Thank-you for installing Planfy Online Booking. Lets get you setup!</p>

	<h2 class="nav-tab-wrapper wp-clearfix">
		<a href="#" class="nav-tab nav-tab-active">Installation</a>
	</h2>

	<div class="instructions">
		<iframe height="600" id="frame" src="https://www.planfy.com/integration/wordpress/link?platform=wordpress&website=<?php echo get_site_url(); ?>" width="99%" border="0"></iframe>
	</div>

	<form action="/wp-admin/admin-post.php" method="post" id="planfy_install_form">
		<input type="hidden" name="action" value="planfy_install" />

		<input type="hidden" id="planfy_account_id" name="planfy_account_id" value="<?php echo get_option('planfy_account_id'); ?>" />
		<input type="hidden" id="planfy_account_url" name="planfy_account_url" value="<?php echo get_option('planfy_account_url'); ?>" />
		<input type="hidden" id="planfy_account_name" name="planfy_account_name" value="<?php echo get_option('planfy_account_name'); ?>" />
	</form>
</div>
