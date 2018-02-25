<?php
/*
  Template Name: Home
*/
get_header(); ?>

    <div class="info-section">
        <header class="header-home clearfix" id="header">
            <?php get_template_part('parts/section', 'header'); ?>
        </header>

        <div class="cell">
            <div class="container">
                <strong class="logo-big">
                    <a href="<?php get_permalink(get_page_by_path('home')); ?>">TCM Those Catholic Men by Catholic Men . For Catholic Men</a>
                </strong>
            </div>
        </div>
    </div><!--/info-section-->

    <?php
    $articles = new WP_Query(array('post_type' => 'articles', 'orderby' => 'date', 'order' => 'DESC', 'posts_per_page' => 1));
    while ($articles->have_posts()) : $articles->the_post();

        $thumb_img = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
        $author = get_the_author();
        ?>
        <div class="info-section post-intro" style="background-image: url(<?php echo $thumb_img; ?>)">
            <div class="cell">
                <div class="container">
                    <div class="intro-holder">
                        <span class="date"><?php the_time('m d Y') ?></span>
                        <h1><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h1>
                        <?php if (!empty($author)) : ?>
                            <strong class="name">By <?php echo $author; ?></strong>
                        <?php endif; ?>
                        <p><?php do_excerpt(get_the_content(), 350); ?></p>
                        <a href="<?php echo get_the_permalink(); ?>" class="btn">read more</a>
                    </div>
                </div>
            </div>
        </div><!--/info-section-->
    <?php
    endwhile;
    wp_reset_postdata();
    ?>



    <?php
    $bg_last_articles = rwmb_meta('home_bg_last_articles', null, get_the_ID());
    if ($bg_last_articles) {
        $thumb_bg_last_articles = wp_get_attachment_image_src($bg_last_articles, 'full');
    } ?>

    <div class="info-section">
<!--    style="background-image: url(--><?php //echo $thumb_bg_last_articles[0]; ?><!--)"-->
        <div class="cell">
            <div class="container">
<!--                <h1 class="lined">Latest Articles</h1>-->
                <!--Latest posts-->
                <div class="posts-wrap">
                    <div class="row">
                    <?php
                    $articles = new WP_Query(array('post_type' => 'articles', 'orderby' => 'date', 'order' => 'DESC', 'posts_per_page' => 3));
                    while ($articles->have_posts()) : $articles->the_post();

                        $thumb_img = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
                        $author = get_the_author();
                        ?>
                        <div class="lap-4">
                            <div class="post-preview">
                                <div class="post-bg" style="background-image: url(<?php echo $thumb_img; ?>);"></div>
                                <h3 class="lined"><?php the_title(); ?></h3>
                                <?php if (!empty($author)) : ?>
                                    <span>By <?php echo $author; ?></span>
                                <?php endif; ?>
                                <a href="<?php echo get_the_permalink(); ?>" class="btn">read more</a>
                            </div>
                        </div>
                    <?php
                    endwhile;
                    wp_reset_postdata();
                    ?>
                    </div>
                </div>
                <a href="<?php echo get_permalink(get_page_by_path('articles')); ?>" class="btn">View more</a>
            </div>
        </div>
    </div><!--/info-section-->

    <?php //echo get_template_part('parts/section', 'events'); ?>

    <?php
    $bg_donate = rwmb_meta('home_bg_donate', null, get_the_ID());
    if ($bg_donate) {
        $thumb_bg_donate = wp_get_attachment_image_src($bg_donate, 'full');
    }

    $title_donate = rwmb_meta('home_title_donate', null, get_the_ID());
    $desc_donate = rwmb_meta('home_desc_donate', null, get_the_ID());
    ?>

    <div class="info-section donate-intro" style="background-image: url(<?php echo $thumb_bg_donate[0]; ?>)">
        <div class="cell">
            <div class="container">
                <div class="intro-holder">
                    <h1 class="lined"><?php echo $title_donate; ?></h1>
                    <?php echo $desc_donate; ?>
                    
                </div>
            </div>
        </div>
    </div><!--/info-section-->

    <?php
    $bg_updates = rwmb_meta('home_bg_updates', null, get_the_ID());
    if ($bg_updates) {
        $thumb_bg_updates = wp_get_attachment_image_src($bg_updates, 'full');
    }
    ?>
    <div class="info-section social-intro" style="background-image: url(<?php echo $thumb_bg_updates[0]; ?>)">
        <div class="cell">
            <div class="container">
                <div class="intro-holder">
                    <h1 class="lined">Follow Those Catholic Men!</h1>
                    <div class="clearfix">
                        <div class="social-plugin">

