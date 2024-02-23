<?php
/*
 * Footer Settings
 */
$site_logo = get_field('main_navigation', 'option')['main_navigation']['site_logo'];

$footer_colors = get_field('footer_colors', 'option');
$footer_background_color = $footer_colors['background_color'];
$footer_text_color = $footer_colors['text_color'];
$footer_style = '';
if ($footer_background_color) {
  $footer_style .= ' background-color: ' . $footer_background_color . ';';
}
if ($footer_text_color) {
  $footer_style .= ' color: ' . $footer_text_color . ';';
}

$about = get_field('about', 'option');
$about_flags = $about['flags'];
$about_company = $about['about_company'];
$about_links = $about['about_links'];

$opening_hours = get_field('opening_hours', 'option');
$opening_hours_heading = $opening_hours['heading'];
$opening_hours_sub_heading = $opening_hours['sub_heading'];
$opening_hours_hours = $opening_hours['hours'];

$contact = get_field('contact', 'option');
$locations = $contact['locations'];
$call = $contact['call'];


$quick_links = get_field('quick_links', 'option')['quick_links'];

$copyright_info = get_field('copyright_info', 'option')['copyright_info'];
$copyright_colors = $copyright_info['copyright_colors'];
$copyright_background_color = $copyright_colors['background_color'];
$copyright_text_color = $copyright_colors['text_color'];
$copyright_style = '';
if ($copyright_background_color) {
  $copyright_style .= ' background-color: ' . $copyright_background_color . ';';
}
if ($copyright_text_color) {
  $copyright_style .= ' color: ' . $copyright_text_color . ';';
}

$subscribe = get_field('subscribe', 'option')['subscribe'];
$subscribe_heading = $subscribe['heading'];
$subscribe_description = $subscribe['description'];
$subscribe_form_shortcode = $subscribe['form_shortcode'];
$subscribe_background_color = $subscribe['subscribe_colors']['background_color'];
$subscribe_text_color = $subscribe['subscribe_colors']['text_color'];
$subscribe_style = '';
if ($subscribe_background_color) {
  $subscribe_style .= ' background-color: ' . $subscribe_background_color . ';';
}
if ($subscribe_text_color) {
  $subscribe_style .= ' color: ' . $subscribe_text_color . ';';
}

$instagram = get_field('instagram', 'option')['instagram'];
$instagram_heading = $instagram['heading'];
$instagram_description = $instagram['description'];
$instagram_form_shortcode = $instagram['form_shortcode'];
$instagram_background_color = $instagram['instagram_colors']['background_color'];
$instagram_text_color = $instagram['instagram_colors']['text_color'];
$instagram_style = '';
if ($subscribe_background_color) {
  $instagram_style .= ' background-color: ' . $instagram_background_color . ';';
}
if ($subscribe_text_color) {
  $instagram_style .= ' color: ' . $instagram_text_color . ';';
}
$instagram_visibility = $instagram['visibility'];
$instagram_enable_on_store_pages = $instagram_visibility['enable_on_store_pages'];

?>

<?php
wp_reset_query();

$term_id = '';
if (is_archive()) {
  $term_id = get_queried_object()->term_id;
}
if ($term_id) {
  $the_id = 'term_' . $term_id;
} else {
  $the_id = get_the_ID();
}
//echo $the_id;
$disable_subscribe = get_field('disable_subscribe', $the_id);
$disable_instagram = get_field('disable_instagram', $the_id);

if (is_singular('store')) {
  if ($instagram_enable_on_store_pages == 'disable') {
    $disable_instagram = true;
  }
}
?>

