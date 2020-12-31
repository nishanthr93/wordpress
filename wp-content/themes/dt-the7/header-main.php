<?php
/**
 * Header template part with main container opener.
 *
 * @since   1.0.0
 *
 * @package The7\Templates
 */

defined( 'ABSPATH' ) || exit;
?>

<?php do_action( 'presscore_before_main_container' ); ?>

<?php if ( presscore_is_content_visible() ) : ?>
<!-- jQuery Modal -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div id="main" <?php presscore_main_container_classes(); ?>>

	<?php do_action( 'presscore_main_container_begin' ); ?>

	<div class="main-gradient"></div>
	<div class="wf-wrap">
	<div class="wf-container-main">

	<?php do_action( 'presscore_before_content' ); ?>

<?php endif ?>
