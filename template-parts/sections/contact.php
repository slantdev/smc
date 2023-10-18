<?php
include get_template_directory() . '/template-parts/layouts/section_settings.php';
/*
 * Available section variables
 * $section_id
 * $section_style
 * $section_padding_top
 * $section_padding_bottom
*/

$button_style = '';
$primary_color = get_field('primary_color', 'option');
if ($primary_color) {
  $button_style = 'color: white; background: ' . $primary_color;
}
?>

<section id="<?php echo $section_id ?>" class="bg-brand-blue" style="<?php echo $section_style ?><?php echo $section_style_2 ?>">

  <div class="relative container max-w-screen-xl mx-auto <?php echo $section_padding_top . ' ' . $section_padding_bottom ?>">
    <div class="flex gap-x-6 mb-12">
      <h2 class="flex-none text-4xl font-bold text-black">DROP US A LINE</h2>
      <div class="border-b border-solid border-slate-400 w-full">&nbsp;</div>
    </div>
    <div class="flex flex-col gap-y-8 lg:gap-y-0 lg:gap-x-16 lg:flex-row lg:flex-nowrap">
      <div class="w-1/2">
        <div class="text-2xl font-medium mb-8 mt-0">We’re always interested in hearing from you.</div>
        <div class="prose xl:prose-lg">
          If you have any feedback or queries regarding South Melbourne Central, please fill in the form or you can contact us directly by phone:
        </div>
        <div class="mt-10 flex flex-col gap-6">
          <div class="flex gap-x-6 items-center">
            <div class="float-none">
              <?php echo smc_icon(array('icon' => 'line-phone', 'group' => 'utilities', 'size' => '40', 'class' => '')); ?>
            </div>
            <div>
              <div class="font-bold text-xl">CENTRE MANAGEMENT ENQUIRIES</div>
              <div class="text-xl text-slate-600">0400 543 534</div>
            </div>
          </div>
          <div class="flex gap-x-6 items-center">
            <div class="float-none">
              <?php echo smc_icon(array('icon' => 'line-phone', 'group' => 'utilities', 'size' => '40', 'class' => '')); ?>
            </div>
            <div>
              <div class="font-bold text-xl">LOST PROPERTY ENQUIRIES</div>
              <div class="text-xl text-slate-600">0407 918 369</div>
            </div>
          </div>
        </div>
      </div>
      <div class="w-1/2">
        <div class="flex flex-col gap-6 w-full">
          <div class="flex gap-4">
            <div>
              <label for="" class="inline-block font-bold mb-1">First name *</label>
              <input type="text" class="bg-gray-100 shadow-inner rounded-lg border-none w-full" placeholder="">
            </div>
            <div>
              <label for="" class="inline-block font-bold mb-1">Last name *</label>
              <input type="text" class="bg-gray-100 shadow-inner rounded-lg border-none w-full" placeholder="">
            </div>
          </div>
          <div>
            <label for="" class="inline-block font-bold mb-1">Email *</label>
            <input type="text" class="bg-gray-100 shadow-inner rounded-lg border-none w-full" placeholder="">
          </div>
          <div>
            <label for="" class="inline-block font-bold mb-1">Phone *</label>
            <input type="text" class="bg-gray-100 shadow-inner rounded-lg border-none w-full" placeholder="">
          </div>
          <div>
            <label for="" class="inline-block font-bold mb-1">Message *</label>
            <textarea class="bg-gray-100 shadow-inner rounded-lg border-none w-full" rows="4"></textarea>
          </div>
          <div>
            <button type="button" class="bg-black py-3 px-12 rounded-lg font-bold text-white hover:bg-opacity-60" style="<?php echo $button_style ?>">Submit</button>
          </div>
        </div>
      </div>
    </div>
  </div>

</section>