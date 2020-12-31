<?php if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('You are not allowed to call this page directly.'); } ?>
<div class="wrap">
  <div class="form-wrap">
    <div id="icon-edit" class="icon32 icon32-posts-post"><br>
    </div>
    <h2><?php _e('Onclick show popup', 'onclick-show-popup'); ?></h2>
    <?php
	$OnclickShowPopup_title = get_option('OnclickShowPopup_title');
	$OnclickShowPopup_theme = get_option('OnclickShowPopup_theme');
	$OnclickShowPopup_widget = get_option('OnclickShowPopup_widget');
	$OnclickShowPopup_title_yes = get_option('OnclickShowPopup_title_yes');
	$OnclickShowPopup_random = get_option('OnclickShowPopup_random');
	$OnclickShowPopup_span_li = get_option('OnclickShowPopup_span_li');
	
	if (isset($_POST['OnclickShowPopup_form_submit']) && $_POST['OnclickShowPopup_form_submit'] == 'yes')
	{
		//	Just security thingy that wordpress offers us
		check_admin_referer('OnclickShowPopup_form_setting');
			
		$OnclickShowPopup_title = stripslashes(trim(sanitize_text_field($_POST['OnclickShowPopup_title'])));
		$OnclickShowPopup_theme = stripslashes(trim(sanitize_text_field($_POST['OnclickShowPopup_theme'])));
		$OnclickShowPopup_widget = stripslashes(trim(sanitize_text_field($_POST['OnclickShowPopup_widget'])));
		$OnclickShowPopup_title_yes = stripslashes(trim(sanitize_text_field($_POST['OnclickShowPopup_title_yes'])));
		$OnclickShowPopup_random = stripslashes(trim(sanitize_text_field($_POST['OnclickShowPopup_random'])));
		$OnclickShowPopup_span_li = stripslashes(trim(sanitize_text_field($_POST['OnclickShowPopup_span_li'])));
			
		if($OnclickShowPopup_theme != "dark_rounded" && $OnclickShowPopup_theme != "dark_square" 
			&& $OnclickShowPopup_theme != "default" && $OnclickShowPopup_theme != "light_rounded" 
			&& $OnclickShowPopup_theme != "facebook" && $OnclickShowPopup_theme != "light_square")
		{
			$OnclickShowPopup_theme = "dark_rounded";
		}
		
		if($OnclickShowPopup_title_yes != "YES" && $OnclickShowPopup_title_yes != "NO")
		{
			$OnclickShowPopup_title_yes = "YES";
		}
		
		if($OnclickShowPopup_random != "YES" && $OnclickShowPopup_random != "NO")
		{
			$OnclickShowPopup_random = "YES";
		}
		
		if($OnclickShowPopup_span_li != "LI" && $OnclickShowPopup_span_li != "SPAN")
		{
			$OnclickShowPopup_span_li = "LI";
		}
		
		update_option('OnclickShowPopup_title', $OnclickShowPopup_title );
		update_option('OnclickShowPopup_theme', $OnclickShowPopup_theme );
		update_option('OnclickShowPopup_widget', $OnclickShowPopup_widget );
		update_option('OnclickShowPopup_title_yes', $OnclickShowPopup_title_yes );
		update_option('OnclickShowPopup_random', $OnclickShowPopup_random );
		update_option('OnclickShowPopup_span_li', $OnclickShowPopup_span_li );
		?>
		<div class="updated fade">
			<p><strong><?php _e('Details successfully updated.', 'onclick-show-popup'); ?></strong></p>
		</div>
		<?php
	}
	?>
	<h3><?php _e('Popup setting', 'onclick-show-popup'); ?></h3>
	<form name="OnclickShowPopup_form" method="post" action="">
	
		<label for="tag-title"><?php _e('Widget title', 'onclick-show-popup'); ?></label>
		<input name="OnclickShowPopup_title" type="text" id="OnclickShowPopup_title" size="50" value="<?php echo $OnclickShowPopup_title; ?>" />
		<p><?php _e('Please enter widget title.', 'onclick-show-popup'); ?></p>
		
		<label for="tag-title"><?php _e('Theme', 'onclick-show-popup'); ?></label>
		<select name="OnclickShowPopup_theme" id="OnclickShowPopup_theme">
            <option value='dark_rounded' <?php if($OnclickShowPopup_theme == 'dark_rounded') { echo 'selected' ; } ?>>Dark Rounded</option>
            <option value='dark_square' <?php if($OnclickShowPopup_theme == 'dark_square') { echo 'selected' ; } ?>>Dark Square</option>
            <option value='default' <?php if($OnclickShowPopup_theme == 'default') { echo 'selected' ; } ?>>Default</option>
            <option value='light_rounded' <?php if($OnclickShowPopup_theme == 'light_rounded') { echo 'selected' ; } ?>>Light Rounded</option>
			<option value='facebook' <?php if($OnclickShowPopup_theme == 'facebook') { echo 'selected' ; } ?>>Facebook</option>
			<option value='light_square' <?php if($OnclickShowPopup_theme == 'light_square') { echo 'selected' ; } ?>>Light Square</option>
          </select>
		<p><?php _e('Please select your theme.', 'onclick-show-popup'); ?></p>
		
		<label for="tag-title"><?php _e('Display sidebar title', 'onclick-show-popup'); ?></label>
		<select name="OnclickShowPopup_title_yes" id="OnclickShowPopup_title_yes">
			<option value='YES' <?php if($OnclickShowPopup_title_yes == 'YES') { echo 'selected="selected"' ; } ?>>Yes</option>
			<option value='NO' <?php if($OnclickShowPopup_title_yes == 'NO') { echo 'selected="selected"' ; } ?>>No</option>
		</select>
		<p><?php _e('Do you want to show widget title?.', 'onclick-show-popup'); ?></p>
		
		<label for="tag-title"><?php _e('Ramdom display', 'onclick-show-popup'); ?></label>
		<select name="OnclickShowPopup_random" id="OnclickShowPopup_random">
			<option value='YES' <?php if($OnclickShowPopup_random == 'YES') { echo 'selected="selected"' ; } ?>>Yes</option>
			<option value='NO' <?php if($OnclickShowPopup_random == 'NO') { echo 'selected="selected"' ; } ?>>No</option>
		</select>
		<p><?php _e('Do you want to show popup in ramdom order?.', 'onclick-show-popup'); ?></p>
		
		<label for="tag-title"><?php _e('Popup group', 'onclick-show-popup'); ?></label>
		<select name="OnclickShowPopup_widget" id="OnclickShowPopup_widget">
		<?php
		$sSql = "SELECT distinct(OnclickShowPopup_group) as OnclickShowPopup_group FROM `".WP_OnclickShowPopup_TABLE."` order by OnclickShowPopup_group";
		$myDistinctData = array();
		$arrDistinctDatas = array();
		$thisselected = "";
		$myDistinctData = $wpdb->get_results($sSql, ARRAY_A);
		foreach ($myDistinctData as $DistinctData)
		{
			if(strtoupper($DistinctData['OnclickShowPopup_group']) == strtoupper($OnclickShowPopup_widget)) 
			{ 
				$thisselected = "selected='selected'" ; 
			}
			?><option value='<?php echo strtoupper($DistinctData['OnclickShowPopup_group']); ?>' <?php echo $thisselected; ?>><?php echo strtoupper($DistinctData['OnclickShowPopup_group']); ?></option><?php
			$thisselected = "";
		}
		?>
		</select>
		<p><?php _e('Please select your popup group.', 'onclick-show-popup'); ?></p>
		
		<label for="tag-title"><?php _e('Select option to use in the front page', 'onclick-show-popup'); ?></label>
		<select name="OnclickShowPopup_span_li" id="OnclickShowPopup_span_li">
			<option value='LI' <?php if($OnclickShowPopup_span_li == 'LI') { echo 'selected="selected"' ; } ?>>Use li Tag</option>
			<option value='SPAN' <?php if($OnclickShowPopup_span_li == 'SPAN') { echo 'selected="selected"' ; } ?>>Use span Tag</option>
		</select>
		<p><?php _e('Do you want to use &lt;li&gt; or &lt;span&gt; tag in frontend?.', 'onclick-show-popup'); ?></p>
		
		<div style="height:10px;"></div>
		<input type="hidden" name="OnclickShowPopup_form_submit" value="yes"/>
		<input name="OnclickShowPopup_submit" id="OnclickShowPopup_submit" class="button add-new-h2" value="<?php _e('Submit', 'onclick-show-popup'); ?>" type="submit" />
		<input name="publish" lang="publish" class="button add-new-h2" onclick="OnclickShowPopup_redirect()" value="<?php _e('Cancel', 'onclick-show-popup'); ?>" type="button" />
		<input name="Help" lang="publish" class="button add-new-h2" onclick="OnclickShowPopup_help()" value="<?php _e('Help', 'onclick-show-popup'); ?>" type="button" />
		<?php wp_nonce_field('OnclickShowPopup_form_setting'); ?>
	</form>
  </div>
</div>
