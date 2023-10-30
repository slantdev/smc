<?php
$primary_color = get_field('primary_color', 'option');
$gallery_button_style = '';
if ($primary_color) {
  $gallery_button_style = 'background-color: ' . $primary_color . ';';
}

$store_page_banner = get_field('store_page_banner');
$banner_alignment = get_field('banner_alignment');
$banner_class = '';
if ($banner_alignment == 'top') {
  $banner_class = 'object-top';
} elseif ($banner_alignment == 'middle') {
  $banner_class = 'object-center';
} elseif ($banner_alignment == 'bottom') {
  $banner_class = 'object-bottom';
} else {
  $banner_class = 'object-center';
}
$store_image = get_field('store_image');
$description = get_field('description');
$contact_info = get_field('contact_info');
$operating_hours = get_field('operating_hours');
$category_terms = get_the_terms(get_the_ID(), 'store-category');
$store_category = '';
if ($category_terms) {
  $categories = array();
  foreach ($category_terms as $term) {
    $categories[] = $term->name;
  }
  $store_category = join(", ", $categories);
}
$location_terms = get_the_terms(get_the_ID(), 'store-location');
$store_location = '';
if ($location_terms) {
  $locations = array();
  foreach ($location_terms as $term) {
    $locations[] = $term->name;
  }
  $store_location = join(", ", $locations);
}
$store_gallery = get_field('store_gallery');
?>
<section class="relative w-full h-[200px] xl:h-[400px] 2xl:h-[512px] 3xl:h-[600px] bg-black">
  <?php if ($store_page_banner) { ?>
    <div class="absolute inset-0 z-0">
      <img src="<?php echo $store_page_banner['url'] ?>" alt="<?php echo $store_page_banner['alt'] ?>" class="object-cover h-full w-full <?php echo $banner_class ?>">
    </div>
  <?php } ?>
</section>

