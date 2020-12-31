<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

class The7Brainstorm extends BundledContent {

	private $ultimate_addon_id = 6892199;
	private $convert_plus_id = 14058953;

	public function activatePlugin() {
		$this->activateBrainstormPlugins();
		return;
	}

	public function deactivatePlugin() {
	}

	public function isActivatedPlugin() {
		return false;
	}

	protected function getBundledPluginCode() {
		return '';
	}

	private function activateBrainstormPlugins() {
		if ( ! class_exists( 'Ultimate_VC_Addons', false ) && ! class_exists( 'Convert_Plug', false ) ) {
			return;
		}

		add_filter( "envato_active_oauth_title_{$this->ultimate_addon_id}", array(
			&$this,
			'the7_ultimate_addon_oauth_title',
		), 30, 2 );
		add_filter( "agency_updater_request_support", array(
			&$this,
			'the7_ultimate_addon_agency_updater_request_support',
		), 30 );

		if (! defined( 'BSF_UNREG_MENU')) define( 'BSF_UNREG_MENU', true);

		if (defined ('ULTIMATE_THEME_ACT') || defined ('CONVERTPLUS_THEME_ACT') ) {
			add_action( 'admin_head', array( $this, 'admin_css' ), 100 );
		}



	}

	public function isActivatedByTheme() {
		$themeCode = get_site_option( 'the7_purchase_code', '' );
		$retval = false;
		if ( ! empty( $themeCode ) ) {
			$retval = $themeCode;
		}

		return $retval;
	}

	public static function the7_ultimate_addon_oauth_title( $text ) {
		$text = '<span class="active">Active!</span>';

		return $text;
	}

	public static function the7_ultimate_addon_agency_updater_request_support( $url ) {
		$text = 'http://support.dream-theme.com';

		return $text;
	}

	public function admin_css() {
		?>
		<style type="text/css">
            <?php if (defined ('ULTIMATE_THEME_ACT')) : ?>
                #the-list > tr[data-slug=the7-ultimate-addons-for-wpbakery-page-builder] .license {
                    display: none;
                }
            <?php endif ?>
            <?php if (defined ('CONVERTPLUS_THEME_ACT')) : ?>
                #the-list > tr[data-slug=the7-convert-plus] .license {
                    display: none;
                }
            <?php endif ?>
		</style>
		<?php
	}


}