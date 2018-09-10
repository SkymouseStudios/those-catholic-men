<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package tcm
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
?>

<div class="comments-area">
    <div class="add-comment">
<!--        --><?php //if (is_singular('videos') || is_singular('articles')) : ?>
            <h3>Start the discussion</h3>
<!--        --><?php //endif; ?>

        <?php
        $fields = array(
            'author' => '
            <div class="row">
                <div class="tab-6">
                    <div class="form-group">
                        <input id="author" class="form-control" name="author" type="text" value="" placeholder="Name"/>
                    </div>
                </div>',
            'email' => '
                <div class="tab-6">
                    <div class="form-group">
                        <input id="email" class="form-control" name="email" type="text" value="" placeholder="E-mail"/>
                    </div>
                </div>
            </div>'
        );

        $args = array(
            'comment_field' => '<div class="form-group">
            <textarea id="comment" name="comment" class="form-control" cols="45" rows="8" aria-required="true" placeholder="Leave a Message ..."></textarea>
            </div>'
        , 'fields' => apply_filters('comment_form_default_fields', $fields)
        , 'comment_notes_before' => ''
        , 'comment_notes_after' => ''
        , 'id_form' => ''
        , 'id_submit' => 'submit'
        , 'class_submit' => 'btn btn-blue'
        , 'title_reply' => ''
        , 'title_reply_to' => ''
        , 'cancel_reply_link' => __('Cancel reply')
        , 'label_submit' => __('COMMENT')
        , 'submit_field' => '<div class="btn_comment">%1$s %2$s</div>',
        );

        comment_form($args);
        ?>
    </div>

    <div class="view-comments">
        <ul class="commentlist">
            <?php
            $count = wp_count_comments(get_the_ID());
            if ($count->total_comments == 0) : ?>
                <li>No comments</li>
            <?php endif; ?>

            <?php wp_list_comments('type=comment&callback=mytheme_comment'); ?>
        </ul>
    </div>
</div>
