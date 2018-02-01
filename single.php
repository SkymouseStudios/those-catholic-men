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

            $post_type = get_post_type(get_the_ID());

            $thumb_img = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
            if ($post_type == 'articles') :
                $author = get_the_author();
            else :
                $author = rwmb_meta('event_author', null, get_the_ID());
            endif;
            ?>

                <div class="post-heading clearfix">
                    <div class="link-back">
                        <a href="<?php echo get_permalink(get_page_by_path($post_type)); ?>"
                           title="Back to all <?php echo get_post_type(get_the_ID()); ?>" class="btn btn-big">Back to
                            all <?php echo get_post_type(get_the_ID()); ?></a>
                    </div>
                    <div class="post-title">
                        <h1><?php echo get_the_title(); ?></h1>
                        <div class="signature">
                            <span class="date"><?php trim(the_time('m d Y')); ?></span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="tab-8">
                        <div id="content">
                            <div class="content-holder">
                                <article class="post">
                                    <img src="<?php echo $thumb_img; ?>" alt="article-1" class="article-img"/>
                                    <div class="post-content">

                                        <?php if ($author) : ?>
                                            <div class="post-author">
                                                <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
                                                    <div class="avatar"
                                                         style="background-image: url(<?php echo tcm_get_avatar_url(get_avatar( get_the_author_meta('ID'), 150 )); ?>)"></div>
                                                    <span class="author">By <?php echo $author; ?></span>
                                                </a>
                                            </div>
                                        <?php endif; ?>

                                        <div class="post-text">
                                            <?php echo apply_filters( 'the_content', do_shortcode( get_the_content() ) );
                                            //do_shortcode(get_the_content()); ?>
                                        </div>

                                        <?php if (get_the_tag_list()) : ?>
                                            <div class="post-tags">
                                                <?php echo get_the_tag_list(); ?>
                                            </div>
                                        <?php endif; ?>
<div class="post-sign">
	<div class="holder">
                                        <strong class="signature">
	        <?php if (!$author) : ?>By <?php echo $author; ?> - <?php endif; ?>
	        <span class="date"><?php the_time('m d Y') ?></span>
	    </strong>

                                                <div class="post-link-back">
                                                    <a href="<?php echo get_permalink(get_page_by_path($post_type)); ?>"
                                                       title="Back to <?php echo get_post_type(get_the_ID()); ?>">Back to
                                                        all <?php echo get_post_type(get_the_ID()); ?></a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="post-share">
                                            <div class="print-title">
                                                <?php if(function_exists('wp_print')) { print_link(); } ?>
                                            </div>

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

                            <!--Tag cloud-->
<!--                            <div class="tag-cloud">-->
<!--                                <h3>Tags</h3>-->
<!--                                <div class="tags">-->
<!--                                    --><?php
//                                        $post_types_tags = post_type_tags( $post_type );
//                                        foreach( $post_types_tags as $tag ) {
//                                            echo '<a href="' . get_tag_link( $tag->term_id ). '">' . esc_html( $tag->name ) . '</a>';
//                                        }
//                                    ?>
<!--                                </div>-->
<!--                                <a href="#" class="more-tags">More tags</a>-->
<!--                            </div>-->

                        <?php get_template_part('parts/sidebar-content'); ?>


                        </aside>
                    </div>
                </div>

            <div class="latest-posts">
<!--                    <h2 class="lined">Random posts</h2>-->
                    <!--Latest posts-->
                    <div class="posts-wrap">
                        <div class="row">
                            <?php
                            $posts = new WP_Query(array('post_type' => $post_type, 'orderby' => 'rand', 'order' => 'DESC', 'posts_per_page' => 3, 'post__not_in' => array(get_the_ID())));
                            while ($posts->have_posts()) : $posts->the_post();

                                $thumb_img = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));

                                if ($post_type == 'articles') :
                                    $author = get_the_author();
                                else :
                                    $author = rwmb_meta('event_author', null, get_the_ID());
                                endif;

                                ?>
                                <div class="lap-4">
                                    <div class="post-preview">
                                        <div class="post-bg" style="background-image: url(<?php echo $thumb_img; ?>);"></div>
                                        <h3 class="lined"><?php echo get_the_title(); ?></h3>
                                        <?php if (!empty($author)) : ?>
                                            <span>By <?php echo $author; ?></span>
                                        <?php endif; ?>
                                        <a href="<?php echo get_the_permalink(); ?>" class="btn">Read more</a>
                                    </div>
                                </div>
                            <?php
                            endwhile;
                            wp_reset_postdata();
                            ?>
                        </div>
                    </div>
                    <a href="<?php echo get_permalink(get_page_by_path($post_type)) ?>" class="btn">View more</a>
                </div>
        </div>

    </div><!--/page-->
</div>

<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "69ca65be-f027-417b-b840-056839c5b999", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>

<?php get_footer(); ?>
