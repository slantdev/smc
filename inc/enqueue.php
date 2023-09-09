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
  wp_enqueue_script('smc', smc_asset('js/app.js'), array(), $theme->get('Version'));
}

add_action('wp_enqueue_scripts', 'smc_enqueue_scripts');

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
