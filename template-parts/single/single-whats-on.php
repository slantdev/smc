<?php
$the_id = get_the_ID();
$featured_img_url = get_the_post_thumbnail_url($the_id, 'full');
$title = get_the_title();
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

  <section id="store-banner" class="relative w-full h-[200px] xl:h-[400px] 2xl:h-[512px] 3xl:h-[600px] bg-black">
    <?php if ($featured_img_url) { ?>
      <div class="absolute inset-0 z-0">
        <img src="<?php echo $featured_img_url ?>" alt="<?php echo $title ?>" class="object-cover h-full w-full">
      </div>
    <?php } ?>
  </section>

  <section class="relative py-12 md:py-20">
    <div class="container max-w-screen-xl">
      <div class="w-full lg:w-2/3">
        <h1 class="text-4xl lg:text-[45px] font-bold uppercase mb-8"><?php echo $title ?></h1>
        <div class="mb-8 lg:mb-12">
          <div class="prose prose-lg">
            <?php the_content(); ?>
          </div>
        </div>
      </div>
    </div>
  </section>

</div>