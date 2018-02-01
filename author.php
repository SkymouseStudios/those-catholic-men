<?php
/**
 * The template for displaying all single authors.
 *
 * @package tcm
 */
get_header(); ?>

        <header class="header clearfix" id="header">
            <?php get_template_part('parts/section', 'header'); ?>
        </header>

        <div class="container">
				<h1>Our Authors</h1>

				<?php
                $author = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
                $author_info = get_userdata($author->ID);
                ?>

				<div id="content">
					<div class="content-holder">
						<div class="author-single-post">
							<a href="<?php echo get_permalink(get_page_by_path('authors')); ?>" class="back">Back to all authors</a>

							<div class="author-portrait">
                                <div class="portrait-preview"
                                     style="background-image: url(<?php echo tcm_get_avatar_url(get_avatar( $author->ID, 150 )); ?>);"></div>
								<ul class="social-links">
									<?php if(get_the_author_meta( 'facebook', $author->ID )):?>
										<li><a href="<?php the_author_meta( 'facebook', $author->ID ); ?>" class="icon-facebook"></a></li>
									<?php endif;?>
									<?php if(get_the_author_meta( 'twitter', $author->ID )):?>
										<li><a href="<?php the_author_meta( 'twitter', $author->ID ); ?>" class="icon-twitter-bird"></a></li>
									<?php endif;?>
								</ul>
							</div>
							<div class="author-description">
								<h3><?php echo $author_info->first_name; ?> <?php echo $author_info->last_name; ?> <span class="position"><?php the_author_meta( 'position', $author->ID ); ?></span></h3>

								<?php echo get_the_author_meta( 'description', $author->ID ); ?>

								<h4>Author's Articles</h4>
                                <ul class="author-articles">
                                    <?php
                                    $current_user_posts = get_posts( array(
                                        'post_type'       => 'articles',
                                        'author'        =>  $author->ID,
                                        'orderby'       =>  'post_date',
                                        'order'         =>  'DESC',
                                        'posts_per_page' => -1
                                    ) );

                                    if ( !empty($current_user_posts)  ) :

                                        foreach($current_user_posts as $post) : setup_postdata($post); ?>
                                            <li>
                                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                <span class="date"><?php the_time('m d Y') ?></span>
                                            </li>
                                        <?php
                                            endforeach;
                                            wp_reset_postdata();
                                        ?>

                                    <?php else : ?>

                                        <li>No articles</li>

                                    <?php endif; ?>

								</ul>

								<h4>Author's Videos</h4>
                                <ul class="author-articles">
                                    <?php
                                    $current_user_videos = get_posts( array(
                                        'post_type'       => 'videos',
                                        'author'        =>  $author->ID,
                                        'orderby'       =>  'post_date',
                                        'order'         =>  'DESC',
                                        'posts_per_page' => -1
                                    ) );

                                    if ( !empty($current_user_videos)  ) :

                                        foreach($current_user_videos as $post) : setup_postdata($post); ?>
                                            <li>
                                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                <span class="date"><?php the_time('m d Y') ?></span>
                                            </li>
                                        <?php
                                        endforeach;
                                        wp_reset_postdata();
                                        ?>

                                    <?php else : ?>

                                        <li>No videos</li>

                                    <?php endif; ?>

								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>



    </div><!--/page-->
</div>

<?php get_footer(); ?>