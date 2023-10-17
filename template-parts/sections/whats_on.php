<?php
include get_template_directory() . '/template-parts/layouts/section_settings.php';
/*
 * Available section variables
 * $section_id
 * $section_style
 * $section_padding_top
 * $section_padding_bottom
*/
$whats_on = get_sub_field('whats_on');
$heading = $whats_on['heading'];
$description = $whats_on['description'];
$post_settings = $whats_on['post_settings'];
$categories = $post_settings['categories'];
$posts_per_page = $post_settings['posts_per_page'];
if (!$posts_per_page) {
  $posts_per_page = '-1';
}
$primary_color = get_field('primary_color', 'option');
$link_style = 'color: ' . $primary_color;

$whats_on = new WP_Query(
  array(
    'post_type'         => 'whats-on',
    'post_status '      => 'publish',
    // 'orderby'           => 'menu_order',
    // 'order'             => 'ASC',
    'posts_per_page'    => $posts_per_page,
  )
);

//preint_r($whats_on);

?>

<section id="<?php echo $section_id ?>" style="<?php echo $section_style ?>">
  <div class="relative container max-w-screen-xl mx-auto <?php echo $section_padding_top . ' ' . $section_padding_bottom ?>">
    <?php if ($heading) : ?>
      <div class="flex gap-x-6 mb-12">
        <h2 class="flex-none text-4xl font-bold text-black"><?php echo $heading ?></h2>
        <div class="border-b border-solid border-slate-400 w-full">&nbsp;</div>
      </div>
    <?php endif; ?>
    <?php if ($description) : ?>
      <div class="flex gap-x-8">
        <div class="w-1/2 text-slate-600"><?php echo $description ?></div>
      </div>
    <?php endif; ?>

    <?php if ($whats_on->have_posts()) : ?>
      <div class="grid grid-cols-3 gap-x-10 mt-8">
        <?php while ($whats_on->have_posts()) : $whats_on->the_post(); ?>
          <?php
          $id = get_the_ID();
          ?>
          <div>
            <div class="aspect-w-1 aspect-h-1 rounded-lg mb-4">
              <?php if (has_post_thumbnail($id)) : ?>
                <a href="<?php the_permalink() ?>" class="block">
                  <?php echo get_the_post_thumbnail($id, 'full', array('class' => 'w-full h-full object-cover rounded-lg')); ?>
                </a>
              <?php endif; ?>
            </div>
            <h3 class="text-3xl font-normal mb-4"><a href="<?php the_permalink() ?>" class="text-slate-600 hover:underline"><?php the_title() ?></a></h3>
            <div class="text-slate-500 text-sm"><?php the_excerpt() ?></div>
            <div class="mt-4">
              <a href="<?php the_permalink() ?>" class="text-sm uppercase font-medium hover:underline" style="<?php echo $link_style; ?>">FIND OUT MORE</a>
            </div>
          </div>
        <?php endwhile; ?>
      </div>
    <?php endif; ?>

  </div>
</section>