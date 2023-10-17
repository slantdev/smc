<?php

/**
 * Theme setup.
 */
function smc_setup()
{
  add_theme_support('title-tag');

  register_nav_menus(
    array(
      'primary' => __('Primary Menu', 'smc'),
    )
  );

  add_theme_support(
    'html5',
    array(
      'search-form',
      'comment-form',
      'comment-list',
      'gallery',
      'caption',
    )
  );

  add_theme_support('custom-logo');
  add_theme_support('post-thumbnails');

  add_theme_support('align-wide');
  add_theme_support('wp-block-styles');

  add_theme_support('editor-styles');
  add_editor_style('css/editor-style.css');
}

add_action('after_setup_theme', 'smc_setup');

/**
 * Custom Post Types.
 */
// Add Admin Filter on CPT Edit Screen
add_action('restrict_manage_posts', 'cpt_admin_filters', 10, 1);
function cpt_admin_filters($post_type)
{
  if ('store' == $post_type) {
    $taxonomies_slugs = array(
      'store-category',
      'store-location',
      'store-area',
    );
  } else {
    return;
  }

  // loop through the taxonomy filters array
  foreach ($taxonomies_slugs as $slug) {
    $taxonomy = get_taxonomy($slug);
    $selected = '';
    // if the current page is already filtered, get the selected term slug
    $selected = isset($_REQUEST[$slug]) ? $_REQUEST[$slug] : '';
    // render a dropdown for this taxonomy's terms
    wp_dropdown_categories(array(
      'show_option_all' =>  $taxonomy->labels->all_items,
      'taxonomy'        =>  $slug,
      'name'            =>  $slug,
      'orderby'         =>  'name',
      'value_field'     =>  'slug',
      'selected'        =>  $selected,
      'hierarchical'    =>  true,
    ));
  }
}
