<?php
include get_template_directory() . '/template-parts/layouts/section_settings.php';

// Ensure a unique section ID exists for CSS targeting when no anchor is provided
if (empty($section_id)) {
  $section_id = uniqid('section-');
}

/*
 * Available section variables
 * $section_id
 * $section_style
 * $section_padding_top
 * $section_padding_bottom
*/

$banner_image = get_sub_field('banner_image') ?: [];
$screens = $banner_image['screens'] ?? [];

// Helper functions to handle ACF image fields (array or ID)
$get_img_url = function ($img) {
  if (is_array($img) && isset($img['url'])) return esc_url($img['url']);
  if (is_numeric($img)) return esc_url(wp_get_attachment_image_url($img, 'full'));
  return '';
};

$get_img_alt = function ($img) {
  if (is_array($img) && !empty($img['alt'])) return esc_attr($img['alt']);
  if (is_numeric($img)) {
    $alt = get_post_meta($img, '_wp_attachment_image_alt', true);
    if (!empty($alt)) return esc_attr($alt);
  }
  return 'Banner default';
};

$picture_id = $section_id . '-picture';

// Extract images
$xl_image = empty($screens['xl_screen']['image']) ? false : $screens['xl_screen']['image'];
$lg_image = empty($screens['lg_screen']['image']) ? false : $screens['lg_screen']['image'];
$md_image = empty($screens['md_screen']['image']) ? false : $screens['md_screen']['image'];
$sm_image = empty($screens['sm_screen']['image']) ? false : $screens['sm_screen']['image'];

// Resolve missing screen images based on "closest size" logic (preferring larger images)
$inputs = [
  'sm' => $sm_image,
  'md' => $md_image,
  'lg' => $lg_image,
  'xl' => $xl_image
];

$keys = ['sm', 'md', 'lg', 'xl'];
$mapped = [];

foreach ($keys as $i => $key) {
  if (!empty($inputs[$key])) {
    $mapped[$key] = $inputs[$key];
    continue;
  }
  // Search upwards for the closest larger image
  $found = false;
  for ($j = $i + 1; $j < count($keys); $j++) {
    if (!empty($inputs[$keys[$j]])) {
      $mapped[$key] = $inputs[$keys[$j]];
      $found = true;
      break;
    }
  }
  if ($found) continue;
  // Search downwards for the closest smaller image
  for ($j = $i - 1; $j >= 0; $j--) {
    if (!empty($inputs[$keys[$j]])) {
      $mapped[$key] = $inputs[$keys[$j]];
      $found = true;
      break;
    }
  }
}

// Fallback image for the native <img> tag
$fallback_image = $mapped['sm'] ?? false;

?>

<section id="<?php echo esc_attr($section_id); ?>" class="relative" style="<?php echo esc_attr($section_style); ?>">
  <div class="relative <?php echo esc_attr("{$section_padding_top} {$section_padding_bottom}"); ?>">
    <div class="container mx-auto max-w-screen-xl">

      <?php if ($fallback_image) : ?>
        <picture id="<?php echo esc_attr($picture_id); ?>" class="block w-full overflow-hidden rounded-xl">
          <?php if ($get_img_url($mapped['xl']) !== $get_img_url($mapped['lg'])) : ?>
            <source media="(min-width: 1280px)" srcset="<?php echo $get_img_url($mapped['xl']); ?>">
          <?php endif; ?>

          <?php if ($get_img_url($mapped['lg']) !== $get_img_url($mapped['md'])) : ?>
            <source media="(min-width: 1024px)" srcset="<?php echo $get_img_url($mapped['lg']); ?>">
          <?php endif; ?>

          <?php if ($get_img_url($mapped['md']) !== $get_img_url($mapped['sm'])) : ?>
            <source media="(min-width: 768px)" srcset="<?php echo $get_img_url($mapped['md']); ?>">
          <?php endif; ?>

          <img src="<?php echo $get_img_url($fallback_image); ?>"
            alt="<?php echo $get_img_alt($fallback_image); ?>"
            class="block w-full h-auto">
        </picture>
      <?php endif; ?>

    </div>
  </div>
</section>