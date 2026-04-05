<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width">
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

  <?php wp_head(); ?>
</head>

<body <?php body_class('bg-white text-black antialiased overflow-x-hidden'); ?>>

  <?php do_action('smc_site_before'); ?>

  <div id="page" class="min-h-screen flex flex-col">

    <?php do_action('smc_header'); ?>

    <?php get_template_part('template-parts/site', 'header'); ?>

    <div id="content" class="site-content flex-grow">

      <?php do_action('smc_content_start'); ?>

      <?php
      $queried_obj = get_queried_object();
      $term_id = isset($queried_obj->term_id) ? $queried_obj->term_id : false;
      if ($term_id) {
        $the_id = 'term_' . $term_id;
      } else {
        $the_id = get_the_ID();
      }
      
      $enable_page_header = function_exists('get_field') ? get_field('enable_page_header', $the_id) : false;
      ?>
      <main>
      <?php
      // If there is no page header, insert a spacer block to push content down natively beneath the fixed site header.
      // We paint this block with the main navigation background color to seamlessly hide any "white flash" gap
      // when the fixed header height is animating back to full size.
      if (!$enable_page_header) {
        $nav_group = function_exists('get_field') ? get_field('main_navigation', 'option') : [];
        $main_nav = $nav_group['main_navigation'] ?? [];
        $main_nav_colors = $main_nav['colors'] ?? [];
        $main_nav_bg_color = $main_nav_colors['background_color'] ?? '';
        
        $spacer_style = $main_nav_bg_color ? 'background-color: ' . $main_nav_bg_color . ';' : '';
        echo '<div class="w-full h-[64px] lg:h-[114px] xl:h-[142px] 2xl:h-[158px]" style="' . esc_attr($spacer_style) . '"></div>';
      }
      ?>