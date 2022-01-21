<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>
        <?php if(request()->path() == 'admin-home'): ?>
            <?php echo e(get_static_option('site_tag_line')); ?>

        <?php else: ?>
            <?php echo $__env->yieldContent('site-title'); ?>
        <?php endif; ?>
        - <?php echo e('UMDAA Health Care'); ?>

    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
        $site_favicon = get_attachment_image_by_id(get_static_option('site_favicon'), 'full', false);
    ?>
    <?php if(!empty($site_favicon)): ?>
        <link rel="icon" href="<?php echo e($site_favicon['img_url']); ?>" type="image/png">
    <?php endif; ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/font-awesome.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/themify-icons.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/metisMenu.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/slicknav.min.css')); ?>">
    <!-- others css -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/typography.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/default-css.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/styles.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/responsive.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/fontawesome-iconpicker.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/fontawesome.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/flaticon.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/custom-style.css')); ?>">
    <?php echo $__env->yieldContent('style'); ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/dark-mode.css')); ?>">
    <!-- modernizr css -->
    <script src="<?php echo e(asset('assets/backend/vendor/modernizr-2.8.3.min.js')); ?>"></script>
</head>

<body>

    <!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <div class="page-container">
        <?php echo $__env->make('backend.partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="main-content">
            <!-- header area start -->
            <div class="header-area">
                <div class="row align-items-center">
                    <!-- nav and search button -->
                    <div class="col-md-6 col-sm-8 clearfix">
                        <div class="nav-btn pull-left">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                    <!-- profile info & task notification -->
                    <div class="col-md-6 col-sm-4 clearfix">
                        <ul class="notification-area pull-right">
                            <li><a class="btn btn-primary" target="_blank"
                                    href="<?php echo e(url('/')); ?>"><?php echo e('View Site'); ?></a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
							<h4 class="page-title pull-left"><?php echo $__env->yieldContent('site-title'); ?></h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="<?php echo e(route('admin.home')); ?>"><?php echo e('Home'); ?></a></li>
                                <li><span><?php echo $__env->yieldContent('site-title'); ?></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 clearfix">
                        <div class="user-profile pull-right">
                            <?php
                                $profile_img = get_attachment_image_by_id(auth()->user()->image, null, true);
                            ?>
                            <?php if(!empty($profile_img)): ?>
                                <img class="avatar user-thumb" src="<?php echo e($profile_img['img_url']); ?>"
                                    alt="<?php echo e(auth()->user()->name); ?>">
                            <?php endif; ?>

                            <h4 class="user-name dropdown-toggle" data-toggle="dropdown"><?php echo e(Auth::user()->name); ?> <i
                                    class="fa fa-angle-down"></i></h4>
                            <div class="dropdown-menu">
                                <a class="dropdown-item"
                                    href="<?php echo e(route('admin.profile.update')); ?>"><?php echo e('Edit Profile'); ?></a>
                                <a class="dropdown-item"
                                    href="<?php echo e(route('admin.password.change')); ?>"><?php echo e('Password Change'); ?></a>
                                <a class="dropdown-item" href="<?php echo e(route('admin.logout')); ?>" onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                    <?php echo e('Logout'); ?>

                                </a>
                                <form id="logout-form" action="<?php echo e(route('admin.logout')); ?>" method="POST"
                                    style="display: none;">
                                    <?php echo csrf_field(); ?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php echo $__env->yieldContent('content'); ?>
        </div>

        <footer>
            <div class="footer-area">
                <p>
                    <?php
                        $footer_copyright_text = '{year} {copy} UMDAA Health Care';
                        $footer_copyright_text = str_replace('{copy}', '&copy;', $footer_copyright_text);
                        $footer_copyright_text = str_replace('{year}', date('Y'), $footer_copyright_text);
                    ?>
                    <?php echo $footer_copyright_text; ?>

                </p>
            </div>
        </footer>

    </div>
    <script src="<?php echo e(asset('assets/backend/vendor/jquery-2.2.4.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/backend/js/popper.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/backend/js/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/backend/js/metisMenu.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/backend/js/jquery.slimscroll.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/backend/js/jquery.slicknav.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/backend/js/fontawesome-iconpicker.min.js')); ?>"></script>
    <?php echo $__env->yieldContent('script'); ?>
    <script src="<?php echo e(asset('assets/backend/js/plugins.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/backend/js/scripts.js')); ?>"></script>

</body>

</html>
<?php /**PATH /srv/http/umdaa/umdaa.co/resources/views/backend/admin-master.blade.php ENDPATH**/ ?>