<section class="relative py-12 md:py-20">
  <div class="container max-w-screen-xl">
    <div class="flex flex-col gap-y-8 md:flex-row md:gap-y-0 md:gap-x-10 lg:gap-x-20">
      <div class="w-full md:w-1/3">
        <?php
        if ($store_image) {
          echo '<div class="aspect-w-1 aspect-h-1">';
          echo '<div class="shadow-[0_3px_6px_rgba(0,0,0,0.16)] rounded-lg p-6 border border-solid border-[#CCCCCC] flex justify-center items-center">';
          echo '<img src="' . $store_image['url'] . '" alt="' . $store_image['alt'] . '" />';
          echo '</div>';
          echo '</div>';
        }
        ?>
      </div>
      <div class="w-full md:w-2/3">
        <h1 class="text-4xl lg:text-[45px] font-bold uppercase mb-8"><?php echo get_the_title() ?></h1>
        <?php if ($description['lead_text'] || $description['description']) : ?>
          <div class="mb-8 lg:mb-12">
            <?php
            if ($description['lead_text']) {
              echo '<div class="font-medium text-xl md:text-2xl mb-6">' . $description['lead_text'] . '</div>';
            }
            ?>
            <?php
            if ($description['description']) {
              echo '<div class="text-lg">' . $description['description'] . '</div>';
            }
            ?>
          </div>
        <?php endif; ?>
        <?php if ($contact_info['phone'] || $contact_info['website'] || $contact_info['instagram'] || $contact_info['facebook']) : ?>
          <div class="flex flex-col gap-4 text-lg font-medium my-12">
            <?php if ($contact_info['phone']) : ?>
              <div class="flex gap-x-5 items-center">
                <div class="flex-none"><?php echo smc_icon(array('icon' => 'line-phone', 'group' => 'utilities', 'size' => '32', 'class' => 'text-black')); ?></div>
                <div><a href="tel:<?php echo $contact_info['phone'] ?>" target="_blank" class="hover:underline"><?php echo $contact_info['phone'] ?></a></div>
              </div>
            <?php endif; ?>
            <?php if ($contact_info['website']) : ?>
              <div class="flex gap-x-5 items-center">
                <div class="flex-none"><?php echo smc_icon(array('icon' => 'line-website', 'group' => 'utilities', 'size' => '32', 'class' => 'text-black')); ?></div>
                <div><a href="<?php echo $contact_info['website']['url'] ?>" target="_blank" class="hover:underline"><?php echo $contact_info['website']['title'] ?></a></div>
              </div>
            <?php endif; ?>
            <?php if ($contact_info['instagram']) : ?>
              <div class="flex gap-x-5 items-center">
                <div class="flex-none"><?php echo smc_icon(array('icon' => 'line-instagram', 'group' => 'utilities', 'size' => '32', 'class' => 'text-black')); ?></div>
                <div><a href="<?php echo $contact_info['instagram']['url'] ?>" target="_blank" class="hover:underline"><?php echo $contact_info['instagram']['title'] ?></a></div>
              </div>
            <?php endif; ?>
            <?php if ($contact_info['facebook']) : ?>
              <div class="flex gap-x-5 items-center">
                <div class="flex-none"><?php echo smc_icon(array('icon' => 'line-facebook', 'group' => 'utilities', 'size' => '32', 'class' => 'text-black')); ?></div>
                <div><a href="<?php echo $contact_info['facebook']['url'] ?>" target="_blank" class="hover:underline"><?php echo $contact_info['facebook']['title'] ?></a></div>
              </div>
            <?php endif; ?>
          </div>
        <?php endif; ?>
        <?php if ($store_category || $store_location) : ?>
          <div class="my-8 pt-8 md:my-12 md:pt-12 border-t border-solid border-stone-300">
            <div class="flex flex-col md:flex-row gap-y-8 md:gap-y-0 gap-x-12">
              <?php if ($store_category) : ?>
                <div class="w-full md:w-1/2">
                  <h3 class="text-3xl lg:text-4xl">Category</h3>
                  <div class="mt-4 md:mt-8 text-lg">
                    <?php echo $store_category ?>
                  </div>
                </div>
              <?php endif; ?>
              <?php if ($store_location) : ?>
                <div class="w-full md:w-1/2">
                  <h3 class="text-3xl lg:text-4xl">Location</h3>
                  <div class="mt-4 md:mt-8 text-lg">
                    <?php echo $store_location ?>
                  </div>
                </div>
              <?php endif; ?>
            </div>
          </div>
        <?php endif; ?>
        <?php if ($operating_hours) : ?>
          <div class="my-8 pt-8 md:my-12 md:pt-12 border-t border-solid border-stone-300">
            <h3 class="text-3xl lg:text-4xl">Store Trading Hours</h3>
            <div class="table text-lg mt-8">
              <?php foreach ($operating_hours as $hour) : ?>
                <div class="table-row">
                  <div class="table-cell w-auto whitespace-nowrap pr-12 py-1"><?php echo $hour['label'] ?></div>
                  <div class="table-cell w-full py-1"><?php echo $hour['hours'] ?></div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

<?php if ($store_gallery) : ?>
  <section id="store-gallery" class="relative py-12 md:py-20 bg-[#F4F4F2]">
    <div class="container max-w-screen-lg">
      <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff; --swiper-navigation-size: 20px" class="swiper gallerySwiper rounded-lg xl:rounded-xl">
        <div class="swiper-wrapper">
          <?php foreach ($store_gallery as $slide) : ?>
            <div class="swiper-slide w-full">
              <div class="aspect-w-16 aspect-h-9">
                <img src="<?php echo $slide['url'] ?>" class="object-cover w-full h-full" />
              </div>
            </div>
          <?php endforeach; ?>
        </div>
        <div class="swiper-button-next p-4 right-0" style="<?php echo $gallery_button_style ?>"></div>
        <div class="swiper-button-prev p-4 left-0" style="<?php echo $gallery_button_style ?>"></div>
      </div>
    </div>
    <script>
      var gallerySwiper = new Swiper(".gallerySwiper", {
        loop: true,
        watchOverflow: true,
        autoplay: {
          delay: 5000,
          disableOnInteraction: true,
        },
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
      });
    </script>
  </section>
<?php endif; ?>