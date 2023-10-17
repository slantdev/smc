<?php
include get_template_directory() . '/template-parts/layouts/section_settings.php';
/*
 * Available section variables
 * $section_id
 * $section_style
 * $section_padding_top
 * $section_padding_bottom
*/
$site_logo = get_field('main_navigation', 'option')['main_navigation']['site_logo'];
$subscribe = get_sub_field('subscribe');
$heading = $subscribe['heading'];
$description = $subscribe['description'];
$form_shortcode = $subscribe['form_shortcode'];

?>
<section id="<?php echo $section_id ?>" style="<?php echo $section_style ?>">
  <div class="relative container max-w-screen-xl mx-auto <?php echo $section_padding_top . ' ' . $section_padding_bottom ?>">
    <div class="flex gap-x-12">
      <div class="w-1/2">
        <?php if ($site_logo['logo_white']) : ?>
          <div class="border-b border-white pb-6 mb-6 -mt-4">
            <img src="<?php echo $site_logo['logo_white']['url'] ?>" alt="<?php echo get_bloginfo('name') ?>" class="h-6 lg:h-auto 2xl:h-14 max-w-full">
          </div>
        <?php endif; ?>
        <div>
          <?php if ($heading) : ?>
            <h3 class="text-4xl font-bold mb-4"><?php echo $heading ?></h3>
          <?php endif; ?>
          <?php if ($description) : ?>
            <p><?php echo $description ?></p>
          <?php endif; ?>
        </div>
      </div>
      <div class="w-1/2">
        <div class="flex flex-col gap-8 w-full">
          <div class="flex gap-4">
            <input type="text" class="bg-white rounded-full border-none w-full" placeholder="First name*">
            <input type="text" class="bg-white rounded-full border-none w-full" placeholder="Last name*">
          </div>
          <div><input type="text" class="bg-white rounded-full border-none w-full" placeholder="Email*"></div>
          <div>
            <button type="button" class="bg-black py-3 px-12 rounded-full font-bold text-white hover:bg-opacity-60">Subscribe</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>