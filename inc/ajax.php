<?php

/* ###### Ajax function for pagination ###### */
add_action('wp_ajax_pagination_load_stores', 'pagination_load_stores');
add_action('wp_ajax_nopriv_pagination_load_stores', 'pagination_load_stores');
function pagination_load_stores()
{
  global $wpdb;
  // Set default variables
  $msg = '';
  if (isset($_POST['page'])) {
    // Sanitize the received page
    $page = sanitize_text_field($_POST['page']);
    $per_page = sanitize_text_field($_POST['per_page']);
    $category = sanitize_text_field($_POST['category']);
    $cur_page = $page;
    $page -= 1;
    $previous_btn = true;
    $next_btn = true;
    $first_btn = true;
    $last_btn = true;
    $start = $page * $per_page;

    $central_stores = new WP_Query(
      array(
        'post_type'         => 'store',
        'post_status '      => 'publish',
        'orderby'           => 'menu_order',
        'order'             => 'ASC',
        'posts_per_page'    => $per_page,
        'offset'            => $start,
        'tax_query' => array(
          array(
            'taxonomy' => 'store-area',
            'field' => 'slug',
            'terms' => 'central',
          ),
        ),
      )
    );

    $market_street_stores = new WP_Query(
      array(
        'post_type'         => 'store',
        'post_status '      => 'publish',
        'orderby'           => 'menu_order',
        'order'             => 'ASC',
        'posts_per_page'    => $per_page,
        'offset'            => $start,
        'tax_query' => array(
          array(
            'taxonomy' => 'store-area',
            'field' => 'slug',
            'terms' => 'market-street',
          ),
        ),
      )
    );

    if ($category) {
      $central_stores = new WP_Query(
        array(
          'post_type'         => 'store',
          'post_status '      => 'publish',
          'orderby'           => 'menu_order',
          'order'             => 'ASC',
          'posts_per_page'    => $per_page,
          'offset'            => $start,
          'tax_query' => array(
            'relation' => 'AND',
            array(
              'taxonomy' => 'store-area',
              'field' => 'slug',
              'terms' => 'central',
            ),
            array(
              'taxonomy' => 'store-category',
              'field' => 'id',
              'terms' => $category,
            ),
          )
        )
      );
      $market_street_stores = new WP_Query(
        array(
          'post_type'         => 'store',
          'post_status '      => 'publish',
          'orderby'           => 'menu_order',
          'order'             => 'ASC',
          'posts_per_page'    => $per_page,
          'offset'            => $start,
          'tax_query' => array(
            'relation' => 'AND',
            array(
              'taxonomy' => 'store-area',
              'field' => 'slug',
              'terms' => 'market-street',
            ),
            array(
              'taxonomy' => 'store-category',
              'field' => 'id',
              'terms' => $category,
            ),
          ),
        )
      );
    }

    $count = new WP_Query(
      array(
        'post_type'         => 'store',
        'post_status '      => 'publish',
        'posts_per_page'    => -1
      )
    );

    $count = $count->post_count;

    if ($central_stores->have_posts()) :
      echo '<div class="flex gap-x-4 lg:gap-x-6 mb-8 lg:mb-12">
        <h2 class="md:flex-none text-3xl lg:text-4xl font-bold text-black">South Melbourne Central</h2>
        <div class="hidden md:block border-b border-solid border-slate-400 w-full">&nbsp;</div>
      </div>';
      echo '<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-6 lg:gap-8">';
      while ($central_stores->have_posts()) :
        $central_stores->the_post(); ?>
        <?php
        $id = get_the_ID();
        $img_src = get_the_post_thumbnail_url($id, 'large');
        $title =  get_the_title();
        $link = get_the_permalink();
        $location = get_the_terms($id, 'store-location')[0]->name;
        $phone = get_field('contact_info', $id)['phone'];
        ?>
        <a href="<?php echo $link ?>" class="border border-[#CECECE] bg-white rounded-2xl overflow-hidden shadow-[0_3px_6px_rgba(0,0,0,0.16)] flex flex-col p-8 hover:-translate-y-1 hover:shadow-[0_3px_12px_rgba(0,0,0,0.24)] transition-all duration-500 ease-in-out">
          <div class="aspect-w-6 aspect-h-4">
            <img src="<?php echo $img_src ?>" alt="" class="object-contain h-full w-full">
          </div>
          <div class="flex flex-col grow border-t border-slate-300">
            <h3 class="text-xl font-bold py-6 text-black"><?php echo $title ?></h3>
            <div class="mt-auto flex flex-col gap-2">
              <?php if ($location) : ?>
                <div class="flex gap-x-4">
                  <div class="flex-none"><?php echo smc_icon(array('icon' => 'line-marker', 'group' => 'utilities', 'size' => '24', 'class' => 'text-black')); ?></div>
                  <div>Located on <span class="uppercase"><?php echo $location ?></span></div>
                </div>
              <?php endif; ?>
              <?php if ($phone) : ?>
                <div class="flex gap-x-4">
                  <div class="flex-none"><?php echo smc_icon(array('icon' => 'line-phone', 'group' => 'utilities', 'size' => '24', 'class' => 'text-black')); ?></div>
                  <div><?php echo $phone ?></div>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </a>
      <?php
      endwhile;
      echo '</div>';
    endif;

    wp_reset_postdata();

    if ($market_street_stores->have_posts()) :
      echo '<div class="mt-24"></div>';
      echo '<div class="flex gap-x-4 lg:gap-x-6 mb-8 lg:mb-12">
      <h2 class="md:flex-none text-3xl lg:text-4xl font-bold text-black">South Melbourne - Market Street</h2>
      <div class="hidden md:block border-b border-solid border-slate-400 w-full">&nbsp;</div>
    </div>';
      echo '<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-6 lg:gap-8">';
      while ($market_street_stores->have_posts()) :
        $market_street_stores->the_post(); ?>
        <?php
        $id = get_the_ID();
        $img_src = get_the_post_thumbnail_url($id, 'large');
        $title =  get_the_title();
        $link = get_the_permalink();
        $location = get_the_terms($id, 'store-location')[0]->name;
        $phone = get_field('contact_info', $id)['phone'];
        ?>
        <a href="<?php echo $link ?>" class="border border-[#CECECE] bg-white rounded-2xl overflow-hidden shadow-[0_3px_6px_rgba(0,0,0,0.16)] flex flex-col p-8 hover:-translate-y-1 hover:shadow-[0_3px_12px_rgba(0,0,0,0.24)] transition-all duration-500 ease-in-out">
          <div class="aspect-w-6 aspect-h-4">
            <img src="<?php echo $img_src ?>" alt="" class="object-contain h-full w-full">
          </div>
          <div class="flex flex-col grow border-t border-slate-300">
            <h3 class="text-xl font-bold py-6 text-black"><?php echo $title ?></h3>
            <div class="mt-auto flex flex-col gap-2">
              <?php if ($location) : ?>
                <div class="flex gap-x-4">
                  <div class="flex-none"><?php echo smc_icon(array('icon' => 'line-marker', 'group' => 'utilities', 'size' => '24', 'class' => 'text-black')); ?></div>
                  <div>Located on <span class="uppercase"><?php echo $location ?></span></div>
                </div>
              <?php endif; ?>
              <?php if ($phone) : ?>
                <div class="flex gap-x-4">
                  <div class="flex-none"><?php echo smc_icon(array('icon' => 'line-phone', 'group' => 'utilities', 'size' => '24', 'class' => 'text-black')); ?></div>
                  <div><?php echo $phone ?></div>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </a>
    <?php
      endwhile;
      echo '</div>';
    endif;

    wp_reset_postdata();


    if (!$central_stores->have_posts() && !$market_street_stores->have_posts()) {
      echo '<div class="text-center py-4 px-8">No Store Found</div>';
    }

    // Paginations
    $no_of_paginations = ceil($count / $per_page);
    if ($cur_page >= 7) {
      $start_loop = $cur_page - 3;
      if ($no_of_paginations > $cur_page + 3)
        $end_loop = $cur_page + 3;
      else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6) {
        $start_loop = $no_of_paginations - 6;
        $end_loop = $no_of_paginations;
      } else {
        $end_loop = $no_of_paginations;
      }
    } else {
      $start_loop = 1;
      if ($no_of_paginations > 7)
        $end_loop = 7;
      else
        $end_loop = $no_of_paginations;
    }
    // Pagination Buttons logic
    ?>
    <?php if ($no_of_paginations > 1) : ?>
      <div class='ajax-pagination mt-12'>
        <ul>
          <?php
          if ($first_btn && $cur_page > 1) { ?>
            <li data-page='1' class='active text-xl'>
              &laquo;</li>
          <?php
          } else if ($first_btn) { ?>
            <li data-page='1' class='inactive text-xl'>
              &laquo;</li>
          <?php
          }
          if ($previous_btn && $cur_page > 1) {
            $pre = $cur_page - 1; ?>
            <li data-page='<?php echo $pre; ?>' class='active text-xl'>
              &lsaquo;</li>
          <?php
          } else if ($previous_btn) { ?>
            <li class='inactive p-2 text-xl'>
              &lsaquo;</li>
            <?php
          }
          for ($i = $start_loop; $i <= $end_loop; $i++) {
            if ($cur_page == $i) { ?>
              <li data-page='<?php echo $i; ?>' class='selected'><?php echo $i; ?></li>
            <?php
            } else { ?>
              <li data-page='<?php echo $i; ?>' class='active'><?php echo $i; ?></li>
            <?php
            }
          }
          if ($next_btn && $cur_page < $no_of_paginations) {
            $nex = $cur_page + 1; ?>
            <li data-page='<?php echo $nex; ?>' class='active text-xl'>&rsaquo;</li>
          <?php
          } else if ($next_btn) { ?>
            <li class='inactive text-xl'>&rsaquo;</li>
          <?php
          }

          if ($last_btn && $cur_page < $no_of_paginations) { ?>
            <li data-page='<?php echo $no_of_paginations; ?>' class='active text-xl'>&raquo;</li>
          <?php
          } else if ($last_btn) { ?>
            <li data-page='<?php echo $no_of_paginations; ?>' class='inactive text-xl'>&raquo;</li>
          <?php
          } ?>
        </ul>
      </div>
    <?php endif; ?>
<?php
  }
  exit();
}

