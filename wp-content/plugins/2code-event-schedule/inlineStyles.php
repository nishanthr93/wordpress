<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 28.01.16
 * Time: 00:00
 */

$color = tces_get_option('2code_color', '#fc4000');
$eventBorder = tces_get_option('2code_event_separator', 'none');

$imgFormat = tces_get_option('2code_image_format', 'circle');
$dateHidden = tces_get_option('2code_date_hidden', 'false');

?>
<style>
    .tcode-filters-content,
    .tcode-filters-wrapper {
        background-color: rgba(<?= apply_filters('2code-schedule-color-hexToRGB', $color) ?>,<?= apply_filters('2code-schedule-color-hexToRGB-opacity', '0.1') ?>);
    }

    .tcode-filters-type {
        color: <?= $color; ?>;
    }

    .tcode-filtered-term {
        background-color: <?= $color; ?>;
    }

    .tcode-event-schedule .slick-arrow,
    .tcode-event-schedule .slick-arrow:hover,
    .tcode-event-schedule .slick-arrow:focus,
    .tcode-event-schedule #days-carousel > button{
        background-color: rgba(<?= apply_filters('2code-schedule-color-hexToRGB', $color) ?>, .1);
    }

    .tcode-event-schedule .scheduled-days .scheduled-day.active:before {
        border-top-color: <?= $color; ?> !important;
    }

    .tcode-event-schedule .scheduled-days .scheduled-day {
        -webkit-transition: color 500ms ease, background 500ms ease;
        -moz-transition: color 500ms ease, background 500ms ease;
        -ms-transition: color 500ms ease, background 500ms ease;
        -o-transition: color 500ms ease, background 500ms ease;
        transition: color 500ms ease, background 500ms ease;
        background-color: rgba(<?= apply_filters('2code-schedule-color-hexToRGB', $color) ?>,<?= apply_filters('2code-schedule-color-hexToRGB-opacity', '0.1') ?>);
    }

    .tcode-event-schedule .scheduled-days .scheduled-day.active,
    .tcode-event-schedule .scheduled-days .scheduled-day:hover {
        background-color: <?= $color; ?>;
    }

    .tcode-event-schedule .scheduled-days .scheduled-day:hover {
        background-color: rgba(<?= apply_filters('2code-schedule-color-hexToRGB', $color) ?>, .5);
    }

    .tcode-event-schedule .scheduled-days .scheduled-day.active:hover {
        -moz-transition: color 0s, background 0s;
        -webkit-transition: color 0s, background 0s;
        -o-transition: color 0s, background 0s;
        transition: color 0s, background 0s;
        background-color: <?= $color; ?>;
    }


    .tcode-event-schedule .scheduled-locations .scheduled-location {
        -webkit-box-shadow: inset 0 -1px 0 <?= $color; ?>;
        -moz-box-shadow: inset 0 -1px 0 <?= $color; ?>;
        box-shadow: inset 0 -1px 0 <?= $color; ?>;
        -webkit-animation: shadowFadeOut 300ms;
        -o-animation: shadowFadeOut 300ms;
        animation: shadowFadeOut 300ms;
    }

    .tcode-event-schedule .scheduled-locations .scheduled-location.active,
    .tcode-event-schedule .scheduled-locations .scheduled-location:hover {
        -webkit-box-shadow: inset 0 -6px 0 rgba(<?= apply_filters('2code-schedule-color-hexToRGB', $color); ?>, .5);
        -moz-box-shadow: inset 0 -6px 0 rgba(<?= apply_filters('2code-schedule-color-hexToRGB', $color); ?>, .5);
        box-shadow: inset 0 -6px 0 rgba(<?= apply_filters('2code-schedule-color-hexToRGB', $color); ?>, .5);
        -webkit-animation: shadowFadeIn 100ms;
        -o-animation: shadowFadeIn 100ms;
        animation: shadowFadeIn 100ms;
    }

    .tcode-event-schedule .scheduled-locations .scheduled-location.active {
        -webkit-box-shadow: inset 0 -6px 0 <?= $color; ?>;
        -moz-box-shadow: inset 0 -6px 0 <?= $color; ?>;
        box-shadow: inset 0 -6px 0 <?= $color; ?>;
    }

    @keyframes shadowFadeIn {
        0% { box-shadow: inset 0 -1px 0 <?= $color ?>; }
        50% { box-shadow: inset 0 -3px 0 rgba(<?= apply_filters('2code-schedule-color-hexToRGB', $color); ?>, .8); }
        100% { box-shadow: inset 0 -6px 0 rgba(<?= apply_filters('2code-schedule-color-hexToRGB', $color); ?>, .5); }
    }

    @keyframes shadowFadeOut {
        0% { box-shadow: inset 0 -6px 0 rgba(<?= apply_filters('2code-schedule-color-hexToRGB', $color); ?>, .5); }
        50% { box-shadow: inset 0 -3px 0 rgba(<?= apply_filters('2code-schedule-color-hexToRGB', $color); ?>, .8); }
        100% { box-shadow: inset 0 -1px 0 <?= $color ?>; }
    }

    .tcode-event-schedule .scheduled-event {
        border-bottom: <?= $eventBorder ?>;
        border-color: <?= $color ?>;
    }

    <?php if (in_array($imgFormat, array('circle', 'svg', 'bg'))): ?>
    .tcode-event-schedule .scheduled-event .imgContainer {
        height: 86px;
        width: 86px;
        line-height: 80px;
    }
    .tcode-event-schedule.tcode-size-small .scheduled-event .imgContainer {
        height: 71px;
        width: 71px;
        line-height: 65px;
    }

    .tcode-event-schedule .scheduled-event .imgContainer {
        overflow: hidden;
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        border-radius: 50%;
    }
    <?php endif; ?>
    <?php if ($imgFormat === 'rectangle'): ?>
    .tcode-event-schedule .scheduled-event .imgContainer img {
        max-width: 140px;
        max-height: 90px;
    }
    <?php endif; ?>
    <?php if ($imgFormat === 'svg'): ?>
    .tcode-event-schedule .scheduled-event .imgContainer img {
        max-width: none;
    }
    <?php endif; ?>

    .tcode-event-schedule svg path,
    .tcode-event-schedule svg circle {
        fill: <?= $color ?> !important;
    }

    .tcode-event-schedule .scheduled-event .svgContainer:hover {
        background-color: <?= $color ?>;
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        border-radius: 50%;
        -webkit-transition: background 500ms ease;
        -moz-transition: background 500ms ease;
        -ms-transition: background 500ms ease;
        -o-transition: background 500ms ease;
        transition: background 500ms ease;
    }

    .tcode-event-schedule .scheduled-event .svgContainer:hover svg path,
    .tcode-event-schedule .scheduled-event .svgContainer:hover svg circle {
        fill: #fff !important;
        -webkit-transition: fill 500ms ease;
        -moz-transition: fill 500ms ease;
        -ms-transition: fill 500ms ease;
        -o-transition: fill 500ms ease;
        transition: fill 500ms ease;
    }

    .tcode-event-schedule .scheduled-event .event-time {
        color: <?= $color; ?>;
    }

    .tcode-event-schedule .scheduled-event .event-icon {
        color: <?= $color; ?>;
    }

    <?php if (!get_field('2code_link_class', 'options')): ?>
    .tcode-event-schedule .scheduled-event .event-excerpt .event-content a {
        color: <?= $color; ?>;
    }
    <?php endif; ?>

    <?php if (in_array($imgFormat, array('circle', 'svg', 'bg'))): ?>
    .tcode-event-schedule .scheduled-event .artist-image,
    #tcode-popup-container .scheduled-event .artist-image {
        overflow: hidden;
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        border-radius: 50%;
        max-height: 90px;
        max-width: 90px;
    }

    #tcode-popup-container .scheduled-event .artist-image,
    #tcode-popup-container .scheduled-event .artist-image img {
        width: 120px;
        height: 120px;
        max-width: 120px;
        max-height: 120px;
    }
    <?php endif; ?>

    .tcode-social-icon:hover {
        background-color: <?= $color ?>;
        -webkit-transition: background 500ms ease;
        -moz-transition: background 500ms ease;
        -ms-transition: background 500ms ease;
        -o-transition: background 500ms ease;
        transition: background 500ms ease;
    }

    <?php if ($dateHidden): ?>
    .tcode-event-schedule .scheduled-days .scheduled-day .row-day {
        padding: 26px 0;
    }
    .tcode-event-schedule.tcode-size-small .scheduled-days .scheduled-day .row-day {
        padding: 18px 0;
    }
    <?php endif; ?>

    @media (min-width: 768px) {
    <?php if ($imgFormat === 'rectangle'): ?>
        .tcode-event-schedule .scheduled-event .imgContainer img {
            max-width: 90px;
            max-height: 58px;
        }
    <?php endif; ?>
    }

    @media (min-width: 992px) {
    <?php if ($imgFormat === 'rectangle'): ?>
        .tcode-event-schedule .scheduled-event .imgContainer img {
            max-width: 140px;
            max-height: 90px;
            width: 100%;
        }
    <?php endif; ?>
    }
</style>