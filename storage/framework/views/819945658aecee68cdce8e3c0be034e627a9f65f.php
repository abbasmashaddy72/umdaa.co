<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Admin Login - <?php echo e('UMDAA Health Care'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
        $site_favicon = get_attachment_image_by_id(get_static_option('site_favicon'), 'full', false);
    ?>
    <?php if(!empty($site_favicon)): ?>
        <link rel="icon" href="<?php echo e($site_favicon['img_url']); ?>" type="image/png">
    <?php endif; ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/themify-icons.css')); ?>">
    <!-- others css -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/typography.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/default-css.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/styles.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/responsive.css')); ?>">
    <!-- modernizr css -->
    <script src="<?php echo e(asset('assets/backend/vendor/modernizr-2.8.3.min.js')); ?>"></script>
</head>

<body>
    <?php echo $__env->yieldContent('content'); ?>

    <!-- jquery latest version -->
    <script src="<?php echo e(asset('assets/backend/vendor/jquery-2.2.4.min.js')); ?>"></script>
    <!-- bootstrap 4 js -->
    <script src="<?php echo e(asset('assets/backend/js/popper.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/backend/js/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/backend/js/metisMenu.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/backend/js/jquery.slimscroll.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/backend/js/jquery.slicknav.min.js')); ?>"></script>

    <!-- others plugins -->
    <script src="<?php echo e(asset('assets/backend/js/plugins.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/backend/js/scripts.js')); ?>"></script>
</body>

</html>
<?php /**PATH /srv/http/umdaa/umdaa.co/resources/views/layouts/login-screens.blade.php ENDPATH**/ ?>