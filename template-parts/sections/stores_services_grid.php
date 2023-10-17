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
$boxes = $grid['stores_services_box'];
$primary_color = get_field('primary_color', 'option');
$button_style = 'color: ' . $primary_color . ';' . 'border-color: ' . $primary_color . ';' . 'color: ' . $primary_color . ';';

//preint_r($whats_on);

?>

<section id="<?php echo $section_id ?>" style="<?php echo $section_style ?>">
  <div class="relative container max-w-screen-xl mx-auto <?php echo $section_padding_top . ' ' . $section_padding_bottom ?>">

    <?php if ($boxes) : ?>
      <div class="grid grid-cols-3 shadow-[0_6px_6px_rgba(0,0,0,0.16)]">
        <?php foreach ($boxes as $box) : ?>
          <?php if ($box['box_type'] == 'content') : ?>
            <?php
            $content = $box['content'];
            $heading = $content['heading'];
            $text = $content['text'];
            $link = $content['link'];
            $background_color = $content['background_color'];
            $box_style = 'background-color: ' . $background_color . ';';
            ?>
            <div class="w-full h-full flex flex-col justify-center items-center p-8 text-center" style="<?php echo $box_style ?>">
              <?php if ($heading) : ?>
                <h4 class="text-3xl font-medium"><?php echo $heading ?></h4>
              <?php endif; ?>
              <?php if ($text) : ?>
                <div class="text-slate-500 mt-4 text-base"><?php echo $text ?></div>
              <?php endif; ?>
              <?php if ($link) : ?>
                <div class="mt-8"><a href="<?php echo $link['url'] ?>" class="inline-block border py-2 px-10 rounded-full hover:underline" style="<?php echo $button_style ?>"><?php echo $link['title'] ?></a></div>
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