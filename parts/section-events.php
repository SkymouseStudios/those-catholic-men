<?php
$bg_events = rwmb_meta('home_bg_events', null, get_the_ID());
if ($bg_events) {
    $thumb_bg_events = wp_get_attachment_image_src($bg_events, 'full');
}



$events = new WP_Query(array('post_type' => 'events', 'post_status' => 'publish, future', 'orderby' => 'meta_value', 'meta_key' => 'event_date', 'order' => 'DESC', 'posts_per_page' => -1));
$countEvent = $events->post_count;
wp_reset_postdata();
?>

<div class="info-section events-intro" style="background-image: url(<?php echo $thumb_bg_events[0]; ?>)">
    <div class="cell">
        <div class="container">
            <div class="intro-holder">
                <h1 class="lined">Find a Catholic Men’s Group in Your Area</h1>

                <?php if ($countEvent >= 3) : ?>

                    <div class="row">
                        <div class="lap-4">
                            <div class="event-item">
                                <div class="wrap">
                                    <div class="date">
                                        <div class="box">
                                            <strong class="month"></strong>
                                            <span class="date-num"></span>
                                        </div>
                                    </div>
                                </div>
                                <h2><a href=""></a></h2>
                                <p class="place icon-location"><span></span></p>
                            </div>
                        </div>
                        <div class="lap-4">
                            <div class="event-item">
                                <div class="wrap">
                                    <div class="date">
                                        <div class="box">
                                            <strong class="month"></strong>
                                            <span class="date-num"></span>
                                        </div>
                                    </div>
                                </div>
                                <h2><a href=""></a></h2>
                                <p class="place icon-location"><span></span></p>
                            </div>
                        </div>
                        <div class="lap-4">
                            <div class="event-item">
                                <div class="wrap">
                                    <div class="date">
                                        <div class="box">
                                            <strong class="month"></strong>
                                            <span class="date-num"></span>
                                        </div>
                                    </div>
                                </div>
                                <h2><a href=""></a></h2>
                                <p class="place icon-location"><span></span></p>
                            </div>
                        </div>
                    </div>

                <?php endif; ?>

                <div class="buttons">
                    <a href="<?php echo get_permalink(get_page_by_path('events')); ?>" class="btn">view map</a>
<!--                    <a href="#create-event" class="btn btn-white popup-link">create event</a>-->
                </div>
            </div>
        </div>
    </div>
</div>