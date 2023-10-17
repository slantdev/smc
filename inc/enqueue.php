<?php

/**
 * Enqueue theme assets.
 */
function smc_enqueue_scripts()
{
  $theme = wp_get_theme();

  wp_enqueue_style('swiper', 'https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css', array(), '8.4.7');
  wp_enqueue_script('swiper', 'https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js', array(), '8.4.7');

  wp_enqueue_style('smc', smc_asset('css/app.css'), array(), $theme->get('Version'));
  wp_enqueue_script('smc', smc_asset('js/app.js'), array('jquery'), $theme->get('Version'));
}

add_action('wp_enqueue_scripts', 'smc_enqueue_scripts');

function smc_google_fonts()
{
  echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . PHP_EOL;
  echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . PHP_EOL;
  echo '<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">' . PHP_EOL;
}
add_action('wp_head', 'smc_google_fonts');

/**
 * Get asset path.
 *
 * @param string  $path Path to asset.
 *
 * @return string
 */
function smc_asset($path)
{
  if (wp_get_environment_type() === 'production') {
    return get_stylesheet_directory_uri() . '/assets/' . $path;
  }

  return add_query_arg('time', time(),  get_stylesheet_directory_uri() . '/assets/' . $path);
}

function smc_admin_styles()
{
  global $pagenow;
  $current_page = get_current_screen();
  $theme = wp_get_theme();
  wp_enqueue_style('admin_css', get_template_directory_uri() . '/assets/css/admin-style.css', false, filemtime(get_stylesheet_directory() . '/assets/css/admin-style.css'));
  wp_enqueue_style('roboto', 'https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap', false, $theme->get('Version'));

  if (($current_page->post_type === 'page' && ($pagenow === 'post-new.php' || $pagenow === 'post.php'))) {
    wp_enqueue_style('acf_layouts', get_template_directory_uri() . '/assets/css/acf-layouts.css', false, filemtime(get_stylesheet_directory() . '/assets/css/acf-layouts.css'));
  }
  if (($current_page->post_type === 'scholarship' && ($pagenow === 'post-new.php' || $pagenow === 'post.php'))) {
    wp_enqueue_style('acf_layouts', get_template_directory_uri() . '/assets/css/acf-layouts.css', false, filemtime(get_stylesheet_directory() . '/assets/css/acf-layouts.css'));
  }
}
add_action('admin_enqueue_scripts', 'smc_admin_styles');
