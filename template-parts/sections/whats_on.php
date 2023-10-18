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
$grid_style = $post_settings['grid_style'];
$posts_per_page = $post_settings['posts_per_page'];
if (!$posts_per_page) {
  $posts_per_page = '-1';
}
$primary_color = get_field('primary_color', 'option');
$link_style = 'color: ' . $primary_color;

if (!$categories) {
  $whats_on = new WP_Query(
    array(
      'post_type'         => 'whats-on',
      'post_status '      => 'publish',
      // 'orderby'           => 'menu_order',
      // 'order'             => 'ASC',
      'posts_per_page'    => $posts_per_page,
    )
  );
} else {
  $whats_on = new WP_Query(
    array(
      'post_type'         => 'whats-on',
      'post_status '      => 'publish',
      // 'orderby'           => 'menu_order',
      // 'order'             => 'ASC',
      'posts_per_page'    => $posts_per_page,
      'tax_query' => array(
        array(
          'taxonomy' => 'whats-on-category',
          'field'    => 'term_id',
          'terms'    => $categories,
        ),
      ),
    )
  );
}


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
      <div class="flex gap-x-8 mb-8">
        <div class="w-1/2 text-slate-600"><?php echo $description ?></div>
      </div>
    <?php endif; ?>

    <?php if ($whats_on->have_posts()) : ?>
      <?php if ($grid_style == 'banner') : ?>
        <div class="grid grid-cols-1 gap-y-10">
          <?php while ($whats_on->have_posts()) : $whats_on->the_post(); ?>
            <?php
            $id = get_the_ID();
            ?>
            <div class="rounded-xl overflow-hidden">
              <?php if (has_post_thumbnail($id)) : ?>
                <?php echo get_the_post_thumbnail($id, 'full', array('class' => 'rounded-xl')); ?>
              <?php endif; ?>
            </div>
          <?php endwhile; ?>
        </div>
      <?php else : ?>
        <div class="grid grid-cols-3 gap-x-10">
          <?php while ($whats_on->have_posts()) : $whats_on->the_post(); ?>
            <?php
            $id = get_the_ID();
            if ($grid_style == 'simple') :
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
            <?php elseif ($grid_style == 'card') : ?>
              <div class="shadow-[0_3px_6px_rgba(0,0,0,0.16)] rounded-xl overflow-hidden">
                <div class="aspect-w-16 aspect-h-10 rounded-t-xl">
                  <?php if (has_post_thumbnail($id)) : ?>
                    <?php echo get_the_post_thumbnail($id, 'full', array('class' => 'w-full h-full object-cover rounded-t-xl')); ?>
                  <?php endif; ?>
                </div>
                <div class="p-6 prose">
                  <h3 class="text-xl font-bold mb-4"><?php the_title() ?></h3>
                  <div class="text-slate-700 text-base"><?php the_content() ?></div>
                </div>
              </div>
            <?php else : ?>
            <?php endif; ?>
          <?php endwhile; ?>
        </div>
      <?php endif; ?>
    <?php endif; ?>

    <?php wp_reset_postdata(); ?>

  </div>
</section>