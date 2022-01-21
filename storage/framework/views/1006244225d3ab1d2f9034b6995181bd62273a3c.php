<?php $__currentLoopData = $m_all_blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="carousel-item col-md-4 <?php echo e($key == 0 ? 'active' : ''); ?> page-id-mblog">
        <div class="card">
            <?php if($data->article_type == 'video' || $data->article_type == 'Video'): ?>
                <iframe
                    src="<?php echo e($data->video_url != '' ? url('https://www.youtube.com/embed/' . $data->video_url . '?rel=0&modestbranding=1&autohide=1&showinfo=0&controls=0&autoplay=0') : url('assets/uploads/default/' . $data->category->department_name . '.jpg')); ?>"
                    height="216" frameborder="0" allowfullscreen></iframe>
            <?php elseif($data->article_type == 'pdf'): ?>
                <img src=<?php echo e(url('assets/uploads/default/' . $data->category->department_name . '.jpg')); ?>

                    style="height:216px; width:100%; object-fit:cover;">
            <?php else: ?>
                <img src="<?php echo e($data->posted_url != '' ? 'https://clinic.umdaa.co/uploads/article_images/' . $data->posted_url : url('assets/uploads/default/' . $data->category->department_name . '.jpg')); ?>"
                    style="height:216px; width:100%; object-fit:cover;">
            <?php endif; ?>
            <div class="card-body">
                <h4 class="card-title">
                    <a style="font-weight: bold; font-size: 18px;"
                        href="<?php echo e(route('frontend.blog.m_single', ['id' => $data->article_id, 'any' => str_replace(' ', '-', $data->article_title)])); ?>">
                        <?php echo e($data->article_title); ?>

                    </a>
                </h4>
                <p class="card-text"><?php echo e($data->short_description); ?></p>
                <p>Source: <a href="<?php echo e($data->read_article_link); ?>"
                        style="color: #007bff"><?php echo e($data->article_author); ?></a></p>
            </div>
        </div>
        <ul class="menu bottomRight">
            <li class="share top">
                <i class="fa fa-share-alt"></i>
                <ul class="submenu">
                    <?php
                        $post_img = null;
                        if ($data->article_type == 'video' || $data->article_type == 'Video') {
                            $blog_image = url('assets/uploads/default/thumb/' . $data->category->department_name . '.jpg');
                        } elseif ($data->article_type == 'image') {
                            $blog_image = $data->posted_url != '' ? 'https://clinic.umdaa.co/uploads/article_images/' . $data->posted_url : url('assets/uploads/default/thumb/' . $data->category->department_name . '.jpg');
                        } else {
                            $blog_image = url('assets/uploads/default/thumb/' . $data->category->department_name . '.jpg');
                        }
                        $post_img = $blog_image;
                    ?>
                    <?php echo single_post_share(route('frontend.blog.single', ['id' => $data->article_id, 'any' => Str::slug($data->article_title)]), $data->short_description, $post_img); ?>

                </ul>
            </li>
        </ul>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        $("#myCarousel").on("slide.bs.carousel", function(e) {
            var $e = $(e.relatedTarget);
            var idx = $e.index();
            var itemsPerSlide = 3;
            var totalItems = $(".carousel-item").length;

            if (idx >= totalItems - (itemsPerSlide - 1)) {
                var it = itemsPerSlide - (totalItems - idx);
                for (var i = 0; i < it; i++) {
                    // append slides to end
                    if (e.direction == "left") {
                        $(".carousel-item")
                            .eq(i)
                            .appendTo(".carousel-inner");
                    } else {
                        $(".carousel-item")
                            .eq(0)
                            .appendTo($(this).find(".carousel-inner"));
                    }
                }
            }
        });
    </script>
    <script>
        $('.carousel').on('touchstart', function(event) {
            const xClick = event.originalEvent.touches[0].pageX;
            $(this).one('touchmove', function(event) {
                const xMove = event.originalEvent.touches[0].pageX;
                const sensitivityInPx = 5;

                if (Math.floor(xClick - xMove) > sensitivityInPx) {
                    $(this).carousel('next');
                } else if (Math.floor(xClick - xMove) < -sensitivityInPx) {
                    $(this).carousel('prev');
                }
            });
            $(this).on('touchend', function() {
                $(this).off('touchmove');
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php /**PATH /srv/http/umdaa/umdaa.co/resources/views/frontend/pages/blogs/mobile_blog.blade.php ENDPATH**/ ?>