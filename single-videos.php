<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package tcm
 */

get_header(); ?>

<header class="header clearfix" id="header">
    <?php get_template_part('parts/section', 'header'); ?>
</header>

<div class="container">
    <?php while (have_posts()) : the_post();

    $url = rwmb_meta('video_url', null, get_the_ID());

//    Info site
//    https://console.developers.google.com/project
//    https://developers.google.com/youtube/v3/docs/videos/list

    $info = get_option('info_site_name');
    $youtube_key = $info['youtube_key'];

    $id_video = explode('/', $url);
    $id_video = end($id_video);
    ?>

    <div class="post-heading clearfix">
        <div class="link-back">
            <a href="<?php echo get_permalink(get_page_by_path('videos')); ?>" title="Back to all videos"
               class="btn btn-big">Back to all videos</a>
        </div>

        <div class="post-title">
            <h1><?php echo get_the_title(); ?></h1>

            <div class="signature">
                <strong><?php echo get_youtube_info($youtube_key, $id_video, 99); ?> views</strong>
                <span class="date">
                    <?php echo relativeTime(get_youtube_info($youtube_key, $id_video, 1)); ?>
                </span>
            </div>
        </div>
    </div>

    <div class="row">
    <div class="tab-8">
        <div id="content">
            <div class="content-holder">
                <article class="post">
                    <div class="video-wrapper">
                        <iframe src="<?php echo $url; ?>" allowfullscreen></iframe>
                    </div>
                    <div class="post-content">
                        <?php
                            $author = get_the_author();
                            if ($author) :
                        ?>
                            <div class="post-author">
                                <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
                                    <div class="avatar"
                                         style="background-image: url(<?php echo tcm_get_avatar_url(get_avatar( get_the_author_meta('ID'), 150 )); ?>)"></div>
                                    <span class="author">By <?php echo $author; ?></span>
                                </a>
                            </div>
                        <?php endif; ?>
                        <div class="post-text">
                            <?php the_content(); ?>
                        </div>

                        <?php if (get_the_tag_list()) : ?>
                            <div class="post-tags">
                                <?php //echo get_the_tag_list(); ?>
                                <?php //echo strip_tags(get_the_tag_list('<span>',', ','</span>')); ?>
                                <?php $posttags = get_the_tags($post->ID);
                                if ($posttags) {
                                    foreach($posttags as $tag) {
                                        echo '<span>' .$tag->name. '</span>';
                                    }
                                }
                                ?>
                            </div>
                        <?php endif; ?>

                        <div class="post-share">
                            <span class="share-title">Share it:</span>
                            <ul class="social-links">
                                <li><span class="st_facebook_large icon-facebook" displayText="Facebook"></span></li>
                                <li><span class="st_twitter_large icon-twitter-bird" displayText="Tweet"></span></li>
                                <li><span class="st_googleplus_large icon-gplus" displayText="Google +"></span></li>
                                <li><span class='st_email_large icon-mail-alt' displayText='Email'></span></li>
                            </ul>
                        </div>

                        <?php
                        if (comments_open()) {
                            comments_template();
                        }
                        ?>
                    </div>
                </article>
            </div>
        </div>
    </div>

<?php endwhile; // End of the loop. ?>

    <div class="tab-4">
        <aside id="sidebar">
            <div class="social-plugin">
            <!--Facebook widget-->
                <div id="fb-root"></div>
                <script>(function(d, s, id) {
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
            <!--Facebook widget-->
            </div>

            <div class="popular-posts">
                <h3>Most Popular</h3>
                <ul>
                    <?php
                    $videos = new WP_Query(array('post_type' => 'videos', 'orderby' => 'comment_count', 'order' => 'DESC', 'posts_per_page' => 4));
                    while ($videos->have_posts()) : $videos->the_post();
                        ?>
                        <li>
                            <a href="<?php echo get_the_permalink(); ?>">
                                <p><?php do_excerpt(get_the_title(), 25); ?></p>
                                <span class="date"><?php the_time('m d Y') ?></span>
                            </a>
                        </li>
                    <?php
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </ul>
            </div>

        </aside>
    </div>

    </div>

</div>

</div><!--/page-->
</div>

<script type="text/javascript" src="https://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "69ca65be-f027-417b-b840-056839c5b999", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>

<?php get_footer(); ?>