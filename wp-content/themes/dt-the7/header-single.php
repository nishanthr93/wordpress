<?php
/**
 * Template part with actual header.
 *
 * @since 1.0.0
 *
 * @package The7\Templates
 */

defined( 'ABSPATH' ) || exit;

?><!DOCTYPE html>
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?> class="no-js">
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<?php if ( presscore_responsive() ) : ?>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
	<script type="text/javascript" src="<?php echo get_site_url().'/wp-includes/js/jquery/floatinglabel.js'; ?>"></script>
	<?php endif ?>
	<?php presscore_theme_color_meta(); ?>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<?php
	presscore_js_resize_event_hack();
	wp_head();
	?>
<head>
<script type="text/javascript" >

   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};

   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})

   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");


   ym(69883840, "init", {

        clickmap:true,

        trackLinks:true,

        accurateTrackBounce:true,

        webvisor:true,

   });


  ym(69883840, 'setUserID', <?php echo get_current_user_id ();?>);


</script>

<noscript><div><img src="https://mc.yandex.ru/watch/69883840" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
</head>
<body <?php body_class(); ?>>
<?php
do_action( 'presscore_body_top' );

$config = presscore_config();

$page_class = '';
if ( 'boxed' === $config->get( 'template.layout' ) ) {
	$page_class = 'class="boxed"';
}
?>

<div id="page" <?php echo $page_class; ?>>
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'the7mk2' ); ?></a>
<?php
if ( apply_filters( 'presscore_show_header', true ) ) {
	presscore_get_template_part( 'theme', 'header/header', str_replace( '_', '-', $config->get( 'header.layout' ) ) );
	presscore_get_template_part( 'theme', 'header/mobile-header' );
}

if ( presscore_is_content_visible() && $config->get( 'template.footer.background.slideout_mode' ) ) {
	echo '<div class="page-inner">';
}
?>