<?php if ($subscribe && !$disable_subscribe) : ?>
  <section id="subscribe" style="<?php echo $subscribe_style ?>">
    <div class="relative container max-w-screen-xl mx-auto pt-8 lg:pt-12 xl:pt-20 pb-8 lg:pb-12 xl:pb-20">
      <div class="flex flex-col gap-y-6 lg:gap-y-0 lg:flex-row lg:gap-x-12">
        <div class="w-full lg:w-1/2">
          <?php if ($site_logo['logo_white']) : ?>
            <div class="border-b border-white pb-6 mb-6 -mt-4">
              <img src="<?php echo $site_logo['logo_white']['url'] ?>" alt="<?php echo get_bloginfo('name') ?>" class="w-auto h-6 lg:h-auto 2xl:h-14 max-w-full">
            </div>
          <?php endif; ?>
          <div>
            <?php if ($subscribe_heading) : ?>
              <h3 class="text-3xl lg:text-4xl font-bold mb-4"><?php echo $subscribe_heading ?></h3>
            <?php endif; ?>
            <?php if ($subscribe_description) : ?>
              <div><?php echo $subscribe_description ?></div>
            <?php endif; ?>
          </div>
        </div>
        <div class="w-full lg:w-1/2">
          <div class="subscribe-form">
            <?php if ($subscribe_form_shortcode) : ?>
              <?php echo do_shortcode($subscribe_form_shortcode) ?>
            <?php else : ?>
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
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php endif; ?>

<?php if ($instagram_form_shortcode && !$disable_instagram) : ?>
  <section id="instagram" style="<?php echo $instagram_style ?>">
    <div class="relative container max-w-screen-xl mx-auto pt-8 lg:pt-12 xl:pt-20 pb-8 lg:pb-12 xl:pb-20">

      <?php if ($instagram_heading) : ?>
        <div class="flex gap-x-4 lg:gap-x-6 mb-8 lg:mb-12">
          <h2 class="flex-none text-3xl lg:text-4xl font-bold text-black"><?php echo $instagram_heading ?></h2>
          <div class="border-b border-solid border-slate-400 w-full">&nbsp;</div>
        </div>
      <?php endif; ?>
      <?php if ($instagram_description) : ?>
        <div class="flex lg:gap-x-8 mb-8">
          <div class="w-full lg:w-1/2 text-slate-600"><?php echo $instagram_description ?></div>
        </div>
      <?php endif; ?>

      <?php if ($instagram_form_shortcode) : ?>
        <div class="instagram-container">
          <?php echo do_shortcode($instagram_form_shortcode) ?>
        </div>
      <?php endif; ?>
    </div>
  </section>
<?php endif; ?>

