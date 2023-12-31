<?php
include get_template_directory() . '/template-parts/layouts/section_settings.php';
/*
 * Available section variables
 * $section_id
 * $section_style
 * $section_padding_top
 * $section_padding_bottom
*/


$grid = get_sub_field('stores_services_grid');
$heading = $grid['heading'];
$description = $grid['description'];
$link = $grid['link'];
$boxes = $grid['stores_services_box'];
$primary_color = get_field('primary_color', 'option');
$button_style = 'color: ' . $primary_color . ';' . 'border-color: ' . $primary_color . ';' . 'color: ' . $primary_color . ';';

?>

<section id="<?php echo $section_id ?>" style="<?php echo $section_style ?>">
  <div class="relative container max-w-screen-xl mx-auto <?php echo $section_padding_top . ' ' . $section_padding_bottom ?>">

    <?php if ($heading) : ?>
      <div class="flex gap-x-4 lg:gap-x-6 mb-8 lg:mb-12">
        <h2 class="flex-none text-3xl lg:text-4xl font-bold text-black"><?php echo $heading ?></h2>
        <div class="border-b border-solid border-slate-400 w-full">&nbsp;</div>
      </div>
    <?php endif; ?>
    <?php if ($description || $link) : ?>
      <div class="flex flex-col gap-y-4 mb-8 lg:flex-row lg:gap-x-8 lg:mb-12">
        <?php if ($description) : ?>
          <div class="w-full lg:w-1/2 text-slate-600"><?php echo $description ?></div>
        <?php endif; ?>
        <?php if ($link) : ?>
          <div class="w-full lg:w-1/2 lg:text-right"><a href="<?php echo $link['url'] ?>" class="underline"><?php echo $link['title'] ?></a></div>
        <?php endif; ?>
      </div>
    <?php endif; ?>

    <?php if ($boxes) : ?>
      <div class="grid grid-cols-1 md:grid-cols-3 shadow-[0_6px_6px_rgba(0,0,0,0.16)]">
        <?php foreach ($boxes as $box) : ?>
          <?php if ($box['box_type'] == 'content') : ?>
            <?php
            $content = $box['content'];
            $heading = $content['heading'];
            $text = $content['text'];
            $link = $content['link'];
            $store_category = $content['store_category'];
            $background_color = $content['background_color'];
            $box_style = 'background-color: ' . $background_color . ';';
            ?>
            <div class="w-full h-full flex flex-col justify-center items-center p-8 text-center" style="<?php echo $box_style ?>">
              <?php if ($heading) : ?>
                <h4 class="text-2xl lg:text-3xl font-medium"><?php echo $heading ?></h4>
              <?php endif; ?>
              <?php if ($text) : ?>
                <div class="text-sm text-slate-500 mt-4 lg:text-base"><?php echo $text ?></div>
              <?php endif; ?>
              <?php
              if ($link) :
                $link_url = $link['url'];
                if ($store_category) {
                  $link_url = $link['url'] . '?cat=' . $store_category;
                }
              ?>
                <div class="mt-4 lg:mt-8"><a href="<?php echo $link_url ?>" class="inline-block border py-2 px-8 lg:px-10 rounded-full hover:underline text-sm md:text-base" style="<?php echo $button_style ?>"><?php echo $link['title'] ?></a></div>
              <?php endif; ?>
            </div>
          <?php else : ?>
            <?php
            $image = $box['image'];
            if ($image['image']) :
            ?>
              <div class="w-full h-full">
                <img src="<?php echo $image['image']['url'] ?>" alt="" class="w-full h-full object-cover">
              </div>
            <?php endif; ?>
          <?php endif; ?>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

  </div>
</section>