<?php

/**
 * Slugify a string
 */
function smc_slugify($text)
{
  // Strip html tags
  $text = strip_tags($text);
  // Replace non letter or digits by -
  $text = preg_replace('~[^\pL\d]+~u', '-', $text);
  // Transliterate
  setlocale(LC_ALL, 'en_US.utf8');
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
  // Remove unwanted characters
  $text = preg_replace('~[^-\w]+~', '', $text);
  // Trim
  $text = trim($text, '-');
  // Remove duplicate -
  $text = preg_replace('~-+~', '-', $text);
  // Lowercase
  $text = strtolower($text);
  // Check if it is empty
  if (empty($text)) {
    return 'n-a';
  }
  // Return result
  return $text;
}

/**
 * Wrap printr Development
 */
function preint_r($array)
{
  echo '<pre>';
  print_r($array);
  echo '</pre>';
}

/**
 * Get Icon
 * This function is in charge of displaying SVG icons across the site.
 *
 * Place each <svg> source in the /assets/icons/{group}/ directory, without adding
 * both `width` and `height` attributes, since these are added dynamically,
 * before rendering the SVG code.
 *
 * All icons are assumed to have equal width and height, hence the option
 * to only specify a `$size` parameter in the svg methods.
 *
 */
function smc_icon($atts = array())
{
  $atts = shortcode_atts(array(
    'icon'  => false,
    'icon_src' => '',
    'group'  => 'utility',
    'size'  => 16,
    'class'  => false,
    'label'  => false,
  ), $atts);

  if (empty($atts['icon']) && empty($atts['icon_src']))
    return;

  if ($atts['icon_src']) {
    $icon_path = get_attached_file($atts['icon_src']);
  } else {
    $icon_path = get_theme_file_path('/assets/icons/' . $atts['group'] . '/' . $atts['icon'] . '.svg');
  }
  if (!file_exists($icon_path))
    return;

  $icon = file_get_contents($icon_path);

  $class = 'svg-icon';
  if (!empty($atts['class']))
    $class .= ' ' . esc_attr($atts['class']);

  if (false !== $atts['size']) {
    $repl = sprintf('<svg class="' . $class . '" width="%d" height="%d" aria-hidden="true" role="img" focusable="false" ', $atts['size'], $atts['size']);
    $svg  = preg_replace('/^<svg /', $repl, trim($icon)); // Add extra attributes to SVG code.
  } else {
    $svg = preg_replace('/^<svg /', '<svg class="' . $class . '"', trim($icon));
  }
  $svg  = preg_replace("/([\n\t]+)/", ' ', $svg); // Remove newlines & tabs.
  $svg  = preg_replace('/>\s*</', '><', $svg); // Remove white space between SVG tags.

  if (!empty($atts['label'])) {
    $svg = str_replace('<svg class', '<svg aria-label="' . esc_attr($atts['label']) . '" class', $svg);
    $svg = str_replace('aria-hidden="true"', '', $svg);
  }

  return $svg;
}


function smc_svg($atts = array())
{
  $atts = shortcode_atts(array(
    'svg'  => false,
    'svg_src' => '',
    'group'  => 'shape',
    'size'  => 16,
    'class'  => false,
    'label'  => false,
  ), $atts);

  if (empty($atts['svg']) && empty($atts['svg_src']))
    return;

  if ($atts['svg_src']) {
    $icon_path = get_attached_file($atts['svg_src']);
  } else {
    $icon_path = get_theme_file_path('/assets/svg/' . $atts['group'] . '/' . $atts['svg'] . '.svg');
  }
  if (!file_exists($icon_path))
    return;

  $icon = file_get_contents($icon_path);

  $class = 'svg-icon';
  if (!empty($atts['class']))
    $class .= ' ' . esc_attr($atts['class']);

  if (false !== $atts['size']) {
    $repl = sprintf('<svg class="' . $class . '" width="%d" height="%d" aria-hidden="true" role="img" focusable="false" ', $atts['size'], $atts['size']);
    $svg  = preg_replace('/^<svg /', $repl, trim($icon)); // Add extra attributes to SVG code.
  } else {
    $svg = preg_replace('/^<svg /', '<svg class="' . $class . '"', trim($icon));
  }
  $svg  = preg_replace("/([\n\t]+)/", ' ', $svg); // Remove newlines & tabs.
  $svg  = preg_replace('/>\s*</', '><', $svg); // Remove white space between SVG tags.

  if (!empty($atts['label'])) {
    $svg = str_replace('<svg class', '<svg aria-label="' . esc_attr($atts['label']) . '" class', $svg);
    $svg = str_replace('aria-hidden="true"', '', $svg);
  }

  return $svg;
}
