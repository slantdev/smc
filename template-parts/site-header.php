<header class="site-header fixed w-full top-0 left-0 right-0 z-50">
  <?php
  $top_navigation = get_field('top_navigation', 'option')['top_navigation'];
  $top_nav_colors = $top_navigation['colors'];

  $top_nav_style = '';
  $social_link_style = '';

  $top_nav_bg_color = $top_nav_colors['background_color'];
  if ($top_nav_bg_color) {
    $top_nav_style .= " background-color: " . $top_nav_bg_color . "; ";
  }
  $top_nav_text_color = $top_nav_colors['text_color'];
  if ($top_nav_text_color) {
    $top_nav_style .= " color: " . $top_nav_text_color . "; ";
    $social_link_style .= " color: " . $top_nav_text_color . "; ";
  }

  $top_nav_social_links = $top_navigation['social_links'];
  if ($top_nav_social_links) :
  ?>
    <div id="top-nav" class="hidden md:block" style="<?php echo $top_nav_style ?>">
      <div class="top-nav--container max-w-screen-4xl mx-auto px-4 py-2 md:px-6 xl:px-8">
        <div class="hidden lg:flex justify-end">
          <ul class="top-nav--ul flex gap-x-4">
            <?php foreach ($top_nav_social_links as $social) : ?>
              <?php
              $social_icon = $social['select_social_links'];
              $social_title = $social['social_link']['title'];
              $social_url = $social['social_link']['url'];
              $social_target = $social['social_link']['target'];
              ?>
              <?php if ($social_url) : ?>
                <li><a href="<?php echo $social_url ?>" title="<?php echo $social_title ?>" target="<?php echo $social_target ?>" style="<?php echo $social_link_style ?>"><?php echo smc_icon(array('icon' => $social_icon, 'group' => 'social', 'size' => '24', 'class' => '')); ?></a></li>
              <?php endif; ?>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    </div>
  <?php endif; ?>

  <?php
  $main_navigation = get_field('main_navigation', 'option')['main_navigation'];
  $main_nav_colors = $main_navigation['colors'];
  $main_nav_site_logo = $main_navigation['site_logo'];

  $main_nav_style = '';
  $main_nav_bg_color = $main_nav_colors['background_color'];
  if ($main_nav_bg_color) {
    $main_nav_style .= " background-color: " . $main_nav_bg_color . "; ";
  }
  $main_nav_text_color = $main_nav_colors['text_color'];
  if ($top_nav_text_color) {
    $main_nav_style .= " color: " . $main_nav_text_color . "; ";
  }

  ?>
  <div id="main-nav" class="py-2 md:py-3 xl:pt-3 xl:pb-0 2xl:pt-6 transition duration-300" style="<?php echo $main_nav_style ?>">
    <div class="max-w-screen-4xl mx-auto px-4 md:px-6 xl:px-8">
      <div class="flex justify-between items-center gap-x-4">
        <?php if ($main_nav_site_logo['logo_white']) : ?>
          <a id="logo" href="<?php echo get_site_url() ?>" class="block relative z-50 lg:pb-3">
            <img src="<?php echo $main_nav_site_logo['logo_white']['url'] ?>" alt="<?php echo get_bloginfo('name') ?>" class="h-7 lg:h-[38px] 2xl:h-11 w-auto max-w-none">
          </a>
        <?php else : ?>
          <a id="logo" href="<?php echo get_site_url() ?>" class="block relative z-50">
            <?php echo get_bloginfo('name') ?>
          </a>
        <?php endif; ?>
        <div class="hidden xl:flex justify-end items-center gap-x-3 4xl:gap-x-8">
          <?php get_template_part('template-parts/components/megamenu'); ?>
          <div class="relative">
            <?php
            $search_icon_color = $main_nav_bg_color;
            $search_icon_style = '';
            if ($search_icon_color) {
              $search_icon_style = ' color: ' . $search_icon_color . '; ';
            }
            ?>
            <button id="header-search-button" class="p-2.5 2xl:p-4 rounded-full bg-white hover:bg-opacity-80" style="<?php echo $search_icon_style ?>"><?php echo smc_icon(array('icon' => 'search', 'group' => 'utilities', 'size' => '24', 'class' => 'h-5 w-5 2xl:h-6 2xl:w-6')); ?></button>
            <div id="header-search" class="absolute right-0 top-0 transition-all duration-300">
              <form id="header-searchform" class="flex bg-white shadow-lg rounded-full" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                <input id="searchform-input" type="text" class="text-gray-700 px-6 rounded-full py-2 w-full bg-transparent border-transparent focus:outline-none focus:border-transparent focus:ring-0" name="s" placeholder="Search" value="<?php echo get_search_query(); ?>">
                <button style="<?php echo $search_icon_style ?>" class="flex-none p-4 flex items-center justify-center text-sm rounded-full font-semibold bg-white hover:bg-opacity-80 whitespace-nowrap cursor-pointer" type="submit">
                  <?php echo smc_icon(array('icon' => 'search', 'group' => 'utilities', 'size' => '24', 'class' => '')); ?>
                </button>
              </form>
            </div>
          </div>
        </div>
        <button type="button" id="mobilemenu-open" class="p-2 text-white xl:hidden">
          <svg class="w-8 h-8" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M3 6H21V8H3V6ZM3 11H21V13H3V11ZM3 16H21V18H3V16Z" fill="currentColor" />
          </svg>
        </button>
      </div>
    </div>
  </div>
</header>

<?php get_template_part('template-parts/components/mobilemenu'); ?>