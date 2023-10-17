<?php
?>
<div id="mobilemenu" class="h-screen w-[300px] bg-black fixed top-0 right-0 pl-8 pr-2 pt-16 pb-20 z-50 translate-x-full transition duration-300 ease-in-out">
  <button id="mobilemenu-close" type="button" class="absolute top-2 right-2 text-white/70 hover:text-white transition duration-200">
    <svg class="w-8 h-8" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M6.4 19L5 17.6L10.6 12L5 6.4L6.4 5L12 10.6L17.6 5L19 6.4L13.4 12L19 17.6L17.6 19L12 13.4L6.4 19Z" fill="currentColor" />
    </svg>
  </button>
  <div class="h-full overflow-y-auto">
    <div class="">
      <?php
      $menu_items = get_field('menu_items', 'option');
      //preint_r($menu_items);
      if ($menu_items) :
      ?>
        <ul class="flex flex-col gap-8 pr-6">
          <?php foreach ($menu_items as $menu_id => $menu) : ?>
            <?php
            $menu_item = $menu['menu_item'];
            $has_megamenu = $menu['has_megamenu'];
            $megamenu_items = $menu['megamenu_items'];
            $li_class = '';
            if ($has_megamenu && $megamenu_items) {
              $li_class = '';
            }
            if ($menu_item) :
            ?>
              <li class="<?php echo $li_class ?>">
                <a href="<?php echo $menu_item['url'] ?>" target="<?php echo $menu_item['target'] ?>" class="inline-block text-white/80 hover:text-white font-medium uppercase whitespace-nowrap transition duration-300"><?php echo $menu_item['title'] ?></a>
                <?php if ($has_megamenu && $megamenu_items) : ?>
                  <div class="pl-4">
                    <div class="flex flex-col divide-y divide-white/30">
                      <?php
                      $menu_heading = $megamenu_items['menu_heading'];
                      $menu_description = $megamenu_items['menu_description'];
                      $submenu_items = $megamenu_items['submenu_items'];
                      ?>
                      <?php if ($submenu_items) : ?>
                        <ul class="flex flex-col divide-y divide-white/30 text-lg">
                          <?php foreach ($submenu_items as $submenu_id => $item) : ?>
                            <?php
                            $submenu_item = $item['submenu_item'];
                            ?>
                            <li class="py-3">
                              <a href="<?php echo $submenu_item['url'] ?>" class="text-white/80 hover:text-white inline-block text-base transition duration-300">
                                <span><?php echo $submenu_item['title'] ?></span>
                              </a>
                            </li>
                          <?php endforeach; ?>
                        </ul>
                      <?php endif; ?>
                    </div>
                  </div>
                <?php endif; ?>
              </li>
            <?php endif; ?>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
    </div>
  </div>

  <?php
  $links = get_field('top_navigation', 'option');
  $links = '';
  $social_links = get_field('top_navigation', 'option')['top_navigation']['social_links'];
  if ($social_links) :
  ?>
    <div class="absolute bottom-0 left-0 right-0 py-4 px-8">
      <div class="flex justify-center">
        <ul class="top-nav--ul flex gap-x-4">
          <?php foreach ($social_links as $link) : ?>
            <li><a class="text-white/70 hover:text-white" href="<?php echo $link['social_link']['url'] ?>" target="<?php echo $link['social_link']['target'] ?>"><?php echo smc_icon(array('icon' => $link['select_social_links'], 'group' => 'social', 'size' => '24', 'class' => '')); ?></a></li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  <?php endif; ?>

</div>
<div id="mobilemenu-overlay" tabindex="0" class="fixed inset-0 bg-black/80 z-40 invisible opacity-0 transition duration-300"></div>