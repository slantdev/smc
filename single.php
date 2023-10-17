<?php get_header(); ?>

	<?php if (have_posts()) : ?>

		<?php
    while (have_posts()) :
      the_post();
    ?>

			<?php
      $post_type = get_post_type(get_the_ID());
      get_template_part('template-parts/single/single', $post_type);
      ?>

		<?php endwhile; ?>

	<?php endif; ?>


<?php
get_footer();
