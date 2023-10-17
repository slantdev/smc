<?php
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

?>

<footer style="<?php echo $footer_style ?>">

  <div class="max-w-screen-4xl mx-auto px-4 md:px-6 xl:px-8 pt-16 pb-16 lg:py-24 xl:py-28">
    <div class="flex flex-col flex-wrap lg:flex-row lg:flex-nowrap divide-x divide-white">
      <div class="flex flex-col gap-8 w-full lg:w-[30%] lg:pr-12">
        <?php if ($site_logo['logo_white']) : ?>
          <div class="-mt-4">
            <a href="<?php echo get_site_url() ?>" class="inline-block">
              <img src="<?php echo $site_logo['logo_white']['url'] ?>" alt="<?php echo get_bloginfo('name') ?>" class="h-6 lg:h-auto 2xl:h-12 max-w-full">
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
        <div class="grid grid-cols-3 divide-x divide-white">
          <?php if ($opening_hours_heading) : ?>
            <div class="lg:px-12">
              <h3 class="mb-8 text-2xl font-semibold"><?php echo $opening_hours_heading ?></h3>
              <?php if ($opening_hours_sub_heading) : ?>
                <h4 class="mb-6 text-base font-bold"><?php echo $opening_hours_sub_heading ?></h4>
              <?php endif; ?>
              <?php if ($opening_hours_hours) : ?>
                <div class="grid grid-cols-12 gap-x-3 gap-y-1">
                  <?php foreach ($opening_hours_hours as $hour) : ?>
                    <span class="col-span-5"><?php echo $hour['day'] ?></span>
                    <span class="col-span-7"><?php echo $hour['hour'] ?></span>
                  <?php endforeach; ?>
                </div>
              <?php endif; ?>
            </div>
          <?php endif; ?>
          <?php if ($locations['heading'] || $call['heading']) : ?>
            <div class="lg:px-12">
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
            <div class="lg:px-12">
              <h3 class="mb-8 text-2xl font-semibold"><?php echo $quick_links['heading'] ?></h3>
              <?php if ($quick_links['links']) : ?>
                <ul>
                  <?php foreach ($quick_links['links'] as $link) : ?>
                    <li class="py-1"><a class="underline font-normal hover:no-underline transition-all whitespace-nowrap" href="<?php echo $link['link']['url'] ?>" target="<?php echo $link['link']['target'] ?>"><?php echo $link['link']['title'] ?></a></li>
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
    <div class="max-w-screen-4xl mx-auto px-4 md:px-6 xl:px-8 py-6 flex flex-col gap-y-3 text-center md:text-left md:flex-row justify-between">
      <?php if ($copyright_info['copyright_site_name']) : ?>
        <div class="text-sm font-semibold">&copy; Copyright - <?php echo $copyright_info['copyright_site_name'] ?> <?php echo date('Y') ?> | All rights reserved</div>
      <?php endif; ?>
      <?php if ($copyright_info['copyright_links']) : ?>
        <div class="text-sm font-semibold flex divide-x divide-white">
          <?php foreach ($copyright_info['copyright_links'] as $link) : ?>
            <a class="inline-block px-4 no-underline font-normal hover:underline transition-all whitespace-nowrap" href="<?php echo $link['link']['url'] ?>" target="<?php echo $link['link']['target'] ?>"><?php echo $link['link']['title'] ?></a>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>

</footer>