add_action('wp_ajax_filter_stores', 'filter_stores');
add_action('wp_ajax_nopriv_filter_stores', 'filter_stores');
function filter_stores()
{
  //$search_query = $_POST['query'];
  $category_filter = $_POST['filter'];
  if (isset($_POST['postsperpage'])) {
    $postsPerPage = $_POST['postsperpage'];
  } else {
    $postsPerPage = -1;
  }

  // if ($search_query) {
  //   if ($category_filter == 'all') {
  //     $args = array(
  //       'post_type' => 'store',
  //       'posts_per_page' => $postsPerPage,
  //       'orderby' => 'menu_order',
  //       'order' => 'ASC',
  //       's' => $search_query,
  //       'post_status' => 'publish',
  //     );
  //   } else {
  //     $args = array(
  //       'post_type' => 'store',
  //       'posts_per_page' => $postsPerPage,
  //       'orderby' => 'menu_order',
  //       'order' => 'ASC',
  //       's' => $search_query,
  //       'post_status' => 'publish',
  //       'tax_query' => array(
  //         array(
  //           'taxonomy' => 'store-category',
  //           'field'    => 'term_id',
  //           'terms'    => $category_filter,
  //         ),
  //       ),
  //     );
  //   }
  // } else {
  //   if ($category_filter == 'all') {
  //     $args = array(
  //       'post_type' => 'store',
  //       'posts_per_page' => $postsPerPage,
  //       'orderby' => 'menu_order',
  //       'order' => 'ASC',
  //       'post_status' => 'publish',
  //     );
  //   } else {
  //     $args = array(
  //       'post_type' => 'store',
  //       'posts_per_page' => $postsPerPage,
  //       'orderby' => 'menu_order',
  //       'order' => 'ASC',
  //       'post_status' => 'publish',
  //       'tax_query' => array(
  //         array(
  //           'taxonomy' => 'store-category',
  //           'field'    => 'term_id',
  //           'terms'    => $category_filter,
  //         ),
  //       ),
  //     );
  //   }
  // }

  $central_stores = new WP_Query(
    array(
      'post_type' => 'store',
      'posts_per_page' => $postsPerPage,
      'orderby' => 'menu_order',
      'order' => 'ASC',
      'post_status' => 'publish',
      'tax_query' => array(
        'relation' => 'AND',
        array(
          'taxonomy' => 'store-category',
          'field'    => 'term_id',
          'terms'    => $category_filter,
        ),
        array(
          'taxonomy' => 'store-area',
          'field' => 'slug',
          'terms' => 'central',
        ),
      ),
    )
  );

  $response = '';

  if ($central_stores->have_posts()) {

    $response .= '<div class="flex gap-x-6 mb-12">
        <h2 class="flex-none text-4xl font-bold text-black">South Melbourne Central</h2>
        <div class="border-b border-solid border-slate-400 w-full">&nbsp;</div>
      </div>';

    $response .= '<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 lg:gap-8">';

    while ($central_stores->have_posts()) : $central_stores->the_post();

      $id = get_the_ID();
      $img_src = get_the_post_thumbnail_url($id, 'large');
      $title =  get_the_title();
      $link = get_the_permalink();
      $location = get_the_terms($id, 'store-location')[0]->name;
      $phone = get_field('contact_info', $id)['phone'];

      $response .= '<a href="' . $link . '" class="border border-[#CECECE] bg-white rounded-2xl overflow-hidden shadow-[0_3px_6px_rgba(0,0,0,0.16)] flex flex-col p-8 hover:-translate-y-1 hover:shadow-[0_3px_12px_rgba(0,0,0,0.24)] transition-all duration-500 ease-in-out">
                <div class="aspect-w-6 aspect-h-4">
                  <img src="' . $img_src . '" alt="" class="object-contain h-full w-full">
                </div>
                <div class="flex flex-col grow border-t border-slate-300">
                  <h3 class="text-xl font-bold py-6 text-black">' . $title . '</h3>
                  <div class="mt-auto flex flex-col gap-2">';
      if ($location) {
        $response .= '<div class="flex gap-x-4">
                        <div class="flex-none">' . smc_icon(array('icon' => 'line-marker', 'group' => 'utilities', 'size' => '24', 'class' => 'text-black')) . '</div>
                        <div>Located on <span class="uppercase">' . $location . '</span></div>
                      </div>';
      }
      if ($phone) {
        $response .= '<div class="flex gap-x-4">
                        <div class="flex-none">' . smc_icon(array('icon' => 'line-phone', 'group' => 'utilities', 'size' => '24', 'class' => 'text-black')) . '</div>
                        <div>' . $phone . '</div>
                      </div>';
      }
      $response .= '</div>
                </div>
              </a>';

    endwhile;

    $response .= '</div>';

    $response .= '<div class="mt-24"></div>';
    //$response .= '<div class="blocker absolute inset-0 bg-white bg-opacity-40" style="display: none;"></div>';
  } else {
    //$response = '<div class="text-center py-4 px-8">No Store Found</div>';
  }

  //echo $response;

  //wp_reset_postdata();

  $market_street_stores = new WP_Query(
    array(
      'post_type' => 'store',
      'posts_per_page' => $postsPerPage,
      'orderby' => 'menu_order',
      'order' => 'ASC',
      'post_status' => 'publish',
      'tax_query' => array(
        'relation' => 'AND',
        array(
          'taxonomy' => 'store-category',
          'field'    => 'term_id',
          'terms'    => $category_filter,
        ),
        array(
          'taxonomy' => 'store-area',
          'field' => 'slug',
          'terms' => 'market-street',
        ),
      ),
    )
  );

  if ($market_street_stores->have_posts()) {
    $response .= '<div class="mt-24"></div>';
    $response .= '<div class="flex gap-x-6 mb-12">
        <h2 class="flex-none text-4xl font-bold text-black">South Melbourne - Market Street</h2>
        <div class="border-b border-solid border-slate-400 w-full">&nbsp;</div>
      </div>';

    $response .= '<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 lg:gap-8">';

    while ($market_street_stores->have_posts()) : $market_street_stores->the_post();

      $id = get_the_ID();
      $img_src = get_the_post_thumbnail_url($id, 'large');
      $title =  get_the_title();
      $link = get_the_permalink();
      $location = get_the_terms($id, 'store-location')[0]->name;
      $phone = get_field('contact_info', $id)['phone'];

      $response .= '<a href="' . $link . '" class="border border-[#CECECE] bg-white rounded-2xl overflow-hidden shadow-[0_3px_6px_rgba(0,0,0,0.16)] flex flex-col p-8 hover:-translate-y-1 hover:shadow-[0_3px_12px_rgba(0,0,0,0.24)] transition-all duration-500 ease-in-out">
                <div class="aspect-w-6 aspect-h-4">
                  <img src="' . $img_src . '" alt="" class="object-contain h-full w-full">
                </div>
                <div class="flex flex-col grow border-t border-slate-300">
                  <h3 class="text-xl font-bold py-6 text-black">' . $title . '</h3>
                  <div class="mt-auto flex flex-col gap-2">';
      if ($location) {
        $response .= '<div class="flex gap-x-4">
                        <div class="flex-none">' . smc_icon(array('icon' => 'line-marker', 'group' => 'utilities', 'size' => '24', 'class' => 'text-black')) . '</div>
                        <div>Located on <span class="uppercase">' . $location . '</span></div>
                      </div>';
      }
      if ($phone) {
        $response .= '<div class="flex gap-x-4">
                        <div class="flex-none">' . smc_icon(array('icon' => 'line-phone', 'group' => 'utilities', 'size' => '24', 'class' => 'text-black')) . '</div>
                        <div>' . $phone . '</div>
                      </div>';
      }
      $response .= '</div>
                </div>
              </a>';

    endwhile;

    $response .= '</div>';
    //$response .= '<div class="blocker absolute inset-0 bg-white bg-opacity-40" style="display: none;"></div>';
  } else {
    //$response = '<div class="text-center py-4 px-8">No Store Found</div>';
  }

  wp_reset_postdata();

  if (!$central_stores->have_posts() && !$market_street_stores->have_posts()) {
    $response = '<div class="text-center py-4 px-8">No Store Found</div>';
  }

  echo $response;

  exit;
}
