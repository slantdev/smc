<?php
?>
<div class="main-nav--div flex gap-x-3 items-center 4xl:gap-x-8">
  <?php
  $menu_items = get_field('menu_items', 'option');
  //preint_r($menu_items);
  if ($menu_items) :
  ?>
    <ul class="main-nav--ul flex gap-x-0 3xl:gap-x-4">
      <?php foreach ($menu_items as $menu_id => $menu) : ?>
        <?php
        $menu_item = $menu['menu_item'];
        $has_megamenu = $menu['has_megamenu'];
        $megamenu_items = $menu['megamenu_items'];
        $li_class = '';
        if ($has_megamenu && $megamenu_items) {
          $li_class = 'hoverable';
        }
        if ($menu_item) :
        ?>
          <li class="<?php echo $li_class ?>">
            <a href="<?php echo $menu_item['url'] ?>" target="<?php echo $menu_item['target'] ?>" class="inline-block text-white font-semibold text-sm 2xl:text-base 4xl:text-lg uppercase whitespace-nowrap py-8 px-3"><?php echo $menu_item['title'] ?></a>
            <?php if ($has_megamenu && $megamenu_items) : ?>
              <div class="mega-menu" tabindex="0">
                <div class="container mx-auto px-20 py-20 bg-black bg-opacity-90">
                  <div class="container max-w-screen-xl mx-auto">
                    <div class="flex gap-x-12 divide-x divide-white/30">
                      <?php
                      $menu_heading = $megamenu_items['menu_heading'];
                      $menu_description = $megamenu_items['menu_description'];
                      $submenu_items = $megamenu_items['submenu_items'];
                      ?>
                      <div class="w-1/4">
                        <?php if ($menu_heading) : ?>
                          <h4 class="text-[34px] font-semibold text-brand-red"><?php echo $menu_heading ?></h4>
                        <?php endif; ?>
                        <?php if ($menu_description) : ?>
                          <div class="mt-6">
                            <?php echo $menu_description ?>
                          </div>
                        <?php endif; ?>
                      </div>
                      <div class="w-3/4 pl-12">
                        <div class="flex gap-x-12">
                          <div class="w-2/5">
                            <?php if ($submenu_items) : ?>
                              <ul class="flex flex-col divide-y divide-white/30 text-lg">
                                <?php foreach ($submenu_items as $submenu_id => $item) : ?>
                                  <?php
                                  $submenu_item = $item['submenu_item'];
                                  $submenu_class = '';
                                  $data_target = '';
                                  $featured = $item['featured'];
                                  if ($featured) {
                                    $submenu_class = 'menu-has-article';
                                    $data_target = 'article-' . $menu_id . $submenu_id;
                                  }
                                  ?>
                                  <li>
                                    <a href="<?php echo $submenu_item['url'] ?>" class="<?php echo $submenu_class ?>" data-target="<?php echo $data_target ?>">
                                      <span><?php echo $submenu_item['title'] ?></span>
                                      <?php if ($featured) : ?>
                                        <?php echo smc_icon(array('icon' => 'chevron', 'group' => 'utilities', 'size' => '18', 'class' => 'text-brand-red absolute right-0 top-4')); ?>
                                      <?php endif; ?>
                                    </a>
                                  </li>
                                <?php endforeach; ?>
                              </ul>
                            <?php endif; ?>
                          </div>
                          <div class="w-3/5 relative">
                            <?php if ($submenu_items) : ?>
                              <?php foreach ($submenu_items as $submenu_id => $item) : ?>
                                <?php
                                $featured = $item['featured'];
                                $article_id = '';
                                if ($featured) {
                                  $article_id = 'article-' . $menu_id . $submenu_id;
                                }
                                $title = $featured['title'];
                                $description = $featured['description'];
                                $thumbnail = $featured['image'];
                                ?>
                                <?php if ($featured) : ?>
                                  <div id="<?php echo $article_id; ?>" class="menu-article" tabindex="-1">
                                    <div class="flex flex-col gap-y-4">
                                      <?php if ($thumbnail) : ?>
                                        <div class="aspect-w-16 aspect-h-8">
                                          <img src="<?php echo $thumbnail['url'] ?>" alt="<?php echo $title ?>" class="object-cover h-full w-full rounded-xl" />
                                        </div>
                                      <?php endif; ?>
                                      <?php if ($title) : ?>
                                        <h2 class="text-[28px] font-bold text-brand-red line-clamp-2"><?php echo $title ?></h2>
                                      <?php endif; ?>
                                      <?php if ($description) : ?>
                                        <p class="text-lg line-clamp-2">
                                          <?php echo $description ?>
                                        </p>
                                      <?php endif; ?>
                                    </div>
                                  </div>
                                <?php endif; ?>
                              <?php endforeach; ?>
                            <?php endif; ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php endif; ?>
          </li>
        <?php endif; ?>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>
  <?php
  $phone_link = get_field('phone_link', 'option');
  if ($phone_link) :
  ?>
    <a href="<?php echo $phone_link['url'] ?>" target="<?php echo $phone_link['target'] ?>" class="flex items-center px-4 py-2 gap-x-2 2xl:px-6 2xl:py-3 2xl:gap-x-4 text-sm 2xl:text-base text-white font-semibold whitespace-nowrap border border-solid border-white rounded-full bg-transparent hover:bg-brand-red hover:border-brand-red transition duration-200">
      <?php echo smc_icon(array('icon' => 'phone', 'group' => 'utilities', 'size' => '24', 'class' => 'text-white h-5 w-5 2xl:w-5 2xl:h-6')); ?>
      <span><?php echo $phone_link['title'] ?></span>
    </a>
  <?php endif; ?>
</div>