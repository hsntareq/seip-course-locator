<?php
function pdf_embeded($atts)
{
    $a = shortcode_atts(array(
        'url' => false
    ), $atts);
    return '<iframe src="' . $a['url'] . '" type="application/pdf" style="min-height: 800px" width="100%" height="100%"></iframe>';
}

add_shortcode('embeddoc', 'pdf_embeded');


function wpse_custom_menu_order($menu_ord)
{
    if (!$menu_ord) return true;

    return array(
        'index.php', // Dashboard
        'separator1', // First separator
        'upload.php', // Media
        'link-manager.php', // Links
        'edit-comments.php', // Comments
        'edit.php?post_type=page', // Pages
        'separator2', // Second separator
        'themes.php', // Appearance
        'plugins.php', // Plugins
        'users.php', // Users
        'tools.php', // Tools
        'options-general.php', // Settings
        'separator-last', // Last separator
        'admission-circular', // admission-circular
        'edit.php', // Posts
    );
}

add_filter('custom_menu_order', 'wpse_custom_menu_order', 10, 1);
add_filter('menu_order', 'wpse_custom_menu_order', 10, 1);


/*function customize_post_admin_menu_labels()
{
    global $menu;
    global $submenu;
    $menu[5][0] = 'News Highlights';
    $submenu['edit.php'][5][0] = 'News Highlights';
    $submenu['edit.php'][10][0] = 'Add News Highlights';
    echo '';
}

add_action('admin_menu', 'customize_post_admin_menu_labels');*/


if (!function_exists('post_pagination')) {
    function post_pagination()
    {
        global $wp_query;
        $big = 999999999; // need an unlikely integer

        $pages = paginate_links(array(
            'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
            'format' => '?paged=%#%',
            'current' => max(1, get_query_var('paged')),
            'total' => $wp_query->max_num_pages,
            'type' => 'array',
        ));
        if (is_array($pages)) {
            $paged = (get_query_var('paged') == 0) ? 1 : get_query_var('paged');
            echo '<div class="pagination-wrap"><ul class="pagination">';
            foreach ($pages as $page) {
                echo "<li>$page</li>";
            }
            echo '</ul></div>';
        }
    }
};

function get_download_image($id, $size = 'large')
{
    if (has_post_thumbnail($id)) {
        return get_the_post_thumbnail($id, $size);
    }

    if (!function_exists('edd_get_download_files')) {
        return '';
    }

    $files = edd_get_download_files($id);

    foreach ($files as $file) {
        if (empty($file['attachment_id'])) {
            continue;
        }

        $image = wp_get_attachment_image($file['attachment_id'], $size);

        if ($image) {
            return $image;
        }
    }
    wp_reset_postdata();
    return '';
}


add_action('wp_ajax_tranche_ajax_request', 'tranche_ajax_request');
add_action('wp_ajax_nopriv_tranche_ajax_request', 'tranche_ajax_request');

function tranche_ajax_enqueue()
{
    // Enqueue javascript on the frontend.
    wp_enqueue_script(
        'seip-ajax-script',
        get_stylesheet_directory_uri() . '/js/ajax_call.js',
        array('jquery')
    );
    // The wp_localize_script allows us to output the ajax_url path for our script to use.
    wp_localize_script('liker_script', 'myAjax', array('ajaxurl' => admin_url('admin-ajax.php')));

    wp_localize_script(
        'seip-ajax-script',
        'seip_ajax_obj',
        array(
            'ajax_tms_api' => get_stylesheet_directory_uri() . '/getAssociationSummary.php',
            'ajax_course_result' => get_stylesheet_directory_uri() . '/courseResult.php',
            'ajax_api' => get_stylesheet_directory_uri() . '/ajax_file.php',
            'theme_dir' => get_stylesheet_directory_uri(),
            'ajax_url' => 'https://tms.seip-fd.gov.bd/tmsApi/getAssociationSummary',
        )
    );
}

add_action('wp_enqueue_scripts', 'tranche_ajax_enqueue');


add_filter('use_block_editor_for_post', '__return_false');


add_action('wp', 'delete_expired_coupons_daily');
function delete_expired_coupons_daily()
{
    if (!wp_next_scheduled('delete_expired_coupons')) {
        wp_schedule_event(time(), 'daily', 'delete_expired_coupons');
    }
}

add_action('delete_expired_coupons', 'delete_expired_coupons_callback');


function home_url_func($atts)
{
    $var = shortcode_atts(array(
        'page' => 'notices',
    ), $atts);
    return get_post_type_archive_link($var['page']);
}

add_shortcode('get_url', 'home_url_func');

include_once(get_stylesheet_directory() . '/includes/advanced-custom-field.php');
//include_once(get_stylesheet_directory() . '/includes/breadcrumb.php');
include_once(get_stylesheet_directory() . '/includes/enqueue.php');
include_once(get_stylesheet_directory() . '/includes/includes.php');
include_once(get_stylesheet_directory() . '/includes/post-type.php');


register_nav_menus(array(
    'main_menu' => 'Main Menu',
    'footer_menu' => 'Footer Menu',
));
function get_nav_menu_items_by_location($location, $args = [])
{
    $locations = get_nav_menu_locations();
    $object = wp_get_nav_menu_object($locations[$location]);
    $menu_items = wp_get_nav_menu_items($object->name, $args);
//    pr($menu_items);
    echo '<ul class="mb-0">';
    foreach ($menu_items as $nav) {
        if (strpos($nav->url, '[get_url') !== false) {
            $permalink = do_shortcode($nav->url);
        } elseif (strpos($nav->url, "#") !== false) {
            $permalink = 'javascript:void(0)';
        } else {
            $permalink = $nav->url;
        }

        if ($nav->menu_item_parent == 0) {
            echo '<li><a href="' . $permalink . '">' . $nav->title . '</a> <i class="fa fa-caret-down"></i></li>';
        } else {
            echo '<li class="ml-4 toggle_nav"><a href="' . $permalink . '">' . $nav->title . '</a> <i class="fa fa-caret-down"></i></li>';
            if (in_array($nav->post_name, array('news-highlight', 'course-assessment-tools', 'tms-guideline-resources', 'seip-competency-standards', 'seip-competency-based-learning-materials', 'admission-circular', 'notices'), true)) {
                $custom_posts = get_posts(array('post_type' => $nav->post_name, 'showposts' => -1));
                if ($custom_posts) {
                    echo '<ul class="child-nav">';
                    foreach ($custom_posts as $custom_post) {
                        echo '<li class="ml-2"><a href="' . get_permalink($custom_post->ID) . '">' . $custom_post->post_title . '</a></li>';
                    }
                    echo '</ul>';
                }
            }
        }
    }
    echo '</ul>';
}
