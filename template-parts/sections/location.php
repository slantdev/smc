<?php
include get_template_directory() . '/template-parts/layouts/section_settings.php';
/*
 * Available section variables
 * $section_id
 * $section_style
 * $section_padding_top
 * $section_padding_bottom
*/

$location = get_sub_field('location');
$title = $location['title'];
$address = $location['address'];
$how_to = $location['how_to'];
$how_to_heading = $how_to['heading'];
$how_to_accordion = $how_to['accordion'];
$how_to_more_information = $how_to['more_information'];

?>

<section id="<?php echo $section_id ?>" class="" style="<?php echo $section_style ?>">
  <div class="relative <?php echo $section_padding_top . ' ' . $section_padding_bottom ?>">

    <div class="container max-w-screen-xl">
      <div class="w-2/3">
        <?php if ($title) : ?>
          <h2 class="h3 font-bold mb-8 mt-8"><?php echo $title ?></h2>
        <?php endif; ?>
        <?php if ($address) : ?>
          <div class="flex gap-x-4 items-center">
            <div class="float-none">
              <?php echo smc_icon(array('icon' => 'line-map', 'group' => 'utilities', 'size' => '40', 'class' => '')); ?>
            </div>
            <span class="font-medium text-2xl"><?php echo $address ?></span>
          </div>
        <?php endif; ?>
        <?php if ($how_to_heading) : ?>
          <h3 class="text-2xl font-medium mt-16 mb-8"><?php echo $how_to_heading ?></h3>
        <?php endif; ?>
        <?php if ($how_to_accordion) : ?>
          <div class="grid grid-cols-1 gap-y-4 mb-12">
            <?php foreach ($how_to_accordion as $info) : ?>
              <div class="collapse collapse-plus shadow-[0_3px_6px_rgba(0,0,0,0.16)]">
                <input type="checkbox" />
                <div class="collapse-title text-xl md:text-2xl font-bold py-6 px-6">
                  <?php if ($info['title']) : ?>
                    <?php echo $info['title'] ?>
                  <?php endif; ?>
                </div>
                <div class="collapse-content px-0">
                  <?php if ($info['content']) : ?>
                    <div class="prose prose-lg max-w-none px-6 pt-0">
                      <?php echo $info['content'] ?>
                    </div>
                  <?php endif; ?>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
        <?php if ($how_to_more_information) : ?>
          <div class="text-lg">
            <?php echo $how_to_more_information ?>
          </div>
        <?php endif; ?>
      </div>
    </div>

  </div>
</section>