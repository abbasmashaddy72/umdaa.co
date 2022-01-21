<div class="widget-area">
    <div class="widget widget_search">
        <form action="<?php echo e(route('frontend.blog.search')); ?>" method="get" class="search-form">
            <div class="form-group">
                <input type="text" class="form-control" name="search" placeholder="<?php echo e(__('Search')); ?>">
            </div>
            <button class="submit-btn" type="submit"><i class="fa fa-search"></i></button>
        </form>
    </div>
    <div class="widget widget_nav_menu">
        <h2 class="widget-title"><?php echo e('Departments'); ?></h2>
        <ul>
            <?php $__currentLoopData = $all_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><a
                        href="<?php echo e(route('frontend.blog.category', ['id' => $data->department_id, 'any' => Str::slug($data->department_name, '-')])); ?>"><?php echo e(ucfirst($data->department_name)); ?></a>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>

    <div class="widget widget_recent_posts">
        <h4 class="widget-title"><?php echo e('Recent Posts'); ?></h4>
        <ul class="recent_post_item">
            <?php $__currentLoopData = $all_recent_blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="single-recent-post-item">
                    <div class="thumb">
                        <?php if($data->article_type == 'video' || $data->article_type == 'Video'): ?>
                            <img src="<?php echo e($data->article_image != '' ? $data->article_image : url('assets/uploads/default/'.$data->category->department_name.'.jpg')); ?>" style="height:60px; width:100%; object-fit:cover;">
                            <?php elseif($data->article_type == 'pdf'): ?>
                            <img src=<?php echo e(url('assets/uploads/default/'.$data->category->department_name.'.jpg')); ?> style="height:60px; width:100%; object-fit:cover;" >
                        <?php else: ?>
                            <img src="<?php echo e($data->posted_url != '' ? ('https://clinic.umdaa.co/uploads/article_images/'.$data->posted_url) : url('assets/uploads/default/'.$data->category->department_name.'.jpg')); ?>" style="height:60px; width:100%; object-fit:cover;">
                        <?php endif; ?>
                    </div>
                    <div class="content">
                        <h4 class="title"><a
                                href="<?php echo e(route('frontend.blog.single', ['id' => $data->article_id, 'any' => Str::slug($data->article_title, '-')])); ?>"><?php echo e(Illuminate\Support\Str::limit($data->article_title, 60)); ?></a>
                        </h4>
                        <span class="time"><?php echo e(date('d M Y', strtotime($data->posted_date))); ?></span>
                    </div>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
</div>
<?php /**PATH /srv/http/umdaa/umdaa.co/resources/views/frontend/partials/sidebar.blade.php ENDPATH**/ ?>