
<?php
$post_img = null;
if ($blog_post->article_type == 'video' || $blog_post->article_type == 'Video') {
    $blog_image = url('assets/uploads/default/thumb/' . $blog_post->category->department_name . '.jpg');
} elseif ($blog_post->article_type == 'image') {
    $blog_image = $blog_post->posted_url != '' ? 'https://clinic.umdaa.co/uploads/article_images/' . $blog_post->posted_url : url('assets/uploads/default/thumb/' . $blog_post->category->department_name . '.jpg');
} else {
    $blog_image = url('assets/uploads/default/thumb/' . $blog_post->category->department_name . '.jpg');
}
$post_img = $blog_image;
?>
<?php $__env->startSection('og-meta'); ?>
    <meta property="og:title" content="<?php echo e($blog_post->article_title); ?>" />
    <meta property="og:url"
        content="<?php echo e(route('frontend.blog.single', ['id' => $blog_post->article_id, 'any' => Str::slug($blog_post->article_title)])); ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:description" content="<?php echo e(Illuminate\Support\Str::limit($blog_post->short_description, 100)); ?>" />
    <meta property="og:image" content="<?php echo e($post_img); ?>" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:title" content="<?php echo e($blog_post->article_title); ?>" />
    <meta name="twitter:description" content="<?php echo e(Illuminate\Support\Str::limit($blog_post->short_description, 100)); ?>" />
    <meta name="twitter:url"
        content="<?php echo e(route('frontend.blog.single', ['id' => $blog_post->article_id, 'any' => Str::slug($blog_post->article_title)])); ?>" />
    <meta name="twitter:image" content="<?php echo e($post_img); ?>" />
    <meta name="description" content="<?php echo e(Illuminate\Support\Str::limit($blog_post->short_description, 100)); ?>">
    <meta name="keywords" content="<?php echo e($blog_post->tags); ?>">
    <meta property="url"
        content="<?php echo e(route('frontend.blog.single', ['id' => $blog_post->article_id, 'any' => Str::slug($blog_post->article_title)])); ?>" />
    <meta property="type" content="website" />
    <meta property="title" content="<?php echo e($blog_post->article_title); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="image" content="<?php echo e($post_img); ?>" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('site-title'); ?>
    <?php echo e($blog_post->article_title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(Illuminate\Support\Str::limit($blog_post->article_title, 100)); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
    <style>
        .content-area {
            text-align: justify;
        }

        .content-area h1,
        h2,
        h3,
        h4,
        h6,
        p {
            font-family: Roboto !important;
        }

    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section class="blog-details-content-area blog-content-area padding-100" style="min-height: 75vh;">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="blog-details-item">
                        <div class="thumb">
                            <?php if($blog_post->article_type == 'video' || $blog_post->article_type == 'Video'): ?>
                                <iframe width="800" height="420"
                                    src="<?php echo e($blog_post->video_url != '' ? url('https://www.youtube.com/embed/' . $blog_post->video_url . '?controls=0') : url('assets/uploads/default/' . $blog_post->category->department_name . '.jpg')); ?>"></iframe>
                            <?php elseif($blog_post->article_type == 'pdf'): ?>
                                <div class="text-center border border-light padding-50 mb-4 btn-ds">
                                    <a href="<?php echo e($blog_post->posted_url != '' ? 'https://clinic.umdaa.co/uploads/article_pdf/' . $blog_post->posted_url : url('assets/uploads/default/' . $blog_post->category->department_name . '.jpg')); ?>"
                                        class="btn btn-primary active" role="button" aria-pressed="true">View PDF</a>
                                </div>
                            <?php else: ?>
                                <img
                                    src="<?php echo e($blog_post->posted_url != '' ? 'https://clinic.umdaa.co/uploads/article_images/' . $blog_post->posted_url : url('assets/uploads/default/' . $blog_post->category->department_name . '.jpg')); ?>">
                            <?php endif; ?>
                        </div>
                        <div class="entry-content">
                            <h5 class="margin-bottom-30"><?php echo $blog_post->article_title; ?></h5>
                            <ul class="post-meta">
                                <li><i class="fa fa-calendar"></i>
                                    <?php echo e(date('d M Y', strtotime($blog_post->posted_date))); ?></li>
                                <?php if(!empty($blog_post->user->first_name)): ?>
                                    <li><a><i class="fa fa-user"></i> <?php echo e($blog_post->user->first_name); ?></a></li>
                                <?php else: ?>
                                    <li><a><i class="fa fa-user"></i> <?php echo e('Admin'); ?></a></li>
                                <?php endif; ?>
                                <li>
                                    <div class="cats">
                                        <i class="fa fa-calendar"></i>
                                        <a
                                            href="<?php echo e(route('frontend.blog.category', ['id' => $blog_post->category->department_id, 'any' => Str::slug($blog_post->category->department_name, '-')])); ?>">
                                            <?php echo e($blog_post->category->department_name); ?></a>
                                    </div>
                                </li>
                            </ul>
                            <?php if(!empty($blog_post->article_description)): ?>
                                <div class="content-area"><?php echo $blog_post->article_description; ?></div>
                            <?php else: ?>
                                <div class="content-area"><?php echo $blog_post->short_description; ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="blog-details-footer">
                            <!-- entry footer -->
                            <div class="left">
                                <ul class="tags">
                                    <li class="title"><?php echo e('Tags:'); ?></li>
                                    <?php
                                        $all_tags = explode(',', $blog_post->tags);
                                    ?>
                                    <?php $__currentLoopData = $all_tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><a
                                                href="<?php echo e(route('frontend.blog.tags.page', ['name' => Str::slug($tag)])); ?>"><?php echo e($tag); ?></a>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                            <div class="right">
                                <ul class="social-share">
                                    <li class="title"><?php echo e('Share:'); ?></li>
                                    <?php echo single_post_share(route('frontend.blog.single', ['id' => $blog_post->article_id, 'any' => Str::slug($blog_post->article_title, '-')]), $blog_post->short_description, $post_img); ?>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="related-post-area margin-top-40">
                        <div class="section-title ">
                            <h4 class="title "><?php echo e(get_static_option('blog_single_page_related_post_title')); ?>

                            </h4>
                            <div class="related-news-carousel margin-top-50">
                                <?php $__currentLoopData = $all_related_blog; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($data->article_id === $blog_post->article_id): ?> <?php continue; ?>
                                    <?php endif; ?>
                                    <div class="single-blog-grid-01">
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
                                                    href="<?php echo e(route('frontend.blog.single', ['id' => $data->article_id, 'any' => Str::slug($data->article_title)])); ?>"><?php echo e($data->article_title); ?></a>
                                            </h4>
                                            <ul class="post-meta">
                                                <li><a href="#"><i class="fa fa-calendar"></i>
                                                        <?php echo e(date('d M Y', strtotime($data->posted_date))); ?></a></li>
                                                <?php if(!empty($data->user->first_name)): ?>
                                                    <li><a><i class="fa fa-user"></i>
                                                            <?php echo e($data->user->first_name); ?></a>
                                                    </li>
                                                <?php else: ?>
                                                    <li><a><i class="fa fa-user"></i> <?php echo e('Admin'); ?></a></li>
                                                <?php endif; ?>
                                                <li>
                                                    <div class="cats"><i class="fa fa-calendar"></i><a
                                                            href="<?php echo e(route('frontend.blog.category', ['id' => $data->category->department_id, 'any' => Str::slug($data->category->department_name)])); ?>">
                                                            <?php echo e($data->category->department_name); ?></a></div>
                                                </li>
                                            </ul>
                                            <p><?php echo e($data->short_description); ?></p>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                    <div class="disqus-comment-area margin-top-40">
                        <div id="disqus_thread"></div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <?php echo $__env->make('frontend.partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        var disqus_config = function() {
            this.page.url =
                "<?php echo e(route('frontend.blog.single', ['id' => $blog_post->article_id, 'any' => Str::slug($blog_post->article_title, '-')])); ?>";
            this.page.identifier = "<?php echo e($blog_post->article_id); ?>";
        };

        (function() { // DON'T EDIT BELOW THIS LINE
            var d = document,
                s = d.createElement('script');
            s.src = "https://umdaa-1.disqus.com/embed.js";
            s.setAttribute('data-timestamp', +new Date());
            (d.head || d.body).appendChild(s);
        })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by
            Disqus.</a></noscript>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/http/umdaa/umdaa.co/resources/views/frontend/pages/blogs/mblog-single.blade.php ENDPATH**/ ?>