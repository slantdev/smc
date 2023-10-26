<?php
include get_template_directory() . '/template-parts/layouts/section_settings.php';
/*
 * Available section variables
 * $section_id
 * $section_style
 * $section_padding_top
 * $section_padding_bottom
*/

$hero_slider = get_sub_field('hero_slider');
$info_box = get_sub_field('info_box');
$show_info_box = $info_box['show_info_box'];

if ($hero_slider) : ?>
  <section class="relative bg-white">
    <div id="hero-slider" class="swiper bg-black relative h-screen">
      <div class="swiper-wrapper">
        <?php foreach ($hero_slider as $slide) : ?>
          <?php
          $background = $slide['background'];
          $slide_image = $background['background_image'];
          $bg_overlay = $background['background_overlay_color'];
          $pre_headline = $slide['pre_headline'];
          $headline = $slide['headline'];
          $description = $slide['description'];
          $buttons = $slide['buttons'];

          $overlay_style = '';
          if ($bg_overlay) {
            $overlay_style = 'background-color: ' . $bg_overlay;
          }
          ?>
          <div class="swiper-slide overflow-hidden">
            <?php if ($slide_image) : ?>
              <div class="absolute inset-0">
                <div class="absolute inset-0 bg-[#4A4A4A]/70 mix-blend-multiply" style="<?php echo $overlay_style ?>"></div>
                <img src="<?php echo $slide_image['url'] ?>" alt="<?php echo $slide_image['alt'] ?>" class="object-cover h-full w-full opacity-100">
              </div>
            <?php endif; ?>
            <div class="container max-w-screen-xl relative z-10 pt-[180px] pb-10 h-full">
              <div class="flex h-full items-center text-white">
                <div>
                  <?php if ($headline) : ?>
                    <div class="pt-16 pb-10 lg:pt-20 lg:pb-8 relative">
                      <div class="w-full xl:w-3/5">
                        <?php if ($pre_headline) : ?>
                          <h4 class="border-b border-white inline-block pb-2 mb-8 text-[22px] font-normal"><?php echo $pre_headline ?></h4>
                        <?php endif; ?>
                        <h2 class="hero-headline text-[64px] font-bold"><?php echo $headline; ?></h2>
                      </div>
                    </div>
                  <?php endif; ?>
                  <div class="flex flex-col lg:flex-row lg:gap-x-8 xl:gap-x-14">
                    <?php if ($description) : ?>
                      <div class="w-full lg:w-1/2">
                        <div class="hero-description text-2xl">
                          <?php echo $description; ?>
                        </div>
                      </div>
                    <?php endif; ?>
                    <div class="w-full lg:w-1/2 lg:pl-20">
                      <div class="hero-buttons">
                        <?php get_template_part('template-parts/components/buttons', '', array('field' => $buttons, 'class' => 'mt-4 xl:mt-4')); ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
      <div class="swiper-button-prev after:content-['prev'] after:text-3xl text-white font-bold"></div>
      <div class="swiper-button-next after:content-['next'] after:text-3xl text-white font-bold"></div>
    </div>
    <script>
      const swiper = new Swiper('#hero-slider', {
        loop: true,
        watchOverflow: true,
        effect: 'fade',
        speed: 1000,
        autoplay: {
          delay: 8000,
        },
        navigation: {
          nextEl: '#hero-slider .swiper-button-next',
          prevEl: '#hero-slider .swiper-button-prev',
        },
      });
    </script>
  </section>
  <?php
  if ($show_info_box) :

    $info_boxes = $info_box['info_boxes'];
    $opening_hours = $info_boxes['opening_hours'];
    $address = $info_boxes['address'];
    $contact = $info_boxes['contact'];
    $color_settings = $info_box['color_settings'];
    $info_box_style = '';
    if ($color_settings['background_color']) {
      $info_box_style .= 'background-color: ' . $color_settings['background_color'] . ';';
    }
    if ($color_settings['text_color']) {
      $info_box_style .= 'color: ' . $color_settings['text_color'] . ';';
    }
  ?>
    <section class="relative z-20">
      <div class="container max-w-screen-xl mx-auto -translate-y-3/4">
        <div class="bg-gray-700 rounded-lg shadow-[0_6px_6px_rgba(0,0,0,0.16)] text-lg text-white" style="<?php echo $info_box_style ?>">
          <div class="flex divide-x divide-white/20 py-8 px-2">
            <?php if ($opening_hours['title']) : ?>
              <div class="flex gap-x-5 text-white px-8 py-4">
                <div class="flex-none"><?php echo smc_icon(array('icon' => 'line-clock', 'group' => 'utilities', 'size' => '56', 'class' => '')); ?></div>
                <div class="pt-1">
                  <div class="font-bold"><?php echo $opening_hours['title'] ?></div>
                  <?php if ($opening_hours['link']) : ?>
                    <div><a href="<?php echo $opening_hours['link']['url'] ?>" class="underline hover:no-underline"><?php echo $opening_hours['link']['title'] ?></a></div>
                  <?php endif; ?>
                </div>
              </div>
            <?php endif; ?>

            <?php if ($address['title']) : ?>
              <div class="flex gap-x-5 text-white px-8 py-4">
                <div class="flex-none"><?php echo smc_icon(array('icon' => 'line-map', 'group' => 'utilities', 'size' => '56', 'class' => '')); ?></div>
                <div class="pt-1">
                  <div class="font-bold"><?php echo $address['title'] ?></div>
                  <?php if ($address['link']) : ?>
                    <div><a href="<?php echo $address['link']['url'] ?>" class="underline hover:no-underline"><?php echo $address['link']['title'] ?></a></div>
                  <?php endif; ?>
                </div>
              </div>
            <?php endif; ?>

            <?php if ($contact['title']) : ?>
            <?php endif; ?>
            <div class="flex gap-x-5 text-white px-8 py-4">
              <div class="flex-none"><?php echo smc_icon(array('icon' => 'line-contact', 'group' => 'utilities', 'size' => '56', 'class' => '')); ?></div>
              <div class="pt-1">
                <div class="font-bold"><?php echo $contact['title'] ?></div>
                <?php if ($contact['link']) : ?>
                  <div><a href="<?php echo $contact['link']['url'] ?>" class="underline hover:no-underline"><?php echo $contact['link']['title'] ?></a></div>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  <?php endif; ?>
<?php endif; ?>