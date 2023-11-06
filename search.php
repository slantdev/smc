<?php

get_header();

// $s = get_search_query();
// $args = array(
//   's' => $s
// );

global $post;
$search_query = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : null;
$search_page  = isset($_GET['swppg']) ? absint($_GET['swppg']) : 1;

$search_results    = [];
$search_pagination = '';
if (!empty($search_query) && class_exists('\\SearchWP\\Query')) {
  $searchwp_query = new \SearchWP\Query($search_query, [
    'engine' => 'default', // The Engine name.
    'fields' => 'all',          // Load proper native objects of each result.
    'page'   => $search_page,
  ]);

  $search_results = $searchwp_query->get_results();

  $search_pagination = paginate_links(array(
    'format'  => '?swppg=%#%',
    'current' => $search_page,
    'total'   => $searchwp_query->max_num_pages,
  ));
}
?>

<section class="relative bg-[#232C39]">
  <div class="container max-w-screen-xl relative z-10 pt-52 lg:pt-[200px] 2xl:pt-[158px] h-full">
    <div class="flex flex-col md:flex-row h-full items-center text-white py-16 lg:py-24">
      <div class="w-full lg:w-1/2">
        <h1 class="font-bold text-[40px] lg:text-[50px] leading-tight">Search Results : <?php echo $search_query ?></h1>
      </div>
    </div>
  </div>
</section>


<section class="relative">
  <div class="container mx-auto max-w-4xl relative py-16 lg:py-24">
    <ul class="search-results">
      <?php
      if (!empty($search_query) && !empty($search_results)) :
      ?>
        <?php foreach ($search_results as $search_result) : ?>
          <?php
          //preint_r($search_result);
          $post = $search_result;
          $show_post = TRUE;
          $post_type = $post->post_type;
          //echo $post_type;
          if ($post_type == 'whats-on') {
            $id = $post->ID;
          } elseif ($post_type == 'report') {
            $id = $post->ID;
            $report_pdf = get_field('report_pdf', $id);
            $external_link_report = get_field('external_link_report', $id);
            $target = '_blank';
            if ($report_pdf) {
              $link = $report_pdf['url'];
            } elseif ($external_link_report) {
              $link = $external_link_report;
            } else {
              $show_post = FALSE;
            }
          } elseif ($post_type == 'policy') {
            $id = $post->ID;
            $policy_pdf = get_field('policy_pdf', $id);
            $external_link_policy = get_field('external_link_policy', $id);
            $target = '_blank';
            if ($policy_pdf) {
              $link = $policy_pdf['url'];
            } elseif ($external_link_policy) {
              $link = $external_link_policy;
            } else {
              $show_post = FALSE;
            }
          } else {
            $link = get_the_permalink();
            $target = '_self';
          }
          ?>
          <li class="mb-4 lg:mb-8">
            <?php
            if ($post_type == 'whats-on') :
              $id = $post->ID;
              $custom_link = get_field('custom_link', $id);
              $content = get_the_excerpt();
              if ($custom_link) {
                echo '<a href="' . $custom_link['url'] . '" target="' . $custom_link['target'] . '" class="block bg-white shadow-md border border-gray-200 rounded-lg transition duration-300 hover:shadow-xl">';
              } else {
                echo '<div class="block bg-white shadow-md border border-gray-200 rounded-lg">';
              }
            ?>
              <div class="flex flex-wrap md:flex-nowrap">
                <div class="w-full p-4 lg:p-8">
                  <h4 class="font-medium text-sm mb-3 text-slate-500">WHAT'S ON</h4>
                  <h3 class="font-bold text-brand-bluedark text-xl lg:text-2xl"><?php the_title(); ?></h3>
                  <?php if ($content) : ?>
                    <div class="text-sm mt-2"><?php the_excerpt() ?></div>
                  <?php endif; ?>
                </div>
              </div>
              <?php
              if ($custom_link) {
                echo '</a>';
              } else {
                echo '</div>';
              }
              ?>
            <?php else :
              $link = get_the_permalink();
              $target = '_self';
              $content = get_the_excerpt();
            ?>
              <a href="<?php echo $link; ?>" target="<?php echo $target; ?>" class="block bg-white shadow-md border border-gray-200 rounded-lg transition duration-300 hover:shadow-xl">
                <div class="flex flex-wrap md:flex-nowrap">
                  <div class="w-full p-4 lg:p-8">
                    <?php if ($post_type == 'store') : ?>
                      <h4 class="font-medium text-sm mb-3 text-slate-500">STORES & SERVICES</h4>
                    <?php endif; ?>
                    <h3 class="font-bold text-brand-bluedark text-xl lg:text-2xl"><?php the_title(); ?></h3>
                    <?php if ($content) : ?>
                      <div class="text-sm mt-2"><?php the_excerpt() ?></div>
                    <?php endif; ?>
                  </div>
                </div>
              </a>
            <?php endif; ?>

          </li>
          <?php wp_reset_postdata(); ?>
        <?php endforeach; ?>
        <?php if ($searchwp_query->max_num_pages > 1) : ?>
          <div class="navigation pagination" role="navigation">
            <h2 class="screen-reader-text">Results navigation</h2>
            <div class="nav-links"><?php echo wp_kses_post($search_pagination); ?></div>
          </div>
        <?php endif; ?>

      <?php elseif (!empty($search_query)) : ?>
        <li class="mb-4 lg:mb-8">
          <div class="block bg-white shadow-md border border-gray-200 rounded-lg transition duration-300 hover:shadow-xl">
            <div class="w-full flex p-4 lg:p-8">
              <div class="text-center"><?php _e('Sorry, no posts matched your criteria.'); ?></div>
            </div>
          </div>
        </li>
      <?php endif; ?>
    </ul>
  </div>

</section>

<?php
get_footer();
