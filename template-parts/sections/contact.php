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
$contact = get_sub_field('contact');
$title = $contact['title'];
$lead_text = $contact['lead_text'];
$description = $contact['description'];
$phone = $contact['phone'];
$form_shortcode = $contact['form_shortcode'];
?>

<section id="<?php echo $section_id ?>" class="" style="<?php echo $section_style ?>">

  <div class="relative container max-w-screen-xl mx-auto <?php echo $section_padding_top . ' ' . $section_padding_bottom ?>">
    <?php if ($title) : ?>
      <div class="flex gap-x-6 mb-12">
        <h2 class="flex-none text-4xl font-bold text-black"><?php echo $title ?></h2>
        <div class="border-b border-solid border-slate-400 w-full">&nbsp;</div>
      </div>
    <?php endif; ?>
    <div class="flex flex-col gap-y-8 lg:gap-y-0 lg:gap-x-16 lg:flex-row lg:flex-nowrap">
      <div class="w-1/2">
        <?php if ($lead_text) : ?>
          <div class="text-2xl font-medium mb-8 mt-0">
            <?php echo $lead_text ?>
          </div>
        <?php endif; ?>
        <?php if ($description) : ?>
          <div class="prose xl:prose-lg">
            <?php echo $description ?>
          </div>
        <?php endif; ?>
        <?php if ($phone) : ?>
          <div class="mt-10 flex flex-col gap-6">
            <?php foreach ($phone as $info) : ?>
              <div class="flex gap-x-6 items-center">
                <div class="float-none">
                  <?php echo smc_icon(array('icon' => 'line-phone', 'group' => 'utilities', 'size' => '40', 'class' => '')); ?>
                </div>
                <div>
                  <?php if ($info['title']) : ?>
                    <div class="font-bold text-xl"><?php echo $info['title'] ?></div>
                  <?php endif; ?>
                  <?php if ($info['phone_number']) : ?>
                    <div class="text-xl text-slate-600"><a href="<?php echo $info['phone_number']['url'] ?>" target="<?php echo $info['phone_number']['target'] ?>" class="text-xl text-slate-600 hover:underline"><?php echo $info['phone_number']['title'] ?></a></div>
                  <?php endif; ?>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </div>
      <div class="w-1/2">
        <?php if ($form_shortcode) : ?>
          <?php echo do_shortcode($form_shortcode) ?>
        <?php else : ?>
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
        <?php endif; ?>
      </div>
    </div>
  </div>

</section>