<?php
include get_template_directory() . '/template-parts/layouts/section_settings.php';
/*
 * Available section variables
 * $section_id
 * $section_style
 * $section_padding_top
 * $section_padding_bottom
*/

?>

<section id="<?php echo $section_id ?>" class="" style="<?php echo $section_style ?>">
  <div class="relative <?php echo $section_padding_top . ' ' . $section_padding_bottom ?>">

    <div class="container max-w-screen-xl">
      <div class="w-2/3">
        <h2 class="h3 font-bold mb-8 mt-8">Our Location</h2>
        <div class="flex gap-x-4 items-center">
          <div class="float-none">
            <?php echo smc_icon(array('icon' => 'line-map', 'group' => 'utilities', 'size' => '40', 'class' => '')); ?>
          </div>
          <span class="font-medium text-2xl">111 Cecil Street, South Melbourne, VIC 3205</span>
        </div>

        <h3 class="text-2xl font-medium mt-16 mb-8">How to get to South Melbourne Central</h3>
        <div class="grid grid-cols-1 gap-y-4 mb-12">
          <div class="collapse collapse-plus scroll-mt-32 shadow-[0_3px_6px_rgba(0,0,0,0.16)]">
            <input type="checkbox" />
            <div class="collapse-title text-xl md:text-2xl font-bold py-6 px-6">
              Travelling by Car
            </div>
            <div class="collapse-content px-0">
              <div class="prose prose-lg max-w-none px-6 pt-0">
                Sed magna purus, fermentum eu, tincidunt eu, varius ut, felis. Pellentesque posuere. Nullam sagittis. Suspendisse non nisl sit amet velit hendrerit rutrum. Mauris turpis nunc, blandit et, volutpat molestie, porta ut, ligula.
              </div>
            </div>
          </div>
          <div class="collapse collapse-plus scroll-mt-32 shadow-[0_3px_6px_rgba(0,0,0,0.16)]">
            <input type="checkbox" />
            <div class="collapse-title text-xl md:text-2xl font-bold py-6 px-6">
              Travelling by Tram
            </div>
            <div class="collapse-content px-0">
              <div class="prose prose-lg max-w-none px-6 pt-0">
                Sed magna purus, fermentum eu, tincidunt eu, varius ut, felis. Pellentesque posuere. Nullam sagittis. Suspendisse non nisl sit amet velit hendrerit rutrum. Mauris turpis nunc, blandit et, volutpat molestie, porta ut, ligula.
              </div>
            </div>
          </div>
          <div class="collapse collapse-plus scroll-mt-32 shadow-[0_3px_6px_rgba(0,0,0,0.16)]">
            <input type="checkbox" />
            <div class="collapse-title text-xl md:text-2xl font-bold py-6 px-6">
              Travelling by Bus
            </div>
            <div class="collapse-content px-0">
              <div class="prose prose-lg max-w-none px-6 pt-0">
                Sed magna purus, fermentum eu, tincidunt eu, varius ut, felis. Pellentesque posuere. Nullam sagittis. Suspendisse non nisl sit amet velit hendrerit rutrum. Mauris turpis nunc, blandit et, volutpat molestie, porta ut, ligula.
              </div>
            </div>
          </div>
        </div>
        <div class="text-lg">
          For more information about all public transport services, including routes and timetables visit Public Transport Victoria.
        </div>
      </div>
    </div>

  </div>
</section>