<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 27.01.16
 * Time: 23:20
 */

global $post;

$dateCount = count($postArray);
$dateCols = apply_filters('2code-count-columns', $dateCount);

$maxSM = 3;
$maxXSDate = 4;
$maxXSLocation = 3;

$cnt = count($postArray);

$size = tces_get_option('2code_module_size', 'normal');
$socialPlacement = tces_get_option('2code_social_placement', 'both');
$dayTitle = tces_get_option('2code_day_title', 'title');
?>

<div class="container-fluid event-schedule tcode-event-schedule tcode-size-<?= $size ?>">

    <div id="tcode-popup-container" class="mfp-with-anim mfp-hide">
        <div class="scheduled-event"></div>
    </div>
    <div class="col-xs-12">
        <div class="row scheduled-days">
            <?php

            $mdColSize = $dateCols;

            $colSize = $mdColSize;
            $cols = 12/$mdColSize;

            ?>
            <div class="hidden-mobile" id="days-carousel">
                <?php for($i=0;$i<$dateCount;$i++): ?>
                    <?php

                    $current = $postArray[$i];
                    $day = $current['day'];

                    ?>
                    <?php $date = str_replace('/', '-', get_field('event_day_date', $day->ID)); ?>
                    <?php $d = new DateTime($date) ?>
                    <div class="slick-slide scheduled-day" data-date="<?= $d->format('Y-m-d') ?>">
                        <div class="row">
                            <div class="col-xs-12 row-day">
                                <?php if ($dayTitle === 'dayofweek'): ?>
                                    <span class="dayTitle"><?= $d->format('Y-m-d'); ?></span>
                                <?php else: ?>
                                    <span><?= get_the_title($day->ID); ?></span>
                                <?php endif; ?>
                            </div>
                            <?php if (!get_field('2code_date_hidden', 'options')): ?>
                                <div class="col-xs-12 row-date"><?= $d->format('Y-m-d'); ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endfor; ?>
            </div>

            <!-- Mobile theme -->
            <div class="hidden-desktop">
                <?php for($i=0;$i<$dateCount;$i++): ?>
                    <?php

                    $current = $postArray[$i];
                    $day = $current['day'];
                    $locationCount = count($current['locations']);

                    ?>
                    <?php $date = str_replace('/', '-', get_field('event_day_date', $day->ID)); ?>
                    <?php $d = new DateTime($date) ?>
                    <div>
                        <div class="days-mobile">
                            <div class="col-xs-12 col-sm-12 scheduled-day mobile <?= $i === 0 ? 'active' : '' ?>" data-date="<?= $d->format('Y-m-d') ?>">
                                <div class="row">
                                    <div class="col-xs-12 row-day">
                                        <?php if ($dayTitle === 'dayofweek'): ?>
                                            <span class="dayTitle mobile"><?= $d->format('Y-m-d'); ?></span>
                                        <?php else: ?>
                                            <span><?= get_the_title($day->ID); ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <?php if (!get_field('2code_date_hidden', 'options')): ?>
                                        <div class="col-xs-12 row-date"><?= $d->format('Y-m-d'); ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 scheduled-locations mobile locations-hidden" data-date="<?= $d->format('Y-m-d') ?>">
                            <?php for($j=0;$j<$locationCount;$j++): ?>
                                <?php $location = $current['locations'][$j] ?>
                                <div class="row scheduled-location <?= $j === 0 ? 'active' : '' ?>" data-location="<?= $location->slug ?>">
                                    <div class="col-xs-12"><?= $location->name ?></div>
                                </div>
                            <?php endfor; ?>
                        </div>
                        <div class="col-xs-12 scheduled-events hidden mobile">
                            <?php $k = 0; ?>
                            <?php foreach ($current['events'] as $event): ?>
                                <?php
                                $post = $event['event'];
                                setup_postdata($post);

                                $artists = get_field('event_artist');
                                $content = get_the_content();
                                $hideExcerpt = empty($content) && empty($artists) ? ' hideExcerpt' : '';

                                $time_starts = !strstr($event['time'], ':') ? $event['time'] . ':00' : $event['time'];
                                $time_end = !strstr($event['time_end'], ':') ? $event['time_end'] . ':00' : $event['time_end'];

                                $time_ends = $event['time_ends'];
                                $timeObj = new DateTime(str_replace(' ', '', $time_starts ));
                                $time = $timeObj->format('H:i');

                                if ($time_ends) {
                                    $time_end = new DateTime(str_replace(' ', '', $time_end));
                                    $time_end = $time_end->format('H:i');
                                } else {
                                    $time_end = '';
                                }

                                $bgColor = (($color = get_field('event_background_color', $post->ID)) !== false && !empty($color)) ? $color : '#fff';
                                $bgColor = 'background-color: ' . $bgColor . ';';

                                $primaryFontColor = (($fontColor = get_field('event_primary_font_color', $post->ID)) !== false) ? 'color: ' . $fontColor . ';' : false;
                                $secondaryFontColor = (($fontColor = get_field('event_secondary_font_color', $post->ID)) !== false) ? 'color: ' . $fontColor . ';' : false; ?>
                                <div style="<?= $bgColor; ?>" class="row scheduled-event event-collapsed event-hidden event-<?=$d->format('Ymd')?>-<?= $k ?><?= $hideExcerpt; ?>" data-event="event-<?=$d->format('Ymd')?>-<?= $k ?>" data-date="<?= $d->format('Y-m-d') ?>" data-location="<?= $event['location'] ?>">
                                    <div class="col-xs-12">
                                        <div class="row">
                                            <?php $class = !has_post_thumbnail($post->ID) || $imageFormat === 'none' ? 'hidden-xs' : ''; ?>
                                            <div class="col-sm-2 col-xs-12 vcenter <?= $class ?>">
                                                <?php if ($imageFormat !== 'none'): ?>
                                                    <div class="imgContainer center-block text-center">
                                                        <?php if (has_post_thumbnail($post->ID)): ?>
                                                            <?php $imgFormat = $imageFormat === 'circle' ? '2code-square-thumbnail' : '2code-rect-thumbnail'; ?>
                                                            <?php $url = get_the_post_thumbnail_url($post->ID, $imgFormat); ?>
                                                            <?php $class = stristr($url, '.svg') !== false ? 'svg' : ''; ?>
                                                            <img class="img-responsive center-block <?= $class ?>" alt="<?php echo get_the_title($post->ID); ?> image" src="<?= $url ?>" />
                                                        <?php endif; ?>
                                                    </div>
                                                <?php else: ?>
                                                    <?php if (get_field('event_hour_visible', $post->ID) == 1): ?>
                                                        <div class="event-time visible-sm" style="<?= $primaryFontColor; ?>">
                                                            <span class="time-starts"><?= $time ?></span>
                                                            <?php if ($time_ends): ?>
                                                                - <span class="time-ends"><?= $time_end ?></span>
                                                            <?php endif; ?>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </div><?php
                                            ?><div class="col-sm-9 col-xs-10 vcenter">
                                                <div class="row">
                                                    <?php if (get_field('event_hour_visible', $post->ID) == 1): ?>
                                                        <div class="col-xs-12 visible-xs event-time" style="<?= $primaryFontColor; ?>">
                                                            <span class="time-starts"><?= $time ?></span>
                                                            <?php if ($time_ends): ?>
                                                                - <span class="time-ends"><?= $time_end ?></span>
                                                            <?php endif; ?>
                                                        </div>
                                                    <?php endif; ?>
                                                    <div class="col-xs-12 event-title" style="<?= $primaryFontColor; ?>"><?= get_the_title($post->ID); ?></div>
                                                </div>
                                            </div><?php
                                            ?><div class="col-xs-2 col-sm-1 vcenter">
                                                <div class="event-icon pull-right">
                                                    <i class="tcode-ico-grot-down" data-state="collapsed" style="<?= $primaryFontColor; ?>"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row event-excerpt">
                                            <div class="col-xs-12">
                                                <?php if (get_the_content()): ?>
                                                    <div class="row event-content">
                                                        <div class="col-sm-10 col-sm-offset-2 col-xs-12" style="<?= $secondaryFontColor; ?>">
                                                            <?php the_content(); ?>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if ($artists = get_field('event_artist')): ?>
                                                    <?php foreach ($artists as $artist): ?>
                                                        <div class="row artist-row mobile" data-effect="mfp-zoom-in">
                                                            <div class="tcode-artist-popover hidden">
                                                                <div>
                                                                    <div class="row">
                                                                        <div class="col-xs-12 col-sm-4">
                                                                            <div class="artist-image center-block">
                                                                                <?php if (has_post_thumbnail($artist->ID)): ?>
                                                                                    <?php $url = get_the_post_thumbnail_url($artist->ID, '2code-square-thumbnail-large'); ?>
                                                                                    <img class="img-responsive center-block" alt="<?php echo get_the_title($post->ID); ?> image" src="<?= $url ?>" />
                                                                                <?php endif; ?>
                                                                            </div>
                                                                            <?php $media = get_field('social_icons', $artist->ID) ?>
                                                                            <?php if (!empty($media) && in_array($socialPlacement, array('both', 'popup'))): ?>
                                                                                <div class="row artist-media text-center">
                                                                                    <?php foreach ($media as $icon): ?>
                                                                                        <a href="<?= $icon['social_network_url'] ?>" target="_blank" class="tcode-social-icon tcode-ico-<?= $icon['icon_type'] ?>"></a>
                                                                                    <?php endforeach; ?>
                                                                                </div>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                        <div class="col-xs-12 col-sm-8 artist-details-container">
                                                                            <div class="tcode-es-artist-title">
                                                                                <a href="#">
                                                                                    <?= get_the_title($artist->ID) ?>
                                                                                </a>
                                                                            </div>
                                                                            <?php if ($position = get_field('artist_title', $artist->ID)): ?>
                                                                                <div class="artist-position">
                                                                                    <?= $position ?>
                                                                                </div>
                                                                            <?php endif; ?>
                                                                            <div class="artist-content">
                                                                                <?= apply_filters('the_content', $artist->post_content, true); ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-12 col-sm-10 col-sm-offset-2">
                                                                <div class="vcenter artist-image artist-single-row">
                                                                    <?php if (has_post_thumbnail($artist->ID)): ?>
                                                                        <?php $url = get_the_post_thumbnail_url($artist->ID, '2code-square-thumbnail'); ?>
                                                                        <img class="img-responsive" alt="<?php echo get_the_title($post->ID); ?> image" src="<?= $url ?>" />
                                                                    <?php endif; ?>
                                                                </div>
                                                                <div class="vcenter tcode-es-artist-title-container artist-single-row">
                                                                    <div class="tcode-es-artist-title" style="<?= $secondaryFontColor; ?>">
                                                                        <?= get_the_title($artist->ID) ?>
                                                                    </div>
                                                                    <?php if ($position = get_field('artist_title', $artist->ID)): ?>
                                                                        <div class="artist-position" style="<?= $secondaryFontColor; ?>">
                                                                            <?= $position ?>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <?php $media = get_field('social_icons', $artist->ID) ?>
                                                                <?php if (!empty($media) && in_array($socialPlacement, array('both', 'author'))): ?>
                                                                    <div class="vcenter artist-social artist-single-row">
                                                                        <?php foreach ($media as $icon): ?>
                                                                            <a href="<?= $icon['social_network_url'] ?>" target="_blank" class="tcode-social-icon tcode-ico-<?= $icon['icon_type'] ?>"></a>
                                                                        <?php endforeach; ?>
                                                                    </div>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php $k++; ?>
                            <?php endforeach; ?>

                            <?php wp_reset_postdata(); ?>
                        </div>
                    </div>
                <?php endfor; ?>
            </div>
            <!-- End Mobile theme -->
        </div>

        <!-- Desktop theme -->
        <div class="hidden-mobile">
            <?php

            foreach($postArray as $day):
                $locationCount = count($day['locations']);
                $locationCols = apply_filters('2code-count-columns', $locationCount);

                $date = str_replace('/', '-', get_field('event_day_date', $day['day']->ID));
                $date = new DateTime($date);

                $mdCols = $locationCols;
                $smCols = $locationCols < $maxSM  ? $maxSM : $locationCols;
                $xsCols = $locationCols < $maxXSLocation ? $maxXSLocation : $locationCols;

                ?>
                <div class="row scheduled-locations desktop locations-hidden" data-date="<?= $date->format('Y-m-d') ?>">
                    <?php for($i=0;$i<$locationCount;$i++): ?>
                        <?php $location = $day['locations'][$i] ?>
                        <div class="col-md-<?= $mdCols ?> col-sm-12 col-xs-12 scheduled-location <?= $i === 0 ? 'active' : '' ?>" data-location="<?= $location->slug ?>">
                            <div class="row">
                                <div class="col-xs-12"><?= $location->name ?></div>
                            </div>
                        </div>
                    <?php endfor; ?>
                </div>
            <?php endforeach; ?>

            <div class="scheduled-events desktop">
                <?php $i = 0; ?>
                <?php foreach($postArray as $day): ?>

                    <?php $date = str_replace('/', '-', get_field('event_day_date', $day['day']->ID)); ?>
                    <?php $date = new DateTime($date); ?>

                    <?php foreach ($day['events'] as $event): ?>
                        <?php

                        $post = $event['event'];
                        setup_postdata($post);

                        $time_starts = !strstr($event['time'], ':') ? $event['time'] . ':00' : $event['time'];
                        $time_end = !strstr($event['time_end'], ':') ? $event['time_end'] . ':00' : $event['time_end'];

                        $time_ends = $event['time_ends'];
                        $timeObj = new DateTime(str_replace(' ', '', $time_starts));
                        $time = $timeObj->format('H:i');

                        if ($time_ends) {
                            $time_end = new DateTime(str_replace(' ', '', $time_end));
                            $time_end = $time_end->format('H:i');
                        } else {
                            $time_end = '';
                        }

                        $artists = get_field('event_artist');
                        $content = get_the_content();
                        $hideExcerpt = empty($content) && empty($artists) ? ' hideExcerpt' : '';
                        $bgColor = (($color = get_field('event_background_color', $post->ID)) !== false && !empty($color)) ? $color : '#fff';
                        $bgColor = 'background-color: ' . $bgColor . ';';
                        $primaryFontColor = (($fontColor = get_field('event_primary_font_color', $post->ID)) !== false) ? 'color: ' . $fontColor . ';' : false;
                        $secondaryFontColor = (($fontColor = get_field('event_secondary_font_color', $post->ID)) !== false) ? 'color: ' . $fontColor . ';' : false;
                        ?>
                        <div style="<?= $bgColor ?>" class="row scheduled-event event-collapsed event-visible<?= $hideExcerpt; ?>" data-date="<?= $date->format('Y-m-d') ?>" data-location="<?= $event['location'] ?>">
                            <div class="col-md-12">
                                <div class="row">
                                    <?php $class = !has_post_thumbnail($post->ID) && $imageFormat !== 'none' ? 'hidden-xs' : ''; ?>
                                    <div class="col-md-2 vcenter <?= $class ?>">
                                        <?php if ($imageFormat !== 'none'): ?>
                                            <div class="imgContainer center-block text-center">
                                                <?php if (has_post_thumbnail($post->ID)): ?>
                                                    <?php $imgFormat = $imageFormat === 'circle' ? '2code-square-thumbnail' : '2code-rect-thumbnail'; ?>
                                                    <?php $url = get_the_post_thumbnail_url($post->ID, $imgFormat); ?>
                                                    <?php $class = stristr($url, '.svg') !== false ? 'svg' : ''; ?>
                                                    <img class="img-responsive center-block <?= $class ?>" alt="<?php echo get_the_title($post->ID); ?> image" src="<?= $url ?>" />
                                                <?php endif; ?>
                                            </div>
                                        <?php else: ?>
                                            <?php if (get_field('event_hour_visible', $post->ID) == 1): ?>
                                                <div class="event-time text-center" style="<?= $primaryFontColor; ?>">
                                                    <span class="time-starts"><?= $time ?></span>
                                                    <?php if ($time_ends): ?>
                                                        - <span class="time-ends"><?= $time_end ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div><div class="col-md-9 vcenter">
                                        <div class="row">
                                            <?php if ($imageFormat !== 'none'): ?>
                                                <?php if (get_field('event_hour_visible', $post->ID) == 1): ?>
                                                    <div class="col-md-12 event-time" style="<?= $primaryFontColor; ?>">
                                                        <span class="time-starts"><?= $time ?></span>
                                                        <?php if ($time_ends): ?>
                                                            - <span class="time-ends"><?= $time_end ?></span>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <div class="col-md-12 event-title" style="<?= $primaryFontColor; ?>"><?= get_the_title($post->ID); ?></div>
                                        </div>
                                    </div><div class="col-md-1 vcenter">
                                        <div class="event-icon pull-right">
                                            <i class="tcode-ico-grot-down" data-state="collapsed" style="<?= $primaryFontColor; ?>"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="row event-excerpt">
                                    <div class="col-md-12">
                                        <div class="row event-content">
                                            <div class="col-md-8 col-md-offset-2" style="<?= $secondaryFontColor; ?>">
                                                <?php the_content(); ?>
                                            </div>
                                        </div>
                                        <?php if ($artists): ?>
                                            <?php foreach ($artists as $artist): ?>
                                                <div class="row artist-row" data-effect="mfp-zoom-in">
                                                    <div class="tcode-artist-popover hidden">
                                                        <div>
                                                            <div class="row">
                                                                <div class="col-xs-12 col-sm-4">
                                                                    <div class="artist-image center-block">
                                                                        <?php if (has_post_thumbnail($artist->ID)): ?>
                                                                            <?php $url = get_the_post_thumbnail_url($artist->ID, '2code-square-thumbnail-large'); ?>
                                                                            <img class="img-responsive center-block" alt="<?php echo get_the_title($post->ID); ?> image" src="<?= $url ?>" />
                                                                        <?php endif; ?>
                                                                    </div>
                                                                    <?php $media = get_field('social_icons', $artist->ID) ?>
                                                                    <?php if (!empty($media) && in_array($socialPlacement, array('both', 'popup'))): ?>
                                                                        <div class="row artist-media text-center">
                                                                            <?php foreach ($media as $icon): ?>
                                                                                <a href="<?= $icon['social_network_url'] ?>" target="_blank" class="tcode-social-icon tcode-ico-<?= $icon['icon_type'] ?>"></a>
                                                                            <?php endforeach; ?>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <div class="col-xs-12 col-sm-8 artist-details-container">
                                                                    <div class="tcode-es-artist-title">
                                                                        <a href="#">
                                                                            <?= get_the_title($artist->ID) ?>
                                                                        </a>
                                                                    </div>
                                                                    <?php if ($position = get_field('artist_title', $artist->ID)): ?>
                                                                        <div class="artist-position">
                                                                            <?= $position ?>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                    <div class="artist-content">
                                                                        <?= apply_filters('the_content', $artist->post_content, true); ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-10 col-md-offset-2 tcode-es-artist-title-col vcenter">
                                                        <div class="vcenter artist-image">
                                                            <?php if (has_post_thumbnail($artist->ID)): ?>
                                                                <?php $url = get_the_post_thumbnail_url($artist->ID, '2code-square-thumbnail'); ?>
                                                                <img class="img-responsive" alt="<?php echo get_the_title($post->ID); ?> image" src="<?= $url ?>" />
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="vcenter tcode-es-artist-title-container">
                                                            <div class="tcode-es-artist-title" style="<?= $secondaryFontColor; ?>">
                                                                <?= get_the_title($artist->ID) ?>
                                                            </div>
                                                            <?php if ($position = get_field('artist_title', $artist->ID)): ?>
                                                                <div class="artist-position" style="<?= $secondaryFontColor; ?>">
                                                                    <?= $position ?>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                        <?php $media = get_field('social_icons', $artist->ID) ?>
                                                        <?php if (!empty($media) && in_array($socialPlacement, array('both', 'author'))): ?>
                                                            <div class="vcenter">
                                                                <?php foreach ($media as $icon): ?>
                                                                    <a href="<?= $icon['social_network_url'] ?>" target="_blank" class="tcode-social-icon tcode-ico-<?= $icon['icon_type'] ?>"></a>
                                                                <?php endforeach; ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                <?php endforeach; ?>

                <?php wp_reset_postdata(); ?>
                <div class="row no-events text-center">
                    <div class="col-xs-12">Select date to see events.</div>
                </div>
            </div>
        </div>
        <!-- End Desktop theme -->
    </div>
</div>

<?php $slides = $cnt < $daysNum ? $cnt : $daysNum; ?>

<script type="text/javascript">
    jQuery(document).ready(function($) {
        // Init schedule script
        $('.event-schedule').schedule({
            showLocations: <?= tces_get_option('2code_locations_mode', 'false') ?>,
            keepAccordionsOpen: <?= tces_get_option('2code_accordion_behavior', 'false') ?>,
            openFirstAccordion: <?= tces_get_option('2code_accordion_open_first', 'false') ?>
        });
        $('#days-carousel').tcodeslick({
            slidesToShow: <?= $slides ?>,
            slidesToScroll: <?= $slides ?>,
            infinite: false,
            prevArrow: '<a href="#" class="slick-prev"></a>',
            nextArrow: '<a href="#" class="slick-next"></a>',
            speed: 800,
            easing: 'swing'
        });
    });
</script>
