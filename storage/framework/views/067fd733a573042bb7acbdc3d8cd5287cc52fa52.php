<?php $__env->startSection('site-title'); ?>
    <?php echo e('Blogs'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e('Blogs'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
    <style>
        .single-blog-grid-01 .content .title {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .single-blog-grid-01 .content p {
            display: -webkit-box;
            -webkit-line-clamp: 6;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }

    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section class="d-none d-lg-block d-xl-block d-md-block d-xs-none d-sm-none blog-content-area padding-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        <?php $__currentLoopData = $all_blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-lg-6 col-md-6">
                                <div class="single-blog-grid-01 margin-bottom-30">
                                    <div class="thumb">
                                        <?php if($data->article_type == 'video' || $data->article_type == 'Video'): ?>
                                            <img src="<?php echo e($data->article_image != '' ? $data->article_image : url('assets/uploads/default/' . $data->category->department_name . '.jpg')); ?>"
                                                style="height:216px; width:100%; object-fit:cover;">
                                        <?php elseif($data->article_type == 'pdf'): ?>
                                            <img src=<?php echo e(url('assets/uploads/default/' . $data->category->department_name . '.jpg')); ?>

                                                style="height:216px; width:100%; object-fit:cover;">
                                        <?php else: ?>
                                            <img src="<?php echo e($data->posted_url != '' ? 'https://clinic.umdaa.co/uploads/article_images/' . $data->posted_url : url('assets/uploads/default/' . $data->category->department_name . '.jpg')); ?>"
                                                style="height:216px; width:100%; object-fit:cover;">
                                        <?php endif; ?>
                                    </div>
                                    <div class="content">
                                        <h4 class="title"><a
                                                href="<?php echo e(route('frontend.blog.single', ['id' => $data->article_id, 'any' => str_replace(' ', '-', $data->article_title)])); ?>"><?php echo e($data->article_title); ?></a>
                                        </h4>
                                        <ul class="post-meta">
                                            <li><a><i class="fa fa-calendar"></i>
                                                    <?php echo e(date('d M Y', strtotime($data->posted_date))); ?></a></li>
                                            <?php if(!empty($data->user->first_name)): ?>
                                                <li><a><i class="fa fa-user"></i> <?php echo e($data->user->first_name); ?></a>
                                                </li>
                                            <?php else: ?>
                                                <li><a><i class="fa fa-user"></i> <?php echo e('Admin'); ?></a></li>
                                            <?php endif; ?>
                                            <li>
                                                <div class="cats"><i class="fas fa-id-card-alt"></i><a
                                                        href="<?php echo e(route('frontend.blog.category', ['id' => $data->category->department_id, 'any' => $data->category->department_name])); ?>">
                                                        <?php echo e($data->category->department_name); ?></a></div>
                                            </li>
                                        </ul>
                                        <p><?php echo e($data->short_description); ?></p>
                                        <ul class="post-meta " style="margin-bottom:0">
                                            <li><a href="<?php echo e($data->read_article_link); ?>"><i>Source:
                                                    </i><?php echo e($data->article_author); ?></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="col-lg-12">
                        <nav class="pagination-wrapper" aria-label="Page navigation ">
                            <?php echo e($all_blogs->links()); ?>

                        </nav>
                    </div>
                </div>
                <div class="col-lg-4">
                    <?php echo $__env->make('frontend.partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        </div>
    </section>
    <section class="d-block d-lg-none d-xl-none d-md-none d-xs-block d-sm-block" style="min-height: 75vh;">
        <div id="myCarousel" class="carousel slide" data-interval="false" data-wrap="false">
            <div class="carousel-inner row w-100 mx-auto" id="post-data">
                <?php echo $__env->make('frontend.pages.blogs.mobile_blog', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/http/umdaa/umdaa.co/resources/views/frontend/pages/blogs/blog.blade.php ENDPATH**/ ?>