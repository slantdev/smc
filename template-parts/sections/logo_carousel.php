<?php
include get_template_directory() . '/template-parts/layouts/section_settings.php';
/*
 * Available section variables
 * $section_id
 * $section_style
 * $section_padding_top
 * $section_padding_bottom
*/

$logo_carousel = get_sub_field('logo_carousel');
$logo_gallery = $logo_carousel['logo_gallery'];
$size = 'full';

$stores = new WP_Query(
  array(
    'post_type'         => 'store',
    'post_status '      => 'publish',
    'orderby'           => 'menu_order',
    'order'             => 'ASC',
    'posts_per_page'    => -1,
  )
);

?>

<section id="<?php echo $section_id ?>" class="relative" style="<?php echo $section_style ?>">
  <div class="relative <?php echo $section_padding_top . ' ' . $section_padding_bottom ?>">
    <div class="py-6 lg:py-0">
      <?php if ($stores->have_posts()) : ?>
        <?php
        $carousel_id = uniqid('carousel-');
        $carousel_loop = 'true';
        $carousel_autoplay_setting = '
      autoplay: {
        delay: 3000,
        disableOnInteraction: false,
      }
    ';
        ?>
        <div id="<?php echo $carousel_id ?>" class="swiper px-8" style="--swiper-navigation-color: #fff; --swiper-navigation-size: 24px">
          <div class="swiper-wrapper">
            <?php while ($stores->have_posts()) : $stores->the_post(); ?>
              <?php
              $id = get_the_ID();
              $permalink = get_the_permalink($id);
              $store_logo_white = get_field('store_logo_white', $id);
              //preint_r($id);
              if ($store_logo_white) :
              ?>
                <div class="swiper-slide">
                  <div class="flex flex-col items-center justify-center">
                    <a href="<?php echo $permalink ?>"><img src="<?php echo esc_url($store_logo_white['sizes']['medium']); ?>" alt="<?php echo esc_attr($store_logo_white['alt']); ?>" class=""></a>
                  </div>
                </div>
              <?php endif; ?>
            <?php endwhile; ?>
          </div>
          <div class="<?php echo $carousel_id ?>--button-prev swiper-button-next"></div>
          <div class="<?php echo $carousel_id ?>--button-next swiper-button-prev"></div>
        </div>
        <?php
        echo '<script>';
        echo 'new Swiper("#' . $carousel_id . '", {';
        echo '
      slidesPerView: "1",
      spaceBetween: 16,
      watchOverflow: true,
      centerInsufficientSlides: true,
      breakpoints: {
        768: {
          slidesPerView: "3",
          spaceBetween: 32
        },
        1280: {
          slidesPerView: "6",
          spaceBetween: 40
        }
      },
      ';
        echo 'navigation: {
      nextEl: ".' . $carousel_id . '--button-next",
      prevEl: ".' . $carousel_id . '--button-prev",
    },';
        echo 'loop: ' . $carousel_loop . ',';
        echo $carousel_autoplay_setting;
        echo '});';
        echo '</script>';
        ?>
      <?php endif; ?>
    </div>
  </div>
</section>