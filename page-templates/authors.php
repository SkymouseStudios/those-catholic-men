<?php
/*
  Template Name: Authors
*/
get_header(); ?>

        <header class="header clearfix" id="header">
            <?php get_template_part('parts/section', 'header'); ?>
        </header>

        <div class="container">
				<h1>Our Authors</h1>

				<div class="sort-by">
                    <span>Sort by:</span>
                    <a href="<?php echo get_permalink(get_page_by_path('articles')); ?>?order=date">Latest</a>
                    <a href="<?php echo get_permalink(get_page_by_path('articles')); ?>?order=comment_count">Popular</a>
                    <a href="<?php echo get_permalink(get_page_by_path('articles')); ?>?order=rand">Random</a>
                    <a href="<?php echo get_permalink(get_page_by_path('authors')); ?>">Author</a>
                    <a href="<?php echo get_permalink(get_page_by_path('articles')); ?>?order=topic">Topic</a>
                </div>

				<div id="content">
					<div class="content-holder">

                    <ul>
						<?php
                        $wp_user_query = new WP_User_Query( array( 'role' => 'Author' ) );

                        // Get the results
                        $authors = $wp_user_query->get_results();

                        // Check for results
                        if (!empty($authors)) :
                            // loop trough each author
                            foreach ($authors as $author) :
                                // get all the user's data
                                $author_info = get_userdata($author->ID);
                                ?>

                                <li class="author-preview">
                                    <div class="author-portrait">
                                        <div class="portrait-preview"
                                             style="background-image: url(<?php echo tcm_get_avatar_url(get_avatar( $author->ID, 150 )); ?>);"></div>
                                        <ul class="social-links">
                                            <li><a href="<?php the_author_meta( 'facebook', $author->ID ); ?>" class="icon-facebook"></a></li>
                                            <li><a href="<?php the_author_meta( 'twitter', $author->ID ); ?>" class="icon-twitter-bird"></a></li>
                                        </ul>
                                    </div>
                                    <div class="author-description">
                                        <h3>
                                            <a href="<?php echo home_url('author/'.$author->user_nicename); ?>"><?php echo $author_info->first_name; ?> <?php echo $author_info->last_name; ?></a>
                                            <span class="position"><?php the_author_meta( 'position', $author->ID ); ?></span>
                                        </h3>

                                        <p><?php do_excerpt($author_info->description, 700); ?></p>
                                    </div>
                                </li>

                            <?php
                            endforeach;
                        else : ?>
                            <li>No authors found</li>
                        <?php endif; ?>
                    </ul>

					</div>
				</div>
			</div>

    </div><!--/page-->
</div>

<?php get_footer(); ?>