<?php
/**
 * tcm functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package tcm
 */

if (!function_exists('tcm_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function tcm_setup()
    {
        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'primary' => esc_html__('Primary Menu', 'tcm'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('tcm_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));
    }
endif; // tcm_setup
add_action('after_setup_theme', 'tcm_setup');

show_admin_bar(false);
function tcm_get_page_slug()
{
    $post_id = filter_input(INPUT_GET, 'post', FILTER_SANITIZE_NUMBER_INT, FILTER_NULL_ON_FAILURE);
    $post_id = isset($post_id) ? $post_id : filter_input(INPUT_POST, 'post_ID', FILTER_SANITIZE_NUMBER_INT);

    if (!isset($post_id)) {
        return;
    }

    $post_data = get_post($post_id, ARRAY_A);
    $slug = $post_data['post_name'];

    return $slug;
}

function get_page_ID_by_page_template($template_name)
{
    global $wpdb;
    $page_ID = $wpdb->get_var("SELECT post_id FROM $wpdb->postmeta WHERE meta_value = '$template_name' AND meta_key = '_wp_page_template'");
    return $page_ID;
}

function tcm_enqueue_styles()
{
    $slug = tcm_get_page_slug();
    wp_enqueue_style('tcm-style', get_stylesheet_uri());
    wp_enqueue_style("tcm-main-style", get_template_directory_uri() . '/dist/css/global.min.css');

    if (is_page_template('page-templates/contact-us.php')) {
        wp_enqueue_style('tcm-contact-us-style', get_template_directory_uri() . '/dist/css/contacts.min.css');

    } else if (is_search() || is_tag()) {
        wp_enqueue_style('tcm-search-style', get_template_directory_uri() . '/dist/css/results.min.css');

    } else if (is_author()) {
        wp_enqueue_style('tcm-single-authors-style', get_template_directory_uri() . '/dist/css/authors.min.css');

    } else if (is_single()) {
        wp_enqueue_style('tcm-single-style', get_template_directory_uri() . '/dist/css/article.min.css');

    } else if (is_archive()) {
        wp_enqueue_style('tcm-archive-style', get_template_directory_uri() . '/dist/css/articles.min.css');

    } else if (is_404()) {
        wp_enqueue_style('tcm-404-style', get_template_directory_uri() . '/dist/css/error-page.min.css');

    } else {
        wp_enqueue_style("tcm-{$slug}-style", get_template_directory_uri() . "/dist/css/{$slug}.min.css");
    }
}

add_action('wp_enqueue_scripts', 'tcm_enqueue_styles');

function tcm_enqueue_scripts()
{
    $slug = tcm_get_page_slug();

    wp_deregister_script('jquery');
    wp_register_script('jquery', ('//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js'), null, false);
    wp_enqueue_script('jquery');

    wp_enqueue_script("tcm-global-script", get_template_directory_uri() . '/dist/js/global.min.js', array('jquery'), null, true);
    //Ajax
    wp_localize_script("tcm-global-script", 'ajax_params', array('ajax_url' => admin_url('admin-ajax.php')));

    if (is_page_template('page-templates/donate.php') || is_page_template('page-templates/videos.php') ||
        is_page_template('page-templates/authors.php') || is_author() || is_single() || is_search() || is_tag() ||
        is_page_template('page-templates/contact-us.php')
    ) {
//        not js

    } else if (is_archive()) {
        wp_enqueue_script("tcm-archive-script", get_template_directory_uri() . "/dist/js/articles.min.js", array('jquery'), null, true);

    } else {
        wp_enqueue_script("tcm-{$slug}-script", get_template_directory_uri() . "/dist/js/{$slug}.min.js", array('jquery'), null, true);
    }

}

add_action('wp_enqueue_scripts', 'tcm_enqueue_scripts');

//Meta box
require_once 'page-meta/home.php';
require_once 'page-meta/exodus.php';
//require_once 'page-meta/events.php';
require_once 'page-meta/donate.php';

//Post types
require_once 'post-types/articles.php';
//require_once 'post-types/events.php';
require_once 'post-types/videos.php';

//Meta box for post types
//require_once 'post-types-meta/events.php';
require_once 'post-types-meta/videos.php';

require_once 'inc/social-links.php';
require_once 'inc/info-site.php';

/* hide WISYWIG editor for custom pages */
add_action('admin_init', 'hide_editor');
function hide_editor()
{
    if (isset($_GET['post'])) {
        $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'];
        if (!isset($post_id)) return;

        $post_data = get_post($post_id, ARRAY_A);
        $slug = $post_data['post_name'];

        if ($slug == 'home' || $slug == 'articles' || $slug == 'events' || $slug == 'donate' || $slug == 'contact-us' ||
            $slug == 'exodus' || $slug == 'videos' || $slug == 'authors'
        ) {
            remove_post_type_support('page', 'editor');
        }
    }
}

//Add logo wp-admin
function my_custom_login_logo()
{
    echo '<style type="text/css">
    h1 a { background-image:url(' . get_bloginfo('template_directory') . '/dist/images/logo-color.png) !important; height: 150px !important; width: 105px !important; background-size: 100% !important; margin-bottom: 0px !important; }
    </style>';
}

add_action('login_head', 'my_custom_login_logo');

function remove_menus()
{
    global $menu;

    $restricted = array(
        //__('Dashboard'),
        __('Posts'),
        //__('Media'),
        __('Links'),
        //  __('Pages'),
        //__('Appearance'),
        __('Tools'),
//        __('Users'),
        // __('Settings'),
//        __('Comments'),
//         __('Plugins')
    );
    end($menu);
    while (prev($menu)) {
        $value = explode(' ', $menu[key($menu)][0]);
        if (in_array(($value[0] != NULL ? $value[0] : ""), $restricted)) {
            unset($menu[key($menu)]);
        }
    }
}

add_action('admin_menu', 'remove_menus');

function do_excerpt($string, $limit)
{
    $string = strip_tags($string);
    $count = strlen($string);
    $string = substr($string, 0, $limit);

    if ($count > $limit) {
        $string .= '...';
    }
    echo $string;
}

// disable updates
add_filter('pre_site_transient_update_plugins', '__return_null');
remove_action('load-update-core.php', 'wp_update_plugins');
add_action('after_setup_theme', 'remove_core_updates');
function remove_core_updates()
{
    if (!current_user_can('update_core')) {
        return;
    }
    add_action('init', create_function('$a', "remove_action( 'init', 'wp_version_check' );"), 2);
    add_filter('pre_option_update_core', '__return_null');
    add_filter('pre_site_transient_update_core', '__return_null');
}

//Set status for comment - open
function default_comments_on($data)
{
    if ($data['post_type'] == 'articles' || $data['post_type'] == 'events' || $data['post_type'] == 'videos') {
        $data['comment_status'] = 'open';
    }

    return $data;
}

add_filter('wp_insert_post_data', 'default_comments_on');

//Add avatar in comments form
//add_action('comment_form_logged_in_after', 'tcm_comment_form_avatar');
add_action('comment_form_before', 'tcm_comment_form_avatar');
function tcm_comment_form_avatar()
{
    ?>
    <div class="avatar">
        <?php
        $current_user = wp_get_current_user();
        if (($current_user instanceof WP_User)) {
            echo get_avatar($current_user->user_email, 32);
        }
        ?>
    </div>
<!--    <div class="form-group">-->
<?php
}

//Reserve sort comments for post
if (!function_exists('iweb_reverse_comments')) {
    function iweb_reverse_comments($comments)
    {
        return array_reverse($comments);
    }
}
add_filter('comments_array', 'iweb_reverse_comments');

function mytheme_comment($comment, $args, $depth)
{
    $GLOBALS['comment'] = $comment; ?>

    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
    <div id="comment-<?php comment_ID(); ?>" class="comment">
        <div class="avatar">
            <?php echo get_avatar($comment, $size = '32'); ?>
        </div>

        <?php if ($comment->comment_approved === '0') : ?>
            <span class="comment_approved">Your comment is awaiting review.</span>
        <?php endif; ?>

        <h4><?php echo get_comment_author_link() ?></h4>

        <div class="comment-text">
            <?php comment_text(); ?>
            <ul>
                <?php $linkReply = get_comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
                <?php if (!empty($linkReply)) : ?>
                    <li><?php echo $linkReply; ?></li>
                <?php endif; ?>
                <?php like_counter_c('Like'); ?>
                <li><strong class="date"><?php echo get_comment_date('m-d-Y \a\t h:i a'); ?></strong></li>
            </ul>
        </div>
    </div>
<?php
}

function theme_queue_js()
{
    if (!is_admin()) {
        if (!is_page() AND is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
            wp_enqueue_script('comment-reply');
        }
    }
}

add_action('get_header', 'theme_queue_js');

function post_type_tags($post_type = '')
{
    global $wpdb;

    if (empty($post_type)) {
        $post_type = get_post_type();
    }

    return $wpdb->get_results($wpdb->prepare("
        SELECT COUNT( DISTINCT tr.object_id )
            AS count, tt.taxonomy, tt.description, tt.term_taxonomy_id, t.name, t.slug, t.term_id
        FROM {$wpdb->posts} p
        INNER JOIN {$wpdb->term_relationships} tr
            ON p.ID=tr.object_id
        INNER JOIN {$wpdb->term_taxonomy} tt
            ON tt.term_taxonomy_id=tr.term_taxonomy_id
        INNER JOIN {$wpdb->terms} t
            ON t.term_id=tt.term_taxonomy_id
        WHERE p.post_type=%s
            AND tt.taxonomy='post_tag'
        GROUP BY tt.term_taxonomy_id
        ORDER BY t.name
    ", $post_type));
}

function my_custom_post_type_archive_where($where, $args)
{
    $post_type = isset($args['post_type']) ? $args['post_type'] : 'post';
    $year = isset($args['year']) ? $args['year'] : '';

    $where = "WHERE post_type = '$post_type' AND post_status = 'publish' ";
    $where .= $year ? " AND YEAR(post_date) = '$year' " : '';

    return $where;
}

add_filter('getarchives_where', 'my_custom_post_type_archive_where', 10, 2);

//Add articles and events custom post types to the query for archive pages
add_action('pre_get_posts', 'add_my_post_types_to_query');
function add_my_post_types_to_query($query)
{
    if (is_archive() && $query->is_main_query())
        $query->set('post_type', array('post', 'articles', 'events'));
    return $query;
}

/*AJAX load list months for year*/
add_action('wp_ajax_getListMonths', 'ajax_getListMonths');
add_action('wp_ajax_nopriv_getListMonths', 'ajax_getListMonths');

function ajax_getListMonths()
{
    $year = filter_input(INPUT_GET, 'year', FILTER_SANITIZE_STRING);

//    print_r($year);

    echo '<option value="months">' . esc_attr(__('Select Month')) . '</otion>';
    wp_get_archives(array('post_type' => 'articles', 'type' => 'monthly', 'format' => 'option', 'limit' => 12, 'year' => $year));

    die();
}

//Delete year for month link
function hh_strip_year($link)
{
    $link = preg_replace('!([a-zA-Z]+)\s[0-9]{4}\s?</option!', '$1</option', $link);
    return $link;
}

add_filter('get_archives_link', 'hh_strip_year');

function my_search_form()
{
    $form = '<form role="search" method="get" action="' . home_url('/') . '">
                <div class="form-group">
                    <input type="text"  name="s" value="' . get_search_query() . '" class="form-control line" placeholder="Enter your search">
                    <span class="btn-trigger">search</span>
                    <input class="btn-submit" type="submit" value="search"/>
                </div>
            </form>';

    return $form;
}

add_filter('get_search_form', 'my_search_form');

class tcm_walker_nav_menu extends Walker_Nav_Menu
{

// add classes to ul sub-menus
    function start_lvl(&$output, $depth = 0, $args = array())
    {
        // depth dependent classes
        $indent = ($depth > 0 ? str_repeat("\t", $depth) : ''); // code indent
        $display_depth = ($depth + 1); // because it counts the first submenu as 0
        $classes = array(
            'sub-menu',
            ($display_depth % 2 ? 'menu-odd' : 'menu-even'),
            ($display_depth >= 2 ? 'sub-sub-menu' : ''),
            'menu-depth-' . $display_depth
        );
        $class_names = implode(' ', $classes);


        // build html
        $output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
    }

// add main/sub classes to li's and links
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        global $wp_query;
        $indent = ($depth > 0 ? str_repeat("\t", $depth) : ''); // code indent

        // depth dependent classes
        $depth_classes = array(
            ($depth == 0 ? 'main-menu-item' : 'sub-menu-item'),
            ($depth >= 2 ? 'sub-sub-menu-item' : ''),
            ($depth % 2 ? 'menu-item-odd' : 'menu-item-even'),
            'menu-item-depth-' . $depth
        );
        $depth_class_names = esc_attr(implode(' ', $depth_classes));

        // passed classes
        $classes = empty($item->classes) ? array() : (array)$item->classes;

        //Add current item class for templates
        if (is_singular('articles')) {
            if ($item->object_id == 8) {
                $classes[] = 'current-menu-item';
            }
        } else if (is_singular('events')) {
            if ($item->object_id == 10) {
                $classes[] = 'current-menu-item';
            }
        } else if (is_singular('videos')) {
            if ($item->object_id == 12) {
                $classes[] = 'current-menu-item';
            }
        }

        $class_names = esc_attr(implode(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item)));

        // build html
        $output .= $indent . '<li id="nav-menu-item-' . $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . '">';

        // link attributes
        $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
        $attributes .= ' class="menu-link ' . ($depth > 0 ? 'sub-menu-link' : 'main-menu-link') . '"';

        $item_output = sprintf('%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
            $args->before,
            $attributes,
            $args->link_before,
            apply_filters('the_title', $item->title, $item->ID),
            $args->link_after,
            $args->after
        );

        // build html
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}

//Convert time youtube video
function covtime($youtube_time)
{
    $start = new DateTime('@0'); // Unix epoch
    $start->add(new DateInterval($youtube_time));
    return $start->format('H:i:s');
}

function get_youtube_info($g_key, $id, $case)
{
    $youtube_video_info = file_get_contents('https://www.googleapis.com/youtube/v3/videos?part=snippet%2C+statistics%2C+contentDetails&id=' . $id . '&key=' . $g_key);
    $youtube_video_info = json_decode($youtube_video_info);

    $infoVideo = '';

    foreach ($youtube_video_info->items as $item) {

        if ($case == 1) {
            $infoVideo = $item->snippet->publishedAt;
        } else if ($case == 2) {
            $infoVideo = $item->contentDetails->duration;
        } else if ($case == 3) {
            $infoVideo = $item->snippet->thumbnails->high->url;
        } else {
            $infoVideo = $item->statistics->viewCount;
        }

    }

    return $infoVideo;
}

//Hunam format time for youtube video
define("SECOND", 1);
define("MINUTE", 60 * SECOND);
define("HOUR", 60 * MINUTE);
define("DAY", 24 * HOUR);
define("MONTH", 30 * DAY);
function relativeTime($time)
{
    $time = new DateTime($time);
    $time = date_format($time, 'd-m-Y');
    $time = strtotime($time);

    $delta = time() - $time;

    if ($delta < 1 * MINUTE) {
        return $delta == 1 ? "one second ago" : $delta . " seconds ago";
    }
    if ($delta < 2 * MINUTE) {
        return "a minute ago";
    }
    if ($delta < 45 * MINUTE) {
        return floor($delta / MINUTE) . " minutes ago";
    }
    if ($delta < 90 * MINUTE) {
        return "an hour ago";
    }
    if ($delta < 24 * HOUR) {
        return floor($delta / HOUR) . " hours ago";
    }
    if ($delta < 48 * HOUR) {
        return "yesterday";
    }
    if ($delta < 30 * DAY) {
        return floor($delta / DAY) . " days ago";
    }
    if ($delta < 12 * MONTH) {
        $months = floor($delta / DAY / 30);
        return $months <= 1 ? "one month ago" : $months . " months ago";
    } else {
        $years = floor($delta / DAY / 365);
        return $years <= 1 ? "one year ago" : $years . " years ago";
    }
}


//---------------------AJAX------------------------
add_action('wp_ajax_getEvents', 'ajax_getEvents');
add_action('wp_ajax_nopriv_getEvents', 'ajax_getEvents');

//Construct Loop & Results
function ajax_getEvents()
{
    $data = filter_input(INPUT_GET, 'data', FILTER_SANITIZE_STRING, FILTER_REQUIRE_ARRAY);

    global $wpdb;

    $state = $data['0']['value'];
    $year = $data['1']['value'];

    $month = $data['2']['value'];
    $day = $data['3']['value'];

    $time = $data['5']['value'];
    $time_arr = explode(':', $time);
    $hour = $time_arr[0];
    $minute = $time_arr[1];

    $type = $data['4']['value'];

    $location = $data['6']['value'];
    $author = $data['7']['value'];

    if ($state !== 'state') {
        $str_from1 = ', wp_postmeta AS meta1';
        $str_where1 = 'AND posts.ID=meta1.post_id';
        $str_state = '( meta1.meta_key = "event_state" AND meta1.meta_value = "' . $state . '" ) AND';
    }
    if ($year !== '0') {
        $str_from2 = ', wp_postmeta AS meta2';
        $str_where2 = 'AND posts.ID=meta2.post_id';
        $str_year = '( meta2.meta_key = "event_date" AND DATE_FORMAT(meta2.meta_value, "%Y" ) = "' . $year . '" ) AND';
    }
    if ($month !== '0') {
        $str_from3 = ', wp_postmeta AS meta3';
        $str_where3 = 'AND posts.ID=meta3.post_id';
        $str_month = '( meta3.meta_key = "event_date" AND DATE_FORMAT(meta3.meta_value, "%m" ) = "' . $month . '" ) AND';
    }
    if ($day !== '0') {
        $str_from4 = ', wp_postmeta AS meta4';
        $str_where4 = 'AND posts.ID=meta4.post_id';
        $str_day = '( meta4.meta_key = "event_date" AND DATE_FORMAT(meta4.meta_value, "%d" ) = "' . $day . '" ) AND';
    }
    if ($time !== '0') {
        $str_from5 = ', wp_postmeta AS meta5';
        $str_where5 = 'AND posts.ID=meta5.post_id';
        $str_hour = '( meta5.meta_key = "event_date" AND DATE_FORMAT(meta5.meta_value, "%H" ) = "' . $hour . '" ) AND';
    }
    if ($time !== '0') {
        $str_from6 = ', wp_postmeta AS meta6';
        $str_where6 = 'AND posts.ID=meta6.post_id';
        $str_minute = '( meta6.meta_key = "event_date" AND DATE_FORMAT(meta6.meta_value, "%i" ) = "' . $minute . '" ) AND';
    }
    if ($location !== '') {
        $str_from7 = ', wp_postmeta AS meta7';
        $str_where7 = 'AND posts.ID=meta7.post_id';
        $str_locacation = '( meta7.meta_key = "event_location" AND LOWER(meta7.meta_value) LIKE "%' . strtolower($location) . '%" ) AND';
    }
    if ($author !== '') {
        $str_from8 = ', wp_postmeta AS meta8';
        $str_where8 = 'AND posts.ID=meta8.post_id';
        $str_author = '( meta8.meta_key = "event_author" AND LOWER(meta8.meta_value) LIKE "%' . strtolower($author) . '%" ) AND';
    }
    if ($type !== '0') {
        $str_from9 = ', wp_term_relationships AS wp_term';
        $str_where9 = 'AND posts.ID=wp_term.object_id';
        $str_type = '( wp_term.term_taxonomy_id IN (' . $type . ')) AND';
    }

    $sql_non_exclusive = 'SELECT posts.* FROM wp_posts AS posts' . $str_from1 . ' ' . $str_from2 . ' ' . $str_from3 . ' ' . $str_from4 . ' ' . $str_from5 . '
' . $str_from6 . ' ' . $str_from7 . ' ' . $str_from8 . ' ' . $str_from9 . '
    WHERE (1=1) ' . $str_where1 . ' ' . $str_where2 . ' ' . $str_where3 . ' ' . $str_where4 . ' ' . $str_where5 . '
    ' . $str_where6 . ' ' . $str_where7 . ' ' . $str_where8 . ' ' . $str_where9 . '
    AND posts.post_type = "events"
    AND ' . $str_state . ' ' . $str_year . ' ' . $str_month . ' ' . $str_day . ' ' . $str_hour . ' ' . $str_minute . '
    ' . $str_locacation . ' ' . $str_author . ' ' . $str_type . ' (1=1)
    AND (posts.post_status = "publish" OR posts.post_status = "future")
    GROUP BY posts.ID
    ORDER BY posts.post_date DESC';

//    echo $sql_non_exclusive;

    $arr_id = array();
    $arrState = array(); //array of states

    $events_search_non_exclusive = $wpdb->get_results($sql_non_exclusive);

    if (count($events_search_non_exclusive) > 0) {

        foreach ($events_search_non_exclusive as $res) {
            $arr_id[] = $res->ID;

            if ($state != 'state') {
                $arrState[0] = rwmb_meta('event_state', null, $res->ID);
            } else {
                $st = rwmb_meta('event_state', null, $res->ID);
                if ($st != "") {
                    $arrState[] = rwmb_meta('event_state', null, $res->ID);
                }
            }
        }

    } else {
        if ($state != 'state') {
            $arrState[0] = $state;
        } else {
            $arrState[] = 'null';
        }
    }
    ?>

    <div class="content-holder">

        <?php
        if (empty($arr_id)) {
            echo '<div class="no-result">No result<div>';
//        $arrState[] = 'null';

        } else {
        $events = new WP_Query(array('post_type' => 'events', 'post__in' => $arr_id, 'orderby' => 'meta_value', 'meta_key' => 'event_date', 'posts_per_page' => 1));
        if ($events->have_posts()) : ?>

            <?php if ($events->max_num_pages > 1) : ?>
            <script>
                var max_pages = '<?php echo $events->max_num_pages; ?>';
                var true_posts = '<?php echo serialize($events->query_vars); ?>';
                var current_page = <?php echo (get_query_var('paged')) ? get_query_var('paged') : 1; ?>;
            </script>
        <?php endif; ?>

        <?php while ($events->have_posts()) :
        $events->the_post();
        $thumb_img = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
        $author_event = rwmb_meta('event_author', null, get_the_ID());
        $state_event = rwmb_meta('event_state', null, get_the_ID());
        $city_event = rwmb_meta('event_city', null, get_the_ID());
        $zip_event = rwmb_meta('event_zip', null, get_the_ID());
        $location = rwmb_meta('event_location', null, get_the_ID());
        $date_event = rwmb_meta('event_date', null, get_the_ID());
        //    $date_event = get_the_date( 'd - M, Y - h:i A', get_the_ID() );
        ?>
            <div class="event">
                <div class="event-img" style="background-image: url(<?php echo $thumb_img; ?>);"></div>
                <div class="event-content">
                    <div class="event-text">
                        <h2><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>

                        <p><?php do_excerpt(get_the_content(), 270); ?></p>
                    </div>
                    <div class="event-bottom">
                        <address class="location">
                            <?php echo $location; ?>
                            <p>
                                <?php if (!empty($city_event)) :
                                    echo $city_event . ', ';
                                endif;
                                if (!empty($state_event)) :
                                    echo $state_event . ', ';
                                endif;
                                echo $zip_event; ?>
                            </p>
                        </address>
                        <strong class="date"><?php echo date('d - M, Y - h:i A', strtotime($date_event)); ?></strong>
                        <?php if (!empty($author_event)) : ?>
                            <strong class="author"><?php echo $author_event; ?></strong>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php
        endwhile; ?>

        <?php
        endif;
        wp_reset_postdata();
        ?>

    </div><!--    End div.content-holder-->

<?php if ($events->max_num_pages > 1) { ?>
    <div class="alm-btn-wrap">
        <button class="alm-load-more-btn load-more-btn">Older Posts</button>
    </div>
<?php } else { ?>
    <div class="alm-btn-wrap">
        <button class="alm-load-more-btn" style="opacity: 0;">Older Posts</button>
    </div>
<?php }
}
?>

    <script> var arrState = <?php echo json_encode($arrState); ?>; </script>
    <script> var counter = <?php echo count(array_unique($arrState)); ?>; </script>

    <?php
    die();
}

/*AJAX load post*/
add_action('wp_ajax_load_posts', 'load_posts');
add_action('wp_ajax_nopriv_load_posts', 'load_posts');

function load_posts()
{
    $args = unserialize(stripslashes($_POST['query']));
    $args['paged'] = $_POST['page'] + 1;
    $args['post_status'] = array('publish', 'future');
    $q = new WP_Query($args);

    if ($q->have_posts()):
        while ($q->have_posts()): $q->the_post();

            $thumb_img = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
            $author_event = rwmb_meta('event_author', null, get_the_ID());
            $state_event = rwmb_meta('event_state', null, get_the_ID());
            $city_event = rwmb_meta('event_city', null, get_the_ID());
            $zip_event = rwmb_meta('event_zip', null, get_the_ID());
            $location = rwmb_meta('event_location', null, get_the_ID());
            $date_event = rwmb_meta('event_date', null, get_the_ID());
            ?>

            <div class="event">
                <div class="event-img" style="background-image: url(<?php echo $thumb_img; ?>);"></div>
                <div class="event-content">
                    <div class="event-text">
                        <h2><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>

                        <p><?php do_excerpt(get_the_content(), 270); ?></p>
                    </div>
                    <div class="event-bottom">
                        <address class="location">
                            <?php echo $location; ?>
                            <p>
                                <?php if (!empty($city_event)) :
                                    echo $city_event . ', ';
                                endif;
                                if (!empty($state_event)) :
                                    echo $state_event . ', ';
                                endif;
                                echo $zip_event; ?>
                            </p>
                        </address>
                        <strong class="date"><?php echo date('d - M, Y - h:i A', strtotime($date_event)); ?></strong>
                        <?php if (!empty($author_event)) : ?>
                            <strong class="author"><?php echo $author_event; ?></strong>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        <?php
        endwhile;
    endif;
    wp_reset_postdata();
    die();
}

function myfeed_request($qv)
{
    if (isset($qv['feed']) && !isset($qv['post_type']))
        $qv['post_type'] = array('articles');
    return $qv;
}

add_filter('request', 'myfeed_request');


//Hide fields - User Profile
function hide_personal_options()
{
    echo "\n" . '<script type="text/javascript">jQuery(document).ready(function($) { $(\'form#your-profile > h3:first\').hide(); $(\'form#your-profile > table:first\').hide(); $(\'form#your-profile\').show(); });</script>' . "\n";
}

add_action('admin_head', 'hide_personal_options');

//Add custom fields to User Profile
add_action('show_user_profile', 'my_show_extra_profile_fields');
add_action('edit_user_profile', 'my_show_extra_profile_fields');

function my_show_extra_profile_fields($user)
{ ?>
    <h3>Extra profile information</h3>
    <table class="form-table">
        <tr>
            <th><label for="facebook">Facebook</label></th>
            <td>
                <input type="text" name="facebook" id="facebook"
                       value="<?php echo esc_attr(get_the_author_meta('facebook', $user->ID)); ?>"
                       class="regular-text"/><br/>
                <span class="description">Please enter your facebook.</span>
            </td>
        </tr>
        <tr>
            <th><label for="twitter">Twitter</label></th>
            <td>
                <input type="text" name="twitter" id="twitter"
                       value="<?php echo esc_attr(get_the_author_meta('twitter', $user->ID)); ?>" class="regular-text"/><br/>
                <span class="description">Please enter your twitter.</span>
            </td>
        </tr>
        <tr>
            <th><label for="position">Position</label></th>
            <td>
                <input type="text" name="position" id="position"
                       value="<?php echo esc_attr(get_the_author_meta('position', $user->ID)); ?>"
                       class="regular-text"/><br/>
                <span class="description">Please enter your position.</span>
            </td>
        </tr>
    </table>
<?php }

add_action('personal_options_update', 'my_save_extra_profile_fields');
add_action('edit_user_profile_update', 'my_save_extra_profile_fields');

function my_save_extra_profile_fields($user_id)
{

    if (!current_user_can('edit_user', $user_id))
        return false;

    update_usermeta($user_id, 'facebook', $_POST['facebook']);
    update_usermeta($user_id, 'twitter', $_POST['twitter']);
    update_usermeta($user_id, 'position', $_POST['position']);
}

//Get avatar url
function tcm_get_avatar_url($get_avatar)
{
    preg_match('/src="(.*?)"/i', $get_avatar, $matches);
    return $matches[1];
}

add_action('init', 'tcm_start_session', 1);
function tcm_start_session()
{
    if (!session_id()) {
        session_start();
    }

    if (!isset($_SESSION['do_not_duplicate_ajax_posts'])) {
        $_SESSION['do_not_duplicate_ajax_posts'] = array();
    }
}

/*AJAX load post articles*/
add_action('wp_ajax_load_posts_articles', 'load_posts_articles');
add_action('wp_ajax_nopriv_load_posts_articles', 'load_posts_articles');


function load_posts_articles()
{
    $do_not_duplicate = array();

    if (isset($_SESSION['do_not_duplicate_ajax_posts'])) {
        $do_not_duplicate = $_SESSION['do_not_duplicate_ajax_posts'];
    }

    $args = unserialize(stripslashes($_POST['query']));
    $args['post__not_in'] = $do_not_duplicate;

    query_posts($args);
    if (have_posts()):
        while (have_posts()): the_post();
            $thumb_img = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
            $author_article = get_the_author();
            $do_not_duplicate[] = get_the_ID();
            ?>
            <article class="post">
                <img src="<?php echo $thumb_img; ?>" alt="<?php echo get_the_title(); ?>" class="article-img"/>

                <div class="post-content">
                    <h2><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>

                    <div class="post-text">
                        <p><?php do_excerpt(get_the_content(), 350); ?></p>
                    </div>
                    <strong class="signature">
                        <?php if (!empty($author_article)) : ?>By <?php echo $author_article; ?> - <?php endif; ?>
                        <span class="date"><?php the_time('m d Y') ?></span>
                    </strong>
                </div>
            </article>
        <?php
        endwhile;
    endif;
    wp_reset_postdata();

    $_SESSION['do_not_duplicate_ajax_posts'] = $do_not_duplicate;
    die();
}

function searchContent($s, $post_type)
{
    global $wpdb;

    $sql_non_exclusive = 'SELECT DISTINCT SQL_CALC_FOUND_ROWS wp_posts.ID FROM wp_posts
				INNER JOIN wp_users ON (wp_posts.post_author = wp_users.ID )
				WHERE wp_posts.post_type = "' . $post_type . '" AND wp_posts.post_status = "publish"
				AND ((wp_posts.post_title LIKE "%' . $s . '%") OR (wp_posts.post_content LIKE "%' . $s . '%") OR (wp_users.display_name LIKE "%' . $s . '%")

			) GROUP BY wp_posts.ID';
    $news_search_non_exclusive = $wpdb->get_results($sql_non_exclusive);

    return $news_search_non_exclusive;
}

function remove_cssjs_ver( $src ) {
    if( strpos( $src, '?ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}
add_filter( 'style_loader_src', 'remove_cssjs_ver', 10, 2 );
add_filter( 'script_loader_src', 'remove_cssjs_ver', 10, 2 );


function posts_for_current_author($query) {
    global $current_user;

    if(!in_array('administrator', $current_user->roles) && $query->is_admin) {

        global $user_ID;
        $query->set('author',  $user_ID);
    }
    return $query;
}
add_filter('pre_get_posts', 'posts_for_current_author');