<footer style="<?php echo $footer_style ?>">

  <div class="max-w-screen-4xl mx-auto px-4 md:px-6 xl:px-8 pt-16 pb-16 lg:py-24 xl:py-28">
    <div class="flex flex-col flex-wrap divide-y lg:flex-row lg:flex-nowrap lg:divide-x lg:divide-y-0 divide-white/70">
      <div class="flex flex-col gap-8 w-full lg:w-[30%] lg:pr-12 pb-8 lg:pb-0">
        <?php if ($site_logo['logo_white']) : ?>
          <div class="lg:-mt-4">
            <a href="<?php echo get_site_url() ?>" class="inline-block">
              <img src="<?php echo $site_logo['logo_white']['url'] ?>" alt="<?php echo get_bloginfo('name') ?>" class="h-8 lg:h-auto 2xl:h-12 max-w-full">
            </a>
          </div>
        <?php endif; ?>
        <?php if ($about_flags) : ?>
          <div class="flex gap-2">
            <?php foreach ($about_flags as $flag) : ?>
              <div><img src="<?php echo $flag['url'] ?>" alt="<?php echo $flag['alt'] ?>" class="h-10 w-auto" /></div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
        <?php if ($about_company) : ?>
          <div>
            <?php echo $about_company ?>
          </div>
        <?php endif; ?>
        <?php if ($about_links) : ?>
          <ul>
            <?php foreach ($about_links as $link) : ?>
              <li class="py-1"><a class="underline font-normal hover:font-semibold transition-all" href="<?php echo $link['link']['url'] ?>" target="<?php echo $link['link']['target'] ?>"><?php echo $link['link']['title'] ?></a></li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>
      </div>
      <div class="w-full lg:w-[70%]">
        <div class="grid grid-cols-1 divide-y lg:grid-cols-3 lg:divide-x lg:divide-y-0 divide-white/70">
          <?php if ($opening_hours_heading) : ?>
            <div class="py-8 lg:py-0 lg:px-12">
              <h3 class="mb-8 text-2xl font-semibold"><?php echo $opening_hours_heading ?></h3>
              <?php if ($opening_hours_sub_heading) : ?>
                <h4 class="mb-6 text-base font-bold"><?php echo $opening_hours_sub_heading ?></h4>
              <?php endif; ?>
              <?php if ($opening_hours_hours) : ?>
                <div class="grid grid-cols-6 2xl:grid-cols-12 gap-x-4 gap-y-1 2xl:gap-x-3">
                  <?php foreach ($opening_hours_hours as $hour) : ?>
                    <span class="col-span-3 lg:col-span-6 2xl:col-span-5"><?php echo $hour['day'] ?></span>
                    <span class="col-span-3 lg:col-span-6 2xl:col-span-7"><?php echo $hour['hour'] ?></span>
                  <?php endforeach; ?>
                </div>
              <?php endif; ?>
            </div>
          <?php endif; ?>
          <?php if ($locations['heading'] || $call['heading']) : ?>
            <div class="py-8 lg:py-0 lg:px-12">
              <?php if ($locations['heading']) : ?>
                <h3 class="mb-8 text-2xl font-semibold"><?php echo $locations['heading'] ?></h3>
              <?php endif; ?>
              <?php if ($locations['location']) : ?>
                <div class="flex flex-col gap-y-3">
                  <?php foreach ($locations['location'] as $location) : ?>
                    <div><?php echo $location['address'] ?></div>
                  <?php endforeach; ?>
                </div>
              <?php endif; ?>

              <?php if ($call['heading']) : ?>
                <h3 class="mt-8 mb-8 text-2xl font-semibold"><?php echo $call['heading'] ?></h3>
              <?php endif; ?>
              <?php if ($call['call_info']) : ?>
                <div class="flex flex-col gap-y-5">
                  <?php foreach ($call['call_info'] as $info) : ?>
                    <div>
                      <h5 class="text-base font-bold"><?php echo $info['title'] ?></h5>
                      <div><a class="hover:underline" href="<?php echo $info['phone']['url'] ?>" target="<?php echo $info['phone']['target'] ?>"><?php echo $info['phone']['title'] ?></a></div>
                    </div>
                  <?php endforeach; ?>
                </div>
              <?php endif; ?>
            </div>
          <?php endif; ?>
          <?php if ($quick_links['heading']) : ?>
            <div class="py-8 pb-0 lg:py-0 lg:px-12">
              <h3 class="mb-8 text-2xl font-semibold"><?php echo $quick_links['heading'] ?></h3>
              <?php if ($quick_links['links']) : ?>
                <ul>
                  <?php foreach ($quick_links['links'] as $link) : ?>
                    <?php
                    $link_title = isset($link['link']['title']) ? $link['link']['title'] : null;
                    $link_url = isset($link['link']['url']) ? $link['link']['url'] : null;
                    $link_target = isset($link['link']['target']) ? $link['link']['target'] : null;
                    if ($link_url) :
                    ?>
                      <li class="py-1"><a class="underline font-normal hover:no-underline transition-all whitespace-nowrap" href="<?php echo $link_url ?>" target="<?php echo $link_target ?>"><?php echo $link_title ?></a></li>
                    <?php endif; ?>
                  <?php endforeach; ?>
                </ul>
              <?php endif; ?>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>

  <div style="<?php echo $copyright_style ?>">
    <div class="max-w-screen-4xl mx-auto px-4 md:px-6 xl:px-8 py-6 flex flex-col gap-y-3 text-left md:text-left md:flex-row justify-between">
      <?php if ($copyright_info['copyright_site_name']) : ?>
        <div class="text-sm font-semibold">&copy; Copyright - <?php echo $copyright_info['copyright_site_name'] ?> <?php echo date('Y') ?> | All rights reserved</div>
      <?php endif; ?>
      <?php if ($copyright_info['copyright_links']) : ?>
        <div class="text-sm font-semibold flex flex-wrap gap-y-2 divide-x divide-white/70 [&>a:first-child]:pl-0">
          <?php foreach ($copyright_info['copyright_links'] as $link) : ?>
            <?php
            $link_title = isset($link['link']['title']) ? $link['link']['title'] : null;
            $link_url = isset($link['link']['url']) ? $link['link']['url'] : null;
            $link_target = isset($link['link']['target']) ? $link['link']['target'] : null;
            if ($link_url) :
            ?>
              <a class="inline-block px-4 no-underline font-normal hover:underline transition-all" href="<?php echo $link_url ?>" target="<?php echo $link_target ?>"><?php echo $link_title ?></a>
            <?php endif; ?>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>

</footer>