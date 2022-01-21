<nav class="navbar navbar-area navbar-expand-lg nav-style-02">
    <div class="container nav-container">
        <div class="navbar-brand">
            <a href="<?php echo e(url('/')); ?>" class="logo">
                <?php
                    $site_logo = get_attachment_image_by_id(get_static_option('site_logo'), 'full', false);
                ?>
                <?php if(!empty($site_logo)): ?>
                    <img src="<?php echo e($site_logo['img_url']); ?>" alt="site logo">
                <?php endif; ?>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_menu"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="main_menu">
            <ul class="navbar-nav">
                <?php if(!empty($primary_menu->content)): ?>
                    <?php
                        $cc = 0;
                        $parent_item_count = 0;
                        $menu_content = json_decode($primary_menu->content);
                        // print_r ($menu_content);
                        // exit();
                    ?>
                    <?php $__currentLoopData = $menu_content; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            if ($cc > 0 && $cc == $parent_item_count) {
                                print '</ul>';
                                $cc = 0;
                            }
                            if (!empty($data->parent_id) && $data->depth > 0) {
                                if ($cc == 0) {
                                    print '<ul class="sub-menu">';
                                    $parent_item_count = get_child_menu_count($menu_content, $data->parent_id);
                                } else {
                                    print '</li>';
                                }
                            } else {
                                print '</li>';
                            }
                        ?>
                        <li class="<?php if(request()->path() == substr($data->menuUrl, 6)): ?> current-menu-item <?php endif; ?>">
                            <?php if($data->menuTitle == 'Home'): ?>
                                <a href="<?php echo e(str_replace('[url]', url('/'), $data->menuUrl)); ?>"><?php echo e('Home'); ?></a>
                                <li>
                                    <a href="<?php echo e(route('frontend.services.page')); ?>"><?php echo e('Services'); ?></a>
                                </li>
                            <?php else: ?>
                                <a href="<?php echo e(str_replace('[url]', url('/'), $data->menuUrl)); ?>"><?php echo e($data->menuTitle); ?></a>
                            <?php endif; ?>
                            <?php
                                if (!empty($data->parent_id) && $data->depth > 0) {
                                    $cc++;
                                }
                            ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <li class="<?php if(request()->path() == '/'): ?> current-menu-item <?php endif; ?>">
                        <a href="<?php echo e(url('/')); ?>"><?php echo e('Home'); ?></a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
        <button class="btn btn-secondary brsearch d-block d-lg-none d-xl-none d-md-none d-xs-block d-sm-block"
            type="button" data-toggle="modal" data-target="#searchmodal">
            <i class="fa fa-search"></i>
        </button>
    </div>
</nav>
<!-- navbar area end -->
<?php /**PATH /srv/http/umdaa/umdaa.co/resources/views/frontend/partials/navbar-03.blade.php ENDPATH**/ ?>