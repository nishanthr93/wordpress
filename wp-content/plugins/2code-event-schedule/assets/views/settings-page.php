<?php
/**
 * Created by PhpStorm.
 * User: Shadov
 * Date: 2016-02-03
 * Time: 10:56
 */
?>

<div class="wrap">
    <h2>Event-schedule plugin settings</h2>
    <form action="options.php" method="POST">
        <?php settings_fields('2code-event-schedule'); ?>
        <?php do_settings_sections('2code-event-schedule'); ?>
        <?php submit_button(); ?>
    </form>
</div>
