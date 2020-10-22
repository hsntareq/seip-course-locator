<?php


function create_post_type()
{
  register_post_type('guideline',
    array(
      'labels' => array(
        'name' => __('Guidelines'),
        'singular_name' => __('Guideline')
      ),
      'public' => true,
      'has_archive' => true,
      'query_var' => true,
      'menu_icon' => 'dashicons-clipboard',
      'supports' => array('thumbnail', 'title', 'editor', 'page-attributes'),
    )
  );
  register_post_type('competency-learning',
    array(
      'labels' => array(
        'name' => __('Competency based Learning Materials'),
        'singular_name' => __('Competency Learning')
      ),
      'public' => true,
      'has_archive' => true,
      'query_var' => true,
      'menu_icon' => 'dashicons-clipboard',
      'supports' => array('thumbnail', 'title', 'editor'),
    )
  );
  register_post_type('competency',
    array(
      'labels' => array(
        'name' => __('Competency Standards'),
        'singular_name' => __('Competency')
      ),
      'public' => true,
      'has_archive' => true,
      'query_var' => true,
      'menu_icon' => 'dashicons-thumbs-up',
      'supports' => array('thumbnail', 'title', 'editor'),
    )
  );
  register_post_type('gallery',
    array(
      'labels' => array(
        'name' => __('Galleries'),
        'singular_name' => __('Gallery')
      ),
      'public' => true,
      'has_archive' => true,
      'query_var' => true,
      'menu_icon' => 'dashicons-images-alt2',
      'supports' => array('thumbnail', 'title', 'editor', 'page-attributes'),
    )
  );
  register_post_type('e-news',
    array(
      'labels' => array(
        'name' => __('E-News Clipping'),
        'singular_name' => __('E-News')
      ),
      'public' => true,
      'has_archive' => true,
      'query_var' => true,
      'menu_icon' => 'dashicons-welcome-widgets-menus',
      'supports' => array('thumbnail', 'title', 'editor', 'page-attributes'),
    )
  );
  register_post_type('stuffs',
    array(
      'labels' => array(
        'name' => __('Our staffs'),
        'singular_name' => __('Our staff')
      ),
      'public' => true,
      'has_archive' => true,
      'query_var' => true,
      'menu_icon' => 'dashicons-groups',
      'supports' => array('thumbnail', 'title', 'editor', 'page-attributes'),
    )
  );
  register_post_type('admission-circular',
    array(
      'labels' => array(
        'name' => __('Admission Circular'),
        'singular_name' => __('Circular')
      ),
      'public' => true,
      'has_archive' => true,
      'query_var' => true,
      'menu_icon' => 'dashicons-index-card',
      'supports' => array('thumbnail', 'title', 'editor')
    )
  );
  register_post_type('notices',
    array(
      'labels' => array(
        'name' => __('Notices'),
        'singular_name' => __('Notice')
      ),
      'public' => true,
      'has_archive' => true,
      'menu_icon' => 'dashicons-megaphone',
      'supports' => array('thumbnail', 'title', 'editor')
    )
  );
}

add_action('init', 'create_post_type');


/*taxonomies*/

$tax_dept = array(
  'hierarchical' => true,
  'labels' => array(
    'name' => _x("Circular Category", 'taxonomy general name', 'textdomain'),
    'singular_name' => _x('Circular Category', 'taxonomy singular name', 'textdomain'),
    'search_items' => __('Search Circular Categories', 'textdomain'),
    'all_items' => __('All Circular Categories', 'textdomain'),
    'parent_item' => __('Parent Circular Category', 'textdomain'),
    'parent_item_colon' => __('Parent Circular Category:', 'textdomain'),
    'edit_item' => __('Edit Circular Category', 'textdomain'),
    'update_item' => __('Update Circular Category', 'textdomain'),
    'add_new_item' => __('Add New Circular Category', 'textdomain'),
    'new_item_name' => __('New Circular Category Name', 'textdomain'),
    'menu_name' => __('Circular Category', 'textdomain'),
  ),
  'show_ui' => true,
  'show_admin_column' => true,
  'query_var' => true,
  'rewrite' => array('slug' => 'circular-category'),
);
register_taxonomy('circular-category', 'admission-circular', $tax_dept);

