<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package tcm
 */

get_header(); ?>

<?php global $wp_query; ?>

        <header class="header clearfix" id="header">
            <?php get_template_part('parts/section', 'header'); ?>
        </header>

        <div class="container archive-page">
            <div class="post-title">
                <?php
                the_archive_title('<h1>', '</h1>');
                ?>
            </div>
            <div class="row">
                <div class="lap-8 tab-8">
                    <div id="content">
                        <?php echo do_shortcode('[ajax_load_more post_type="articles" year="' . $wp_query->query['year'] . '" month="' . $wp_query->query['monthnum'] . '" orderby="ID" posts_per_page="2" scroll_distance="50" max_pages="0"]'); ?>
                    </div>
                </div>

                <div class="lap-4 tab-4">
                    <aside id="sidebar">

                        <div class="archive">
                            <h3>Archive</h3>
                            <div class="form-group">
                                <select id="select_year">
                                    <option value="years"><?php echo esc_attr(__('Select Year')); ?></option>
                                    <?php wp_get_archives(array('post_type' => 'articles', 'type' => 'yearly', 'format' => 'option')); ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <select id="select_month">
                                    <option value="months"><?php echo esc_attr(__('Select Month')); ?></option>
                                </select>
                            </div>
                            <button class="btn">View</button>
                        </div>

                    </aside>
                </div>
            </div>
        </div>
    </div><!--/page-->
</div>

<?php get_footer(); ?>