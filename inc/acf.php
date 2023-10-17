<?php

acf_add_options_page(array(
  'menu_slug' => 'site_settings',
  'page_title' => 'Site Settings',
  'active' => true,
  'menu_title' => 'Site Settings',
  'capability' => 'edit_posts',
  'parent_slug' => '',
  'position' => '',
  'icon_url' => '',
  'redirect' => true,
  'post_id' => 'options',
  'autoload' => false,
  'update_button' => 'Update',
  'updated_message' => 'Options Updated',
));

acf_add_options_page(array(
  'menu_slug' => 'theme_settings',
  'page_title' => 'Theme Settings',
  'active' => true,
  'menu_title' => 'Theme Settings',
  'capability' => 'edit_posts',
  'parent_slug' => 'site_settings',
  'position' => '',
  'icon_url' => '',
  'redirect' => true,
  'post_id' => 'options',
  'autoload' => false,
  'update_button' => 'Update',
  'updated_message' => 'Options Updated',
));


/*
 * Add color picker pallete on admin
 */
function smc_acf_input_admin_footer()
{

  $primary_palette_array = [];
  $primary_color = get_field('primary_color', 'option');
  if ($primary_color) {
    array_push($primary_palette_array, $primary_color);
  }
  $secondary_color = get_field('secondary_color', 'option');
  if ($secondary_color) {
    array_push($primary_palette_array, $secondary_color);
  }
  $tertiary_color = get_field('tertiary_color', 'option');
  if ($tertiary_color) {
    array_push($primary_palette_array, $tertiary_color);
  }
  $body_text_color = get_field('body_text_color', 'option');
  if ($body_text_color) {
    array_push($primary_palette_array, $body_text_color);
  }
  $primary_palette = '';
  //preint_r($primary_palette_array);
  if ($primary_palette_array) {
    $primary_palette = implode("', '", $primary_palette_array);
  }

  $additional_color_array = [];
  $additional_color = get_field('additional_color', 'option');
  if ($additional_color) {
    foreach ($additional_color as $color) {
      //echo $color;
      array_push($additional_color_array, $color['color']);
    }
  }
  $additional_palette = '';
  //preint_r($additional_color_array);
  if ($additional_color_array) {
    $additional_palette = implode("', '", $additional_color_array);
  }

?>
  <script type="text/javascript">
    (function($) {

      acf.add_filter('color_picker_args', function(args, $field) {

        args.palettes = ['#000000', '#FFFFFF', '<?php echo $primary_palette ?>', '<?php echo $additional_palette ?>']

        return args;

      });

    })(jQuery);
  </script>
<?php
}
add_action('acf/input/admin_footer', 'smc_acf_input_admin_footer');

/*
 * ACF Icon Picker
 * Modify the path to the icons directory
 * https://github.com/houke/acf-icon-picker
 */
add_filter('acf_icon_path_suffix', 'acf_icon_path_suffix');
function acf_icon_path_suffix($path_suffix)
{
  return 'assets/icons/content/';
}

/*
 * ACF Extended Layout Thumbnails
 * https://www.acf-extended.com/features/fields/flexible-content/advanced-settings
 * @int/string  $thumbnail  Thumbnail ID/URL
 * @array       $field      Field settings
 * @array       $layout     Layout settings
 */
//add_filter('acfe/flexible/thumbnail/layout=accordion', 'accordion_layout_thumbnail', 10, 3);
function accordion_layout_thumbnail($thumbnail, $field, $layout)
{
  return get_stylesheet_directory_uri() . '/assets/images/layouts/accordion.jpg';
}
