<?php
include get_template_directory() . '/template-parts/layouts/section_settings.php';
/*
 * Available section variables
 * $section_id
 * $section_style
 * $section_padding_top
 * $section_padding_bottom
*/
// $column_text_class = 'lg:w-2/3 xl:w-3/5';
// $column_image_class = 'max-w-[420px] lg:max-w-none lg:w-1/3 xl:w-2/5';
$columns = get_sub_field('columns');
$heading = $columns['heading'];
$lead_text = $columns['lead_text'];
$content = $columns['content'];
$image = $columns['image'];
$image_position = $columns['image_position'];
$column_text_class = 'w-full lg:w-7/12';
$column_image_class = 'w-full lg:w-5/12';
if ($image_position == 'right') {
  $column_text_class .= ' order-1';
  $column_image_class .= ' order-2';
} else {
  $column_text_class .= ' order-2';
  $column_image_class .= ' order-1';
}
?>

<section id="<?php echo $section_id ?>" style="<?php echo $section_style ?>">
  <div class="relative container max-w-screen-xl mx-auto <?php echo $section_padding_top . ' ' . $section_padding_bottom ?>">
    <div class="flex flex-col gap-y-6 lg:gap-y-0 lg:gap-x-16 lg:flex-row lg:flex-nowrap">
      <div class="<?php echo $column_text_class ?>">
        <?php if ($heading) : ?>
          <h2 class="text-3xl lg:text-4xl font-bold mb-6 lg:mb-8 lg:mt-8"><?php echo $heading ?></h2>
        <?php endif; ?>
        <?php if ($lead_text) : ?>
          <div class="text-xl lg:text-2xl font-medium my-6 lg:my-8"><?php echo $lead_text ?></div>
        <?php endif; ?>
        <?php if ($content) : ?>
          <div class="prose lg:prose-lg">
            <?php echo $content ?>
          </div>
        <?php endif; ?>
      </div>
      <div class="<?php echo $column_image_class ?>">
        <?php if ($image) : ?>
          <div class="aspect-w-1 aspect-h-1">
            <img src="<?php echo $image['url'] ?>" alt="" class="rounded-lg object-cover h-full w-full">
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>