<!--                        Facebook widget-->
                            <div id="fb-root"></div>
                            <script defer="defer">(function(d, s, id) {
                              var js, fjs = d.getElementsByTagName(s)[0];
                              if (d.getElementById(id)) return;
                              js = d.createElement(s); js.id = id;
                              js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4";
                              fjs.parentNode.insertBefore(js, fjs);
                            }(document, 'script', 'facebook-jssdk'));</script>

                            <?php
                            $info = get_option('info_site_name');
                            echo $info['facebook'];
                            ?>
<!--                        Facebook widget-->

                        </div>
                        <div class="holder">

                            <div class="cols border">
                                
                                <div id="home-contact">
                                    <div class="user-form">
                                        <div id="promo"></div>
                                    </div>
                                    <div class="user-form">
                                        <h3 style="margin-top: 10px;">Become one of <br>Those Catholic Men</h3>
                                         <?php echo do_shortcode('[mc4wp_form id="1878"]'); ?>
                                    </div>
                                    </div>  
                                </div>
                            

                                <?php
                                //Social links
                                $social = get_option('social_option_name');

                                $fb = $social['facebook'];
                                $tw = $social['twitter'];
                                $youtube = $social['youtube'];
                                $rss = $social['rss'];
                                ?>

                            <div class="social-panel">
                                <h3>Follow us on Social Media:</h3>
                                <ul class="social-links">
                                    <li><a href="<?php echo $tw; ?>" class="icon-twitter-bird" target="_blank"></a></li>
                                    <li><a href="<?php echo $fb; ?>" class="icon-facebook" target="_blank"></a></li>
                                    <li><a href="<?php echo $youtube; ?>" class="icon-youtube-play" target="_blank"></a></li>
                                    <li><a href="<?php echo $rss; ?>" class="icon-rss" target="_blank"></a></li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/info-section-->
</div><!--/page-->
</div>

<div class="popups">
<!--Create Event Popup-->
    <?php
    $get_id = get_page_ID_by_page_template('page-templates/eventspage.php');
    $create_post = get_post_meta($get_id, 'events_create_event', TRUE);
    ?>
    <div id="create-event" class="popup">
        <div class="popup-title">
            <h2>Create Event</h2>
            <a href="javascript:jQuery.fancybox.close();" class="popup-close">Close</a>
        </div>
        <div class="clearfix">
            <div class="popup-form">
                <form method="post" name="form_create_event" id="form_create_event" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="event-title">Title of event*</label>
                        <input type="text" name="title" id="event-title" class="form-control" required="true"/>
                    </div>
                    <div class="form-group" id="date-holder">
						<label for="date">Date of event</label>
						<input type="text" id="date" name="date" class="form-control"/>
						<input type="text" id="date-output" name="date-output" hidden class="form-control"/>
					</div>
					<div class="form-group" id="time-holder">
						<label for="time">Time of event</label>
						<select id="time" name="time" >
                            <option value="0"> </option>
                            <option value="00:00">00:00</option>
                            <option value="00:30">00:30</option>
                            <option value="01:00">01:00</option>
                            <option value="01:30">01:30</option>
                            <option value="02:00">02:00</option>
                            <option value="02:30">02:30</option>
                            <option value="03:00">03:00</option>
                            <option value="03:30">03:30</option>
                            <option value="04:00">04:00</option>
                            <option value="04:30">04:30</option>
                            <option value="05:00">05:00</option>
                            <option value="05:30">05:30</option>
                            <option value="06:00">06:00</option>
                            <option value="06:30">06:30</option>
                            <option value="07:00">07:00</option>
                            <option value="07:30">07:30</option>
                            <option value="08:00">08:00</option>
                            <option value="08:30">08:30</option>
                            <option value="09:00">09:00</option>
                            <option value="09:30">09:30</option>
                            <option value="10:00">10:00</option>
                            <option value="10:30">10:30</option>
                            <option value="11:00">11:00</option>
                            <option value="11:30">11:30</option>
                            <option value="12:00">12:00</option>
                            <option value="12:30">12:30</option>
                            <option value="13:00">13:00</option>
                            <option value="13:30">13:30</option>
                            <option value="14:00">14:00</option>
                            <option value="14:30">14:30</option>
                            <option value="15:00">15:00</option>
                            <option value="15:30">15:30</option>
                            <option value="16:00">16:00</option>
                            <option value="16:30">16:30</option>
                            <option value="17:00">17:00</option>
                            <option value="17:30">17:30</option>
                            <option value="18:00">18:00</option>
                            <option value="18:30">18:30</option>
                            <option value="19:00">19:00</option>
                            <option value="19:30">19:30</option>
                            <option value="20:00">20:00</option>
                            <option value="20:30">20:30</option>
                            <option value="21:00">21:00</option>
                            <option value="21:30">21:30</option>
                            <option value="22:00">22:00</option>
                            <option value="22:30">22:30</option>
                            <option value="23:00">23:00</option>
                            <option value="23:30">23:30</option>
                        </select>
					</div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" name="address" id="address" class="form-control"/>
                    </div>

                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" name="city" id="city" class="form-control"/>
                    </div>

                    <div class="form-group">
                        <label for="state">State</label>
                        <select name="state" class="filter-sel" id="state">
                            <option value="state"> </option>
                            <option value="AL">Alabama</option>
                            <option value="AK">Alaska</option>
                            <option value="AZ">Arizona</option>
                            <option value="AR">Arkansas</option>
                            <option value="CA">California</option>
                            <option value="CO">Colorado</option>
                            <option value="CT">Connecticut</option>
                            <option value="DE">Delaware</option>
                            <option value="FL">Florida</option>
                            <option value="GA">Georgia</option>
                            <option value="HI">Hawaii</option>
                            <option value="ID">Idaho</option>
                            <option value="IL">Illinois</option>
                            <option value="IN">Indiana</option>
                            <option value="IA">Iowa</option>
                            <option value="KS">Kansas</option>
                            <option value="KY">Kentucky</option>
                            <option value="LA">Louisiana</option>
                            <option value="ME">Maine</option>
                            <option value="MD">Maryland</option>
                            <option value="MA">Massachusetts</option>
                            <option value="MI">Michigan</option>
                            <option value="MN">Minnesota</option>
                            <option value="MS">Mississippi</option>
                            <option value="MO">Missouri</option>
                            <option value="MT">Montana</option>
                            <option value="NE">Nebraska</option>
                            <option value="NV">Nevada</option>
                            <option value="NH">New Hampshire</option>
                            <option value="NJ">New Jersey</option>
                            <option value="NM">New Mexico</option>
                            <option value="NY">New York</option>
                            <option value="NC">North Carolina</option>
                            <option value="ND">North Dakota</option>
                            <option value="OH">Ohio</option>
                            <option value="OK">Oklahoma</option>
                            <option value="OR">Oregon</option>
                            <option value="PA">Pennsylvania</option>
                            <option value="RI">Rhode Island</option>
                            <option value="SC">South Carolina</option>
                            <option value="SD">South Dakota</option>
                            <option value="TN">Tennessee</option>
                            <option value="TX">Texas</option>
                            <option value="UT">Utah</option>
                            <option value="VT">Vermont</option>
                            <option value="VA">Virginia</option>
                            <option value="WA">Washington</option>
                            <option value="WV">West Virginia</option>
                            <option value="WI">Wisconsin</option>
                            <option value="WY">Wyoming</option>
                            <option value="DC">District of Columbia</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="zip-code">Zip Code</label>
                        <input type="text" name="zip" id="zip-code" class="form-control"/>
                    </div>

                    <div class="form-group">
                        <label for="type">Type</label>
                        <select id="type" name="type" class="filter-sel">
                            <option value="0"> </option>
                            <?php
                            $taxonomy_name = 'types';
                            $taxonomies = get_terms($taxonomy_name, 'orderby=id&order=ASC&hide_empty=0&parent=0');
                            if ($taxonomies) : ?>
                                <?php foreach ($taxonomies as $tax) : ?>
                                    <option value="<?php echo $tax->name; ?>"><?php echo $tax->name; ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="organizer">Organizer</label>
                        <input type="text" name="organizer" id="organizer" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="email">Email*</label>
                        <input type="email" name="email" id="email" class="form-control" required="true"/>
                    </div>
                    <div class="form-group">
                        <input type="file" id="upload" name="upload" multiple/>
                        <a href="javascript:void(0)" id="upload_link">Upload photo</a>
                        <button type="submit" class="btn btn-blue">Create</button>
                        <span class="info-load">The size of uploaded images not more than 1MB</span>
                    </div>
                </form>
            </div>
            <div class="popup-content">
                <?php echo $create_post; ?>
            </div>
        </div>
    </div>
