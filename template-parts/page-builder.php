<?php
$term_id = get_queried_object()->term_id;
if ($term_id) {
  $the_id = 'term_' . $term_id;
} else {
  $the_id = get_the_ID();
}

if (have_rows('section', $the_id)) :

  // Loop through rows.
  while (have_rows('section', $the_id)) : the_row();

    if (get_row_layout() == 'image_text') :
      get_template_part('template-parts/sections/image_text');

    elseif (get_row_layout() == 'hero_slider') :
      get_template_part('template-parts/sections/hero_slider');

    elseif (get_row_layout() == 'whats_on') :
      get_template_part('template-parts/sections/whats_on');

    elseif (get_row_layout() == 'stores_services_grid') :
      get_template_part('template-parts/sections/stores_services_grid');

    elseif (get_row_layout() == 'subscribe') :
      get_template_part('template-parts/sections/subscribe');

    elseif (get_row_layout() == 'logo_carousel') :
      get_template_part('template-parts/sections/logo_carousel');

    elseif (get_row_layout() == 'location') :
      get_template_part('template-parts/sections/location');

    endif;

  // End loop.
  endwhile;

// No value.
else :
// Do something...
endif;
