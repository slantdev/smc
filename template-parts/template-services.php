<?php

/**
 * Template Name: Services
 * Template Post Type: page
 *
 */

$store_category = '';
if (get_query_var('cat')) {
  $store_category = get_query_var('cat');
}

get_header();

$button_style = '';
$primary_color = get_field('primary_color', 'option');
if ($primary_color) {
  $button_style = 'color: white; background: ' . $primary_color;
  //$filter_button_style = 'color: ' . $primary_color;
  echo '<style>';
  echo '.store-filter-button:hover, .store-filter-button.button-active {
    color: ' . $primary_color . '
  }';
  echo '</style>';
}

get_template_part('template-parts/layouts/page-header', '', array('breadcrumbs' => false));
?>

<section class="relative pt-16 pb-12 lg:pt-24 lg:pb-16">
  <div class="container max-w-screen-xl">
    <div class="flex flex-col gap-y-4 lg:gap-y-0 lg:flex-row lg:gap-x-3">
      <div class="flex gap-x-3 w-full">
        <div class="flex-none flex items-center">
          <span class="text-3xl lg:text-4xl uppercase font-bold text-black">Categories</span>
        </div>
        <div class="border-b border-solid border-slate-500 w-full">&nbsp;</div>
      </div>
      <div class="flex-none">
        <form id="search-store" class="flex items-center h-14 pl-3 pr-1 rounded-full bg-[#F5F7F8] border border-[#95A7B5] shadow-inner">
          <input type="text" id="search-store-input" class="w-full lg:w-60 h-12 bg-transparent border-none rounded-l-full focus:border-none focus:ring-0 focus:outline-none" placeholder="Insert your query">
          <button type="submit" id="search-store-button" class="flex-none bg-black text-white py-3 px-8 rounded-full hover:opacity-70 transition" style="<?php echo $button_style ?>">SEARCH</button>
        </form>
      </div>
    </div>
    <div class="mt-10 relative px-4 lg:px-0">
      <?php
      $terms = get_terms(array(
        'taxonomy'   => 'store-category',
        'hide_empty' => false,
      ));
      //preint_r($terms);

      if ($terms) :
      ?>
        <div id="store-categories" class="swiper">
          <div class="swiper-wrapper">
            <?php foreach ($terms as $term) : ?>
              <?php
              $term_id = $term->term_id;
              $icon = get_field('svg_icon', $term->taxonomy . '_' . $term->term_id);
              ?>
              <div class="swiper-slide w-32 lg:w-[148px]">
                <button type="button" data-id="<?php echo $term_id ?>" data-slug="<?php echo $term->slug ?>" class="store-filter-button text-center flex flex-col items-center gap-y-3 mx-auto text-black transition">
                  <?php
                  if ($icon) {
                    echo smc_icon(array('icon_src' => $icon['id'], 'size' => '96', 'class' => 'w-16 h-16 lg:w-24 lg:h-24'));
                  }
                  ?>
                  <h5 class="text-sm lg:text-base uppercase font-bold leading-tight"><?php echo $term->name ?></h5>
                </button>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
        <div>
          <div class="store-categories--button-prev swiper-button-prev -left-4 lg:left-2 after:content-['prev'] after:text-2xl after:lg:text-[40px]"></div>
          <div class="store-categories--button-next swiper-button-next -right-4 lg:right-2 after:content-['next'] after:text-2xl after:lg:text-[40px]"></div>
        </div>
        <script>
          new Swiper('#store-categories', {
            loop: false,
            slidesPerView: "auto",
            spaceBetween: 0,
            watchOverflow: true,
            centerInsufficientSlides: true,
            navigation: {
              nextEl: '.store-categories--button-next',
              prevEl: '.store-categories--button-prev',
            }
          });
        </script>
      <?php endif; ?>
    </div>
  </div>
</section>
<section id="stores-container" class="relative bg-[#F4F4F2] pt-24 pb-24 scroll-m-16 lg:scroll-m-24">
  <div class="container max-w-screen-xl">
    <div class="mt-0">
      <div class="stores-container relative scroll-mt-36">
        <div class="stores-grid"></div>
        <div class="blocker absolute inset-0 bg-white bg-opacity-40" style="display: none;"></div>
      </div>
    </div>
    <script type="text/javascript">
      jQuery(document).ready(function($) {
        var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';

        var store_category = <?php echo ($store_category != "") ? $store_category : "''" ?>;
        if (store_category) {
          $('.store-filter-button').removeClass('button-active');
          $('.store-filter-button[data-id="' + store_category + '"]').addClass('button-active');
        }

        function load_all_stores(page) {
          $('.stores-container .blocker').show();
          var data = {
            page: page,
            per_page: '-1',
            category: <?php echo ($store_category != "") ? $store_category : "''" ?>,
            action: 'pagination_load_stores',
          };
          //console.log(data);
          $.post(ajaxurl, data, function(response) {
            //console.log(response);
            $('.stores-grid').html('').prepend(response);
            $('.stores-container .blocker').hide();
          });
        }
        load_all_stores(1);
        $(document).on(
          'click',
          '.ajax-pagination li.active',
          function() {
            $(".stores-container").get(0).scrollIntoView({
              behavior: 'smooth'
            });
            var page = $(this).data('page');
            load_all_stores(page);
          }
        );

        // Store Filter
        $(document).on(
          'click',
          '.store-filter-button',
          function(e) {
            e.preventDefault;
            let term_id = $(this).data('id');
            let term_slug = $(this).data('slug');
            //console.log(term_id, term_slug);
            $('.store-filter-button').removeClass('button-active');
            $(this).addClass('button-active');

            var newURL = location.href.split("?")[0];
            window.history.pushState('object', document.title, newURL);

            $.ajax({
              type: 'POST',
              url: '/wp-admin/admin-ajax.php',
              dataType: 'html',
              data: {
                action: 'filter_stores',
                filter: term_id,
              },
              beforeSend: function() {
                // $('#posts-search-button .spinner-border')
                //   .removeClass('opacity-0')
                //   .addClass('opacity-100');
                $('.stores-container .blocker').show();
              },
              success: function(res) {
                $('.stores-container .blocker').hide();
                $('.stores-grid').html(res);
                // $('#posts-search-button .spinner-border')
                //   .removeClass('opacity-100')
                //   .addClass('opacity-0');
              },
            });
          }
        );
      });
    </script>
  </div>
</section>

<?php get_template_part('template-parts/page', 'builder'); ?>

<script>
  jQuery(function($) {
    $('#search-store').on('submit', function(event) {
      event.preventDefault();
      let search_query = $('#search-store-input').val();
      $('.store-filter-button').removeClass('.button-active');

      $.ajax({
        type: 'POST',
        url: '/wp-admin/admin-ajax.php',
        dataType: 'html',
        data: {
          action: 'search_stores',
          search: search_query,
        },
        beforeSend: function() {
          $('.stores-container .blocker').show();
        },
        success: function(res) {
          document.getElementById("stores-container").scrollIntoView({
            behavior: "smooth"
          })
          $('.stores-grid').html(res);
          $('.stores-container .blocker').hide();
        },
      });
    });
  });
</script>

<?php get_footer(); ?>