<!--Create Event Popup-->


    <?php
    $bg_subscribe = rwmb_meta('home_bg_subscribe', null, get_the_ID());
    if ($bg_subscribe) {
        $thumb_bg_subscribe = wp_get_attachment_image_src($bg_subscribe, 'full');
    }

    $bg_schedule = rwmb_meta('home_bg_schedule', null, get_the_ID());
    if ($bg_schedule) {
        $thumb_bg_schedule = wp_get_attachment_image_src($bg_schedule, 'full');
    }
    ?>

    <!--Subscribe Message Popup-->
    <div id="subscribe-msg" class="popup popup-msg">
        <img class="img-msg" src="<?php echo $thumb_bg_subscribe[0]; ?>" alt=""/>
        <a href="javascript:jQuery.fancybox.close();" class="popup-close">Close</a>
    </div>

    <!--Receive Message Popup-->
    <div id="receive-msg" class="popup popup-msg">
        <img class="img-msg" src="<?php echo $thumb_bg_schedule[0]; ?>" alt=""/>
        <a href="javascript:jQuery.fancybox.close();" class="popup-close">Close</a>
    </div>

    <!--Subscribe Message Popup-->
    <div id="thanks" class="popup popup-msg">
        <h2>Thank you for sharing your event information with us. We will check all provided information and post it on thosecatholicmen.com shortly.</h2>
        <a href="javascript:jQuery.fancybox.close();" class="popup-close">Close</a>
    </div>
</div>

<script>
    var info = {
        dataArr: [

            <?php
            $events = new WP_Query(array('post_type' => 'events', 'post_status' => 'publish, future', 'orderby' => 'meta_value', 'meta_key' => 'event_date', 'order' => 'DESC', 'posts_per_page' => -1));
            while ($events->have_posts()) : $events->the_post();

                $location = rwmb_meta('event_location', null, get_the_ID());
                $location = strip_tags($location);
                $location = preg_replace("/(\\s+?|\r?\n)/", ' ', $location);

                $date_event = rwmb_meta('event_date', null, get_the_ID());

                $day = date('d', strtotime($date_event));
                $month = date('n', strtotime($date_event));
                $year = date('Y', strtotime($date_event));
                ?>

                {
                    date: new Date(<?php echo $year; ?>, <?php echo $month; ?>, <?php echo $day; ?>),
                    title: '<?php echo get_the_title(); ?>',
                    place: '<?php echo $location; ?>',
                    url: '<?php echo get_the_permalink(); ?>'
                },

            <?php
            endwhile;
            wp_reset_postdata();
            ?>
        ]
    };
</script>

<script>var url_create = "<?php echo get_template_directory_uri(); ?>/create-event.php"</script>

<?php get_footer(); ?>