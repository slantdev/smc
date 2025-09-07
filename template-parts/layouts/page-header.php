<?php
/*
 * Page Settings
 */
$term_id = get_queried_object()->term_id;
if ($term_id) {
  $the_id = 'term_' . $term_id;
} else {
  $the_id = get_the_ID();
}

$breadcrumbs = $args['breadcrumbs'];
if ($breadcrumbs !== true) {
  $breadcrumbs = false;
} else {
  $breadcrumbs = true;
}

//echo $args['breadcrumbs'];
$enabled = get_field('enable_page_header', $the_id);

if ($enabled) :
  $page_header = get_field('page_header', $the_id) ?? '';
  $hero_title = $page_header['hero_title'] ?? '';
  $hero_text = $page_header['hero_text'] ?? '';
  $hero_background = $page_header['hero_background'] ?? '';
  $hero_bg_color = $page_header['hero_bg_color'] ?? '';
  $hero_overlay_color = $page_header['hero_overlay_color'] ?? '';
  $cta_button = $page_header['cta_button'];
  $hero_size = $page_header['hero_size'] ?? '';

  if (!$hero_title) {
    if (is_tax()) {
      $hero_title = get_term($the_id)->name;
    } else {
      $hero_title = get_the_title();
    }
  }

  $hero_bg_style = '';
  if ($hero_bg_color) {
    $hero_bg_style .= 'background-color: ' . $hero_bg_color . ';';
  }

  $hero_overlay_style = '';
  if ($hero_overlay_color) {
    $hero_overlay_style = 'background-color: ' . $hero_overlay_color;
  }

  $enable_breadcrumbs = get_field('enable_breadcrumbs');

  $text_container_padding = 'py-16 lg:py-24';
  if ($hero_size == 'large') {
    $text_container_padding = 'py-32 lg:py-48';
  }
?>
  <section class="page-banner relative" style="<?php echo $hero_bg_style; ?>">
    <?php if ($hero_background) { ?>
      <div class="absolute inset-0 z-0">
        <?php if ($hero_overlay_color) { ?>
          <div class="banner-bg-overlay absolute inset-0 mix-blend-multiply" style="background-color: <?php echo $hero_overlay_color ?>"></div>
        <?php } ?>
        <img src="<?php echo $hero_background ?>" alt="" class="banner-bg-image object-cover h-full w-full">
      </div>
    <?php } ?>
    <div class="container max-w-screen-xl relative z-10 pt-52 lg:pt-[200px] 2xl:pt-[158px] h-full">
      <div class="flex flex-col md:flex-row h-full items-center text-white <?php echo $text_container_padding ?>">
        <div class="w-full lg:w-1/2">
          <h1 class="banner-title font-bold text-[40px] lg:text-[50px] leading-tight"><?php echo $hero_title ?></h1>
          <?php if ($hero_text) : ?>
            <div class="prose lg:prose-xl text-white mt-4 lg:mt-6">
              <?php echo $hero_text ?>
            </div>
          <?php endif; ?>
          <?php if ($cta_button) : ?>
            <div class="mt-4 lg:mt-6">
              <?php get_template_part('template-parts/components/button', '', array('field' => $cta_button)); ?>
            </div>
          <?php endif; ?>
        </div>
      </div>
      <div>
        <?php
        //preint_r($hero_text);
        //preint_r($cta_button);
        ?>
      </div>
    </div>
  </section>

  <?php if ($enable_breadcrumbs) { ?>
    <div class="bg-brand-beigelight py-4 lg:py-6">
      <div class="container max-w-screen-xl">
        <?php
        if (function_exists('yoast_breadcrumb')) {
          yoast_breadcrumb('<div class="breadcrumb">', '</div>');
        }
        ?>
      </div>
    </div>
  <?php } ?>

<?php endif; ?>