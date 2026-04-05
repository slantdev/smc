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
      $main_classes = '';
      
      // If there is no page header, add padding to push content down below the fixed site header
      if (!$enable_page_header) {
        $main_classes = 'pt-[64px] lg:pt-[114px] xl:pt-[142px] 2xl:pt-[158px]';
      }
      ?>
      <main class="<?php echo esc_attr($main_classes); ?>">