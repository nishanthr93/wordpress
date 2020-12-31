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

	<p class="paragraphText">Planfy Online Booking is now installed on your website! Continue setting up your account by Launching the Dashboard.</p>

	<h2 class="nav-tab-wrapper wp-clearfix">
		<a class="nav-tab nav-tab-active">Booking Dashboard</a>
		<a class="nav-tab" href="https://planfy.on.spiceworks.com/portal">Support</a>
		<a onClick="return confirm('Are you sure you want to disconnect your account?')" href="/wp-admin/admin-post.php?action=planfy_uninstall" class="nav-tab">Uninstall</a>
	</h2>

	<div class="instructions">
		<a href="https://www.planfy.com/portal?account=<?php echo get_option('planfy_account_url'); ?>" style="position:relative;width:100%;background:#f6f7fa;border:1px solid #ccc;text-align:center;display:block;">
			<img src="https://www.planfy.com/assets/images/front/b2b/planfy-booking-system.png" style="border:0;max-height:600px;margin:0 auto;max-width:600px;width:100%"/>
		</a>

		<a href="https://www.planfy.com/portal?account=<?php echo get_option('planfy_account_url'); ?>" target="_blank" class="Btn Btn--md Btn--md--raised Btn--fw Btn--primary">
			Launch Online Booking Dashboard
		</a>
	</div>
</div>