$tax_dept = array(
  'hierarchical' => true,
  'labels' => array(
    'name' => _x("Staff Department", 'taxonomy general name', 'textdomain'),
    'singular_name' => _x('Department', 'taxonomy singular name', 'textdomain'),
    'search_items' => __('Search Departments', 'textdomain'),
    'all_items' => __('All Departments', 'textdomain'),
    'parent_item' => __('Parent Department', 'textdomain'),
    'parent_item_colon' => __('Parent Department:', 'textdomain'),
    'edit_item' => __('Edit Department', 'textdomain'),
    'update_item' => __('Update Department', 'textdomain'),
    'add_new_item' => __('Add New Department', 'textdomain'),
    'new_item_name' => __('New Department Name', 'textdomain'),
    'menu_name' => __('Department', 'textdomain'),
  ),
  'show_ui' => true,
  'show_admin_column' => true,
  'query_var' => true,
  'rewrite' => array('slug' => 'department'),
);
register_taxonomy('department', 'stuffs', $tax_dept);

$tax_gallery = array(
  'hierarchical' => true,
  'labels' => array(
    'name' => _x("Gallery Type", 'taxonomy general name', 'textdomain'),
    'singular_name' => _x('Gallery Types', 'taxonomy singular name', 'textdomain'),
    'search_items' => __('Search Gallery Types', 'textdomain'),
    'all_items' => __('All Gallery Types', 'textdomain'),
    'parent_item' => __('Parent Gallery Type', 'textdomain'),
    'parent_item_colon' => __('Parent Gallery Type:', 'textdomain'),
    'edit_item' => __('Edit Gallery Type', 'textdomain'),
    'update_item' => __('Update Gallery Type', 'textdomain'),
    'add_new_item' => __('Add New Gallery Type', 'textdomain'),
    'new_item_name' => __('New Gallery Type Name', 'textdomain'),
    'menu_name' => __('Gallery Type', 'textdomain'),
  ),
  'show_ui' => true,
  'show_admin_column' => true,
  'query_var' => true,
  'rewrite' => array('slug' => 'gallery'),
);

register_taxonomy('type', 'gallery', $tax_gallery);

$tax_news = array(
  'hierarchical' => true,
  'labels' => array(
    'name' => _x("News Categories", 'taxonomy general name', 'textdomain'),
    'singular_name' => _x('News Categories', 'taxonomy singular name', 'textdomain'),
    'search_items' => __('Search News Categories', 'textdomain'),
    'all_items' => __('All News Categories', 'textdomain'),
    'parent_item' => __('Parent News Category', 'textdomain'),
    'parent_item_colon' => __('Parent News Category:', 'textdomain'),
    'edit_item' => __('Edit News Category', 'textdomain'),
    'update_item' => __('Update News Category', 'textdomain'),
    'add_new_item' => __('Add New News Category', 'textdomain'),
    'new_item_name' => __('New News Category Name', 'textdomain'),
    'menu_name' => __('News Category', 'textdomain'),
  ),
  'show_ui' => true,
  'show_admin_column' => true,
  'query_var' => true,
  'rewrite' => array('slug' => 'news-category'),
);

register_taxonomy('news-category', 'e-news', $tax_news);


$notice_cat = array(
  'hierarchical' => true,
  'labels' => array(
    'name' => _x("Notice Categories", 'taxonomy general name', 'textdomain'),
    'singular_name' => _x('Notice Categories', 'taxonomy singular name', 'textdomain'),
    'search_items' => __('Search Notice Categories', 'textdomain'),
    'all_items' => __('All Notice Categories', 'textdomain'),
    'parent_item' => __('Parent Notice Category', 'textdomain'),
    'parent_item_colon' => __('Parent Notice Category:', 'textdomain'),
    'edit_item' => __('Edit Notice Category', 'textdomain'),
    'update_item' => __('Update Notice Category', 'textdomain'),
    'add_new_item' => __('Add New Notice Category', 'textdomain'),
    'new_item_name' => __('New Notice Category Name', 'textdomain'),
    'menu_name' => __('Notice Category', 'textdomain'),
  ),
  'show_ui' => true,
  'show_admin_column' => true,
  'query_var' => true,
  'rewrite' => array('slug' => 'notice'),
);

register_taxonomy('notice', 'notices', $notice